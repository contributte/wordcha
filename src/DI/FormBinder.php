<?php

namespace Minetro\Wordcha\DI;

use Minetro\Wordcha\Factory;
use Minetro\Wordcha\Form\WordchaContainer;
use Nette\Forms\Container;

final class FormBinder
{
    /**
     * @param Factory $factory
     */
    public static function bind(Factory $factory)
    {
        Container::extensionMethod('addWordcha', function ($container, $name = 'captcha') use ($factory) {
            return $container[$name] = new WordchaContainer($factory);
        });
    }
}