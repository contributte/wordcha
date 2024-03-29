<?php declare(strict_types = 1);

namespace Contributte\Wordcha\DI;

use Contributte\Wordcha\Factory;
use Contributte\Wordcha\Form\WordchaContainer;
use Nette\Forms\Container;

final class FormBinder
{

	public static function bind(Factory $factory): void
	{
		Container::extensionMethod(
			'addWordcha',
			fn (Container $container, string $name = 'captcha', string $label = 'Captcha'): WordchaContainer => $container[$name] = new WordchaContainer($factory) // @phpcs:ignore
		);
	}

}
