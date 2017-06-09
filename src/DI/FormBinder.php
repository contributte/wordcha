<?php

namespace Contributte\Wordcha\DI;

use Contributte\Wordcha\Factory;
use Contributte\Wordcha\Form\WordchaContainer;
use Nette\Forms\Container;

/**
 * Class FormBinder
 *
 * @package Contributte\Wordcha\DI
 */
final class FormBinder
{

	/**
	 * @param Factory $factory
	 *
	 * @return void
	 */
	public static function bind(Factory $factory)
	{
		Container::extensionMethod(
			'addWordcha',
			function ($container, $name = 'captcha', $label = 'Captcha') use ($factory) {
				return $container[$name] = new WordchaContainer($factory);
			}
		);
	}

}
