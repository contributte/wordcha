<?php

namespace Minetro\Wordcha;

use Minetro\Wordcha\Generator\Generator;
use Minetro\Wordcha\Validator\Validator;

/**
 * Interface Factory
 *
 * @package Minetro\Wordcha
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