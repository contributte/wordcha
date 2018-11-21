<?php declare(strict_types = 1);

namespace Contributte\Wordcha\Generator;

class Security
{

	/** @var string */
	private $question;

	/** @var string */
	private $hash;

	public function __construct(string $question, string $hash)
	{
		$this->question = $question;
		$this->hash = $hash;
	}

	public function getQuestion(): string
	{
		return $this->question;
	}

	public function getHash(): string
	{
		return $this->hash;
	}

}
