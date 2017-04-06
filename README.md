Impress Portfolio with Symfony "small" edition
==============================================

This is a simple [Symfony](http://symfony.com/) application using the awesome
[Impress.js](https://github.com/bartaz/impress.js) combined with [EasyImpressBundle](https://github.com/Orbitale/EasyImpressBundle)
to create sliders based on a single `yml` configuration file.

[View the online demo](http://demo.orbitale.io/easy_impress/)

**ℹ️ Note:** This is just the DEMO app. If you want to see the bundle and integrate it in your own app,
go to [EasyImpressBundle](https://github.com/Orbitale/EasyImpressBundle) 😃

# Requirements

* PHP 5.5+
* [Composer](https://getcomposer.org/)

# Installation

* Just clone the repository, or download it as a `zip` file from the
[latest release](https://github.com/Orbitale/EasyImpress/releases/latest), and put it in the directory you want.
* Install [Composer](https://getcomposer.org/) if you do not have it yet.
* Run `composer install` to install all the needed dependencies.

Start your application on your webserver or with Symfony's internal server by running<br>
`php bin/console server:run`, and you should see the default `home` slider, a black cube on a gray background!

# Usage

Every slider is contained in the `app/config/presentations` directory, and the file name is used as the slider's
identifier. This identifier will be the name displayed in the URL.

`app/Resource/presentations/{presentation_name}` will be accessible from `/{presentation_name}` path.

Just look at the `app/config/presentations/home.yml` to know how the default slider is made.

## Yml reference

As every presentation is made in the `yml` format, here's the reference:

```yaml
# Html "data-" attributes that correspond to Impress options
data:
    transition-duration: 1000
    min-scale: 1

# Determines the css "opacity" for inactive slides (".future" or ".past" slide classes)
inactive_opacity: 1

# Some HTML attributes for the presentation
# Please note that "impress_slides_container" class is mandatory and always added
attr:
    style: ''
    class: 'impress_slides_container'

# With increments, the slides coordinates will automatically be calculated based on these values
# For example, if "x" increment is set to 100, each slide "x" value will be incremented with 100.
# Increments will also correspond to base values for the first slide.
# IMPORTANT: If you set increments for one property, you CANNOT set the property in a slide.
increments:
    x:        ~
    y:        ~
    z:        ~
    rotate:   ~
    rotate-x: ~
    rotate-y: ~
    rotate-z: ~

# Here you will define all slides
# Slides are an array of properties
slides:

    # Slide ID will be processed automatically with this as default value:
    # {presentation_name}_{slide_number}
    #
    # But you can specify an id manually:
    #
    # slides:
    #     slide_id:
    #         data:
    #             x: 1
    #
    # You can specify no id at all:
    #
    # slides:
    #     - data:
    #           x: 1
    #
    # Or add it as a simple property (make sure there is no duplicate):
    #
    # slides:
    #     - id: slide_id
    #       data:
    #           x: 1
    #

    slide id or hyphen:

        # Optional, see id informations above
        id: ''

        # Slide's content, in plain HTML
        content: ''

        # HTML data attributes that correspond to slide's position/rotation in the canvas
        # All of these will correspond to CSS transforms
        data:
            x:        ~
            y:        ~
            z:        ~
            rotate:   ~ # Alias to "rotate-z"
            rotate-x: ~
            rotate-y: ~
            rotate-z: ~
            scale:    ~ # 

        # Some HTML attributes for the slide
        # Please note that "step" class is mandatory and always added
        attr:
            style: ''
            class: 'step'

        # If you are using "increments" in presentation,
        #   you can reset any incrementation value starting from this slide
        #   by setting the attribute to "true".
        # The slide that resets value will recover the base increment value
        #   and incrementation will continue for the next slides.
        reset:
            x:        false
            y:        false
            z:        false
            rotate:   false
            rotate-x: false
            rotate-y: false
            rotate-z: false
```

### Data attributes

As explained in [ImpressJS Wiki](https://github.com/impress/impress.js/wiki/Html-attributes):


> ### Cartesian Position
> Where in 3D space to position the step frame in Cartesian space.
> 
> #### data-x, data-y, data-z
> Define the origin location in 3D Cartesian space. Specified in pixels (sort-of).
> 
> #### data-rotate
> Rotation of the step frame about its origin in the X-Y plane. This is akin to rotating a piece of paper in front of your face while maintaining it's ortho-normality to your image plane (did that explanation help? I didn't think so...). It rotates the way a photo viewer rotates, like when changing from portrait to landscape view.
> 
> ### Polar Position
> Rotation of the step frame about its origin along the theta (azimuth) and phi (elevation) axes. This effect is similar to tilting the frame away from you (elevation) or imaging it standing on a turntable -- and then rotating the turntable (azimuth).
> 
> #### data-rotate-x
> Rotation along the theta (azimuth) axis
> 
> #### data-rotate-y
> Rotation along the phi (elevation) axis
> 
> ### Size
> 
> #### data-scale
> The multiple of the "normal" size of the step frame. Has no absolute visual impact, but works to create relative size differences between frames. Effectively, it is controlling how "close" the camera is placed relative to the step frame.

More information can be found on the [Impress.js Wiki](https://github.com/bartaz/impress.js/wiki) or the
[Impress.js documentation](https://github.com/bartaz/impress.js).
