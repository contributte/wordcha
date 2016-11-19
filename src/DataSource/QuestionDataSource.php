<?php

namespace Minetro\Wordcha\DataSource;

use Exception;
use Nette\InvalidArgumentException;

/**
 * Class QuestionDataSource
 *
 * @package Minetro\Wordcha\DataSource
 */
class QuestionDataSource implements DataSource
{

	/** @var array */
	private $questions;

	/**
	 * QuestionDataSource constructor.
	 *
	 * @param array $questions
	 */
	public function __construct(array $questions)
	{
		$this->questions = $questions;
	}

	/**
	 * @return Pair
	 * @throws Exception
	 */
	public function get()
	{
		if (empty($this->questions)) {
			throw new InvalidArgumentException('Questions are empty');
		}

		$key    = array_rand($this->questions);
		$answer = $this->questions[$key];
		$pair   = new Pair($key, $answer);

		return $pair;
	}

}
