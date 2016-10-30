<?php

use Minetro\Wordcha\Validator\Validator;

/**
 * Class FakeValidator
 */
class FakeValidator implements Validator
{

	/**
	 * @param string $answer
	 * @param string $hash
	 *
	 * @return bool
	 */
	public function validate($answer, $hash)
	{
		return TRUE;
	}
}