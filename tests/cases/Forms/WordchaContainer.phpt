<?php declare(strict_types = 1);

/**
 * Test: Form\WordchaContainer
 */

use Contributte\Wordcha\Factory;
use Contributte\Wordcha\Form\WordchaContainer;
use Contributte\Wordcha\Generator\Generator;
use Contributte\Wordcha\Generator\Security;
use Contributte\Wordcha\Validator\Validator;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Controls\TextInput;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

test(function (): void {
	$hash = '12345';
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

	$captcha = new WordchaContainer($factory);
	Assert::type(WordchaContainer::class, $captcha);
	Assert::type(TextInput::class, $captcha['question']);
	Assert::type(HiddenField::class, $captcha['hash']);

	Assert::equal($hash, $captcha['hash']->getValue());
});

test(function (): void {
	$hash = '12345';
	$validator = Mockery::mock(Validator::class)
		->shouldReceive('validate')
		->andReturn(true)
		->getMock();

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

	$captcha = new WordchaContainer($factory);
	$validator = $captcha->getValidator();

	Assert::true($validator->validate('foo', 'bar'));
});

test(function (): void {
	$hash = '12345';

	$validator = Mockery::mock(Validator::class)
		->shouldReceive('validate')
		->andReturn(false)
		->getMock();

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

	$captcha = new WordchaContainer($factory);
	$validator = $captcha->getValidator();

	Assert::false($validator->validate('foo', 'bar'));
});
