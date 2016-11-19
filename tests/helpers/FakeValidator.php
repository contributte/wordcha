<?php

use Minetro\Wordcha\Validator\Validator;

/**
 * Class FakeValidator
 */
class FakeValidator implements Validator
{

	/** @var bool */
	private $pass;

	/**
	 * FakeValidator constructor.
	 *
	 * @param bool $pass
	 */
	public function __construct($pass)
	{
		$this->pass = $pass;
	}

	/**
	 * @param string $answer
	 * @param string $hash
	 *
	 * @return bool
	 */
	public function validate($answer, $hash)
	{
		return $this->pass;
	}

}
