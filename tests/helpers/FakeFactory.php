<?php

use Minetro\Wordcha\Factory;
use Minetro\Wordcha\Generator\Generator;
use Minetro\Wordcha\Validator\Validator;

/**
 * Class FakeFactory
 */
final class FakeFactory implements Factory
{

	/**
	 * @return Validator
	 */
	public function createValidator()
	{
		return new FakeValidator();
	}

	/**
	 * @return Generator
	 */
	public function createGenerator()
	{
		return new FakeGenerator();
	}
}
