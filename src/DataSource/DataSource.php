<?php

namespace Minetro\Wordcha\DataSource;

/**
 * Interface DataSource
 *
 * @package Minetro\Wordcha\DataSource
 */
interface DataSource
{

	/**
	 * @return Pair
	 */
	public function get();

}
