<?php

namespace Contributte\Wordcha;

use Contributte\Wordcha\DataSource\DataSource;
use Contributte\Wordcha\Generator\WordchaGenerator;
use Contributte\Wordcha\Validator\WordchaValidator;

/**
 * Class WordchaFactory
 *
 * @package Contributte\Wordcha
 */
class WordchaFactory implements Factory
{

	/** @var DataSource */
	private $dataSource;

	/**
	 * NumericFactory constructor.
	 *
	 * @param DataSource $dataSource
	 */
	public function __construct(DataSource $dataSource)
	{
		$this->dataSource = $dataSource;
	}

	/**
	 * @return WordchaValidator
	 */
	public function createValidator()
	{
		return new WordchaValidator($this->createGenerator());
	}

	/**
	 * @return WordchaGenerator
	 */
	public function createGenerator()
	{
		return new WordchaGenerator($this->dataSource);
	}

}
