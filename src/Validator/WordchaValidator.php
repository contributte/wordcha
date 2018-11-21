<?php declare(strict_types = 1);

namespace Contributte\Wordcha\Validator;

use Contributte\Wordcha\Generator\Generator;

class WordchaValidator implements Validator
{

	/** @var Generator */
	private $generator;

	public function __construct(Generator $generator)
	{
		$this->generator = $generator;
	}

	public function validate(string $answer, string $hash): bool
	{
		$answerHash = $this->generator->hash($answer);

		return $hash === $answerHash;
	}

}
