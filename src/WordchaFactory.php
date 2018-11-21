<?php declare(strict_types = 1);

namespace Contributte\Wordcha;

use Contributte\Wordcha\DataSource\DataSource;
use Contributte\Wordcha\Generator\Generator;
use Contributte\Wordcha\Generator\WordchaGenerator;
use Contributte\Wordcha\Validator\Validator;
use Contributte\Wordcha\Validator\WordchaValidator;

class WordchaFactory implements Factory
{

	/** @var DataSource */
	private $dataSource;

	public function __construct(DataSource $dataSource)
	{
		$this->dataSource = $dataSource;
	}

	/**
	 * @return WordchaValidator
	 */
	public function createValidator(): Validator
	{
		return new WordchaValidator($this->createGenerator());
	}

	/**
	 * @return WordchaGenerator
	 */
	public function createGenerator(): Generator
	{
		return new WordchaGenerator($this->dataSource);
	}

}
