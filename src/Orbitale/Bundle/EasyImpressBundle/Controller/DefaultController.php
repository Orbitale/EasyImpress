<?php

/**
 * This file is part of the EasyImpress package.
 *
 * (c) Alexandre Rock Ancelet <alex@orbitale.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Orbitale\Bundle\EasyImpressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @param string $presentationName
     *
     * @return Response
     */
    public function presentationAction($presentationName)
    {
        $presentation = $this->get('impress')->getPresentation($presentationName);

        if (!$presentation) {
            throw $this->createNotFoundException('Presentation "'.$presentationName.'" not found.');
        }

        return $this->render('front/presentation.html.twig', [
            'presentation' => $presentation,
        ]);
    }
}
