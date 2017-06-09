<?php

namespace Contributte\Wordcha;

use Contributte\Wordcha\Generator\Generator;
use Contributte\Wordcha\Validator\Validator;

/**
 * Interface Factory
 *
 * @package Contributte\Wordcha
 */
interface Factory
{

	/**
	 * @return Validator
	 */
	public function createValidator();

	/**
	 * @return Generator
	 */
	public function createGenerator();

}
