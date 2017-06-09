<?php

namespace Contributte\Wordcha;

use Contributte\Wordcha\DataSource\DataSource;
use Contributte\Wordcha\Generator\WordchaGenerator;

/**
 * Class WordchaUniqueFactory
 *
 * @package Contributte\Wordcha
 */
class WordchaUniqueFactory extends WordchaFactory
{

	/** @var string */
	private $uniqueKey;

	/**
	 * NumericFactory constructor.
	 *
	 * @param DataSource $dataSource
	 * @param string $uniqueKey
	 */
	public function __construct(DataSource $dataSource, $uniqueKey)
	{
		parent::__construct($dataSource);

		$this->uniqueKey = $uniqueKey;
	}

	/**
	 * @return WordchaGenerator
	 */
	public function createGenerator()
	{
		$generator = parent::createGenerator();
		$generator->setUniqueKey($this->uniqueKey);

		return $generator;
	}

}
