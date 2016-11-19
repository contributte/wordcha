<?php

namespace Minetro\Wordcha\Validator;

use Minetro\Wordcha\Generator\Generator;

/**
 * Class WordchaValidator
 *
 * @package Minetro\Wordcha\Validator
 */
class WordchaValidator implements Validator
{

	/** @var Generator */
	private $generator;

	/**
	 * NumericValidator constructor.
	 *
	 * @param Generator $generator
	 */
	public function __construct(Generator $generator)
	{
		$this->generator = $generator;
	}

	/**
	 * @param string $answer
	 * @param string $hash
	 *
	 * @return bool
	 */
	public function validate($answer, $hash)
	{
		$answerHash = $this->generator->hash($answer);

		return $hash === $answerHash;
	}

}
