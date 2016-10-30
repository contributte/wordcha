<?php

namespace Minetro\Wordcha\Validator;

/**
 * Interface Validator
 *
 * @package Minetro\Wordcha\Validator
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
