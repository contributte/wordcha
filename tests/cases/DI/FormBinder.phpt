<?php

/**
 * Test: DI\FormBinder
 */

use Minetro\Wordcha\DI\FormBinder;

use Nette\Forms\Form;

require_once __DIR__ . '/../../bootstrap.php';

test(function () {
	$factory = new FakeFactory();
	FormBinder::bind($factory);

	$form = new Form();
	$captcha = $form->addWordcha();

//	Assert::type(CaptchaContainer::class, $captcha);
//	Assert::type(CaptchaImage::class, $captcha['image']);
//	Assert::type(CaptchaInput::class, $captcha['code']);
//	Assert::type(CaptchaHash::class, $captcha['hash']);
//
//	Assert::equal(FakeSeznamCaptcha::HASH, $captcha['hash']->getHash());
//	Assert::equal(FakeSeznamCaptcha::IMAGE, $captcha['image']->getImage());
});
