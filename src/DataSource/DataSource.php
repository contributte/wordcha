<?php

namespace Contributte\Wordcha\DataSource;

/**
 * Interface DataSource
 *
 * @package Contributte\Wordcha\DataSource
 */
interface DataSource
{

	/**
	 * @return Pair
	 */
	public function get();

}
