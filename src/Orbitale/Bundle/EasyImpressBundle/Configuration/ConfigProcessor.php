<?php

/**
 * This file is part of the EasyImpress package.
 *
 * (c) Alexandre Rock Ancelet <alex@orbitale.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Orbitale\Bundle\EasyImpressBundle\Configuration;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

class ConfigProcessor
{
    /**
     * @param string $file
     *
     * @return array[]
     */
    public function processConfigurationFile($file)
    {
        $yamlArray = Yaml::parse(file_get_contents($file));

        // Presentation name based on the file name.
        $yamlArray['name'] = basename($file, '.yml');

        $processor = new Processor();

        $presentationConfig = $processor->processConfiguration(new PresentationConfiguration(), [$yamlArray]);

        foreach ($presentationConfig['slides'] as $k => $slide) {
            if (!array_key_exists('id', $slide)) {
                if (!is_numeric($k)) {
                    $slide['id'] = $k;
                } else {
                    $slide['id'] = $presentationConfig['name'].'_'.$k;
                }
            }

            if (isset($presentationConfig['slides'][$slide['id']])) {
                throw new \RuntimeException('Duplicate slide id "'.$slide['id'].'" for presentation "'.$presentationConfig['name'].'".');
            }

            $presentationConfig['slides'][$k] = $processor->processConfiguration(new SlideConfiguration(), [$slide]);
        }

        return $this->updatePresentationsConfigs($presentationConfig);
    }

    /**
     * @param array $config
     *
     * @return array[]
     */
    private function updatePresentationsConfigs(array $config)
    {
        $presentation = [];

        $presentation['inactive_opacity'] = $config['inactive_opacity'];
        $presentation['attr'] = $config['attr'];
        $presentation['data'] = $config['data'];
        $presentation['name'] = $config['name'];

        $presentation['slides'] = [];
        $presentation['increments'] = $config['increments'];

        // We need to compute incrementation of the different coordinates.
        $baseIncrements = $presentation['increments'];
        $currentIncrementsArray = array_filter($baseIncrements);
        $incrementsToProcess = array_keys($currentIncrementsArray);

        $parseDown = class_exists('Parsedown') ? new \Parsedown() : null;

        $presentation['slides'] = [];

        foreach ($config['slides'] as $slideArray) {
            foreach ($incrementsToProcess as $dataKey) {
                // Check if we have to reset value before calculating incrementation values.
                if (array_key_exists($dataKey, $slideArray['reset']) && true === $slideArray['reset'][$dataKey]) {
                    $currentIncrementsArray[$dataKey] = $baseIncrements[$dataKey];
                }

                // Update slide values.
                $slideArray['data'][$dataKey] = $currentIncrementsArray[$dataKey];

                // Update incrementation values.
                $currentIncrementsArray[$dataKey] += $baseIncrements[$dataKey];
            }

            switch ($slideArray['content_type']) {
                case 'html':
                    $slideArray['content'] = trim($slideArray['content']);
                    break;
                case 'markdown':
                default:
                    $slideArray['content'] = $parseDown ? $parseDown->text($slideArray['content']) : $slideArray['content'];
            }

            $presentation['slides'][] = $slideArray;
        }

        return $presentation;
    }
}
