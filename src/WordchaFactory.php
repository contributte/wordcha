<?php

namespace Minetro\Wordcha;

use Minetro\Wordcha\DataSource\DataSource;
use Minetro\Wordcha\Generator\WordchaGenerator;
use Minetro\Wordcha\Validator\WordchaValidator;

/**
 * Class WordchaFactory
 *
 * @package Minetro\Wordcha
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
