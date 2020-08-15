<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Inherit from another theme
	|--------------------------------------------------------------------------
	|
	| Set up inherit from another if the file is not exists, this
	| is work with "layouts", "partials", "views" and "widgets"
	|
	| [Notice] assets cannot inherit.
	|
	*/

	'inherit' => null, //default

	/*
	|--------------------------------------------------------------------------
	| Listener from events
	|--------------------------------------------------------------------------
	|
	| You can hook a theme when event fired on activities this is cool
	| feature to set up a title, meta, default styles and scripts.
	|
	| [Notice] these event can be override by package config.
	|
	*/

	'events' => array(

		'before' => function($theme)
		{
			// $theme->setTitle('Title example');
			// $theme->setAuthor('Jonh Doe');
		},

		'asset' => function($asset)
		{
			$asset->themePath()->add([
                [
                    'styles',
                    [
                        'vendor/bootstrap/css/bootstrap.min.css',
                        'vendor/icofont/icofont.min.css',
                        'vendor/boxicons/css/boxicons.min.css',
                        'vendor/boxicons/css/boxicons.min.css',
                        'vendor/remixicon/remixicon.css',
                        'vendor/venobox/venobox.css',
                        'vendor/owl.carousel/assets/owl.carousel.min.css',
                        'vendor/aos/aos.css',
                        'css/style.css',
                    ]
                ],
                [
                    'scripts',
                    [
                        'vendor/jquery/jquery.min.js',
                        'vendor/bootstrap/js/bootstrap.bundle.min.js',
                        'vendor/jquery.easing/jquery.easing.min.js',
                        'vendor/php-email-form/validate.js',
                        'vendor/waypoints/jquery.waypoints.min.js',
                        'vendor/isotope-layout/isotope.pkgd.min.js',
                        'vendor/venobox/venobox.min.js',
                        'vendor/owl.carousel/owl.carousel.min.js',
                        'vendor/aos/aos.js',
                        'js/main.js',
                        'js/script.js',
                        //'js',
                    ]
                ]
            ]);

			// You may use elixir to concat styles and scripts.
			/*
			$asset->themePath()->add([
										['styles', 'dist/css/styles.css'],
										['scripts', 'dist/js/scripts.js']
									 ]);
			*/

			// Or you may use this event to set up your assets.
			/*
			$asset->themePath()->add('core', 'core.js');
			$asset->add([
							['jquery', 'vendor/jquery/jquery.min.js'],
							['jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', ['jquery']]
						]);
			*/
		},


		'beforeRenderTheme' => function($theme)
		{
			// To render partial composer
			/*
	        $theme->partialComposer('header', function($view){
	            $view->with('auth', Auth::user());
	        });
			*/

		},

		'beforeRenderLayout' => array(

			'mobile' => function($theme)
			{
				// $theme->asset()->themePath()->add('ipad', 'css/layouts/ipad.css');
			}

		)

	)

);
