<?php

namespace Contributte\Wordcha\Validator;

/**
 * Interface Validator
 *
 * @package Contributte\Wordcha\Validator
 */
interface Validator
{

	/**
	 * @param string $answer
	 * @param string $hash
	 *
	 * @return bool
	 */
	public function validate($answer, $hash);

}
