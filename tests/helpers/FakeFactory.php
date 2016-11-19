<?php

use Minetro\Wordcha\Factory;
use Minetro\Wordcha\Generator\Generator;
use Minetro\Wordcha\Validator\Validator;

/**
 * Class FakeFactory
 */
final class FakeFactory implements Factory
{

	/** @var bool */
	private $pass;

	/**
	 * FakeFactory constructor.
	 *
	 * @param bool $pass
	 */
	public function __construct($pass)
	{
		$this->pass = $pass;
	}

	/**
	 * @return Validator
	 */
	public function createValidator()
	{
		return new FakeValidator($this->pass);
	}

	/**
	 * @return Generator
	 */
	public function createGenerator()
	{
		return new FakeGenerator();
	}

}
