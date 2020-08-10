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
			$theme->setTitle('BizLand');
			$theme->setAuthor('Jonh Doe');
		},

		'asset' => function($asset)
		{
			$asset->themePath()->add([
										['style', 'vendor/bootstrap/css/bootstrap.min.css'],
										['style1', 'vendor/icofont/icofont.min.css'],
										['style2', 'vendor/boxicons/css/boxicons.min.css'],
										['style3', 'vendor/owl.carousel/assets/owl.carousel.min.css'],
										['style4', 'vendor/venobox/venobox.css'],
										['style5', 'vendor/aos/aos.css'],
										['style', 'css/style.css'],
										['script1', 'vendor/jquery/jquery.min.js'],
										['script2', 'vendor/bootstrap/js/bootstrap.bundle.min.js'],
										['script3', 'vendor/jquery.easing/jquery.easing.min.js'],
										['script4', 'vendor/php-email-form/validate.js'],
										['script5', 'vendor/waypoints/jquery.waypoints.min.js'],
										['script6', 'vendor/counterup/counterup.min.js'],
										['script7', 'vendor/owl.carousel/owl.carousel.min.js'],
										['script8', 'vendor/isotope-layout/isotope.pkgd.min.js'],
										['script9', 'vendor/venobox/venobox.min.js'],
										['script0', 'vendor/aos/aos.js'],
										['script10', 'js/main.js'],
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
