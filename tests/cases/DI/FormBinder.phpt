<?php

/**
 * Test: DI\FormBinder
 */

use Minetro\Wordcha\DI\FormBinder;
use Minetro\Wordcha\Factory;
use Minetro\Wordcha\Form\WordchaContainer;
use Minetro\Wordcha\Generator\Generator;
use Minetro\Wordcha\Generator\Security;
use Minetro\Wordcha\Validator\Validator;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

test(function () {
	$hash      = '12345';
	$validator = Mockery::mock(Validator::class);

	$generator = Mockery::mock(Generator::class)
		->shouldReceive('generate')
		->andReturn(new Security('..', $hash))
		->getMock()
		->shouldReceive('hash')
		->andReturn($hash)
		->getMock();

	$factory = Mockery::mock(Factory::class)
		->shouldReceive('createValidator')
		->andReturn($validator)
		->shouldReceive('createGenerator')
		->andReturn($generator)
		->getMock();

	FormBinder::bind($factory);

	$form    = new Form();
	$captcha = $form->addWordcha();

	Assert::type(WordchaContainer::class, $captcha);
	Assert::type(TextInput::class, $captcha['question']);
	Assert::type(HiddenField::class, $captcha['hash']);

	Assert::equal($hash, $captcha['hash']->getValue());
});
