<?php

namespace Contributte\Wordcha\Generator;

/**
 * Class Security
 *
 * @package Contributte\Wordcha\Generator
 */
class Security
{

	/** @var string */
	private $question;

	/** @var string */
	private $hash;

	/**
	 * Security constructor.
	 *
	 * @param string $question
	 * @param string $hash
	 */
	public function __construct($question, $hash)
	{
		$this->question = $question;
		$this->hash = $hash;
	}

	/**
	 * @return string
	 */
	public function getQuestion()
	{
		return $this->question;
	}

	/**
	 * @return string
	 */
	public function getHash()
	{
		return $this->hash;
	}

}
