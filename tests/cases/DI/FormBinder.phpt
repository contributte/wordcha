<?php

/**
 * Test: DI\FormBinder
 */

use Minetro\Wordcha\DI\FormBinder;

use Minetro\Wordcha\Form\WordchaContainer;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

test(function () {
	$factory = new FakeFactory(TRUE);
	FormBinder::bind($factory);

	$form = new Form();
	$captcha = $form->addWordcha();

	Assert::type(WordchaContainer::class, $captcha);
	Assert::type(TextInput::class, $captcha['question']);
	Assert::type(HiddenField::class, $captcha['hash']);

	Assert::equal(FakeGenerator::HASH, $captcha['hash']->getValue());
});
