<?php

namespace Contributte\Wordcha\Generator;

/**
 * Interface Generator
 *
 * @package Contributte\Wordcha\Generator
 */
interface Generator
{

	/**
	 * @return Security
	 */
	public function generate();

	/**
	 * @param string $answer
	 *
	 * @return string
	 */
	public function hash($answer);

}
