<?php

/**
 * Test: Forms/WordchaContainer
 */

use Minetro\Wordcha\Form\WordchaContainer;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Controls\TextInput;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

test(function () {
	$factory = new FakeFactory(TRUE);
	$captcha = new WordchaContainer($factory);
	Assert::type(WordchaContainer::class, $captcha);
	Assert::type(TextInput::class, $captcha['question']);
	Assert::type(HiddenField::class, $captcha['hash']);

	Assert::equal(FakeGenerator::HASH, $captcha['hash']->getValue());
});

test(function () {
	$captcha   = new WordchaContainer(new FakeFactory(TRUE));
	$validator = $captcha->getValidator();

	//	 Always true, because of FakeSeznamCaptcha($pass)
	Assert::true($validator->validate('foo', 'bar'));
});

test(function () {
	$captcha   = new WordchaContainer(new FakeFactory($pass = FALSE));
	$validator = $captcha->getValidator();

	// Always false, because of FakeSeznamCaptcha($pass)
	Assert::false($validator->validate('foo', 'bar'));
});
