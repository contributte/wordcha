<?php

namespace Minetro\Wordcha\Generator;

use Minetro\Wordcha\DataSource\DataSource;

/**
 * Class WordchaGenerator
 *
 * @package Minetro\Wordcha\Generator
 */
class WordchaGenerator implements Generator
{

	/** @var DataSource */
	private $dataSource;

	/** @var string */
	private $uniqueKey;

	/**
	 * WordchaGenerator constructor.
	 *
	 * @param DataSource $dataSource
	 */
	public function __construct(DataSource $dataSource)
	{
		$this->dataSource = $dataSource;
	}

	/**
	 * @param string $uniqueKey
	 */
	public function setUniqueKey($uniqueKey)
	{
		$this->uniqueKey = $uniqueKey;
	}

	/**
	 * @return Security
	 */
	public function generate()
	{
		$pair     = $this->dataSource->get();
		$hash     = $this->hash($pair->getAnswer());
		$question = $pair->getQuestion();

		$security = new Security($question, $hash);

		return $security;
	}

	/**
	 * @param string $answer
	 *
	 * @return string
	 */
	public function hash($answer)
	{
		if ($this->uniqueKey) {
			$answer .= $this->uniqueKey;
		}

		return md5($answer); //TODO vybrat hashovací funkci
	}

}