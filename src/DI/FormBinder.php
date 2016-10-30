<?php

namespace Minetro\Wordcha\DI;

use Minetro\Wordcha\Factory;
use Minetro\Wordcha\Form\WordchaContainer;
use Nette\Forms\Container;

/**
 * Class FormBinder
 *
 * @package Minetro\Wordcha\DI
 */
final class FormBinder
{

	/**
	 * @param Factory $factory
	 */
	public static function bind(Factory $factory)
	{
		Container::extensionMethod('addWordcha',
			function ($container, $name = 'captcha', $label = 'Captcha') use ($factory) {

				return $container[$name] = new WordchaContainer($factory);
			});
	}
}