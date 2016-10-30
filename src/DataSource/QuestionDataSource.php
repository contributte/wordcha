<?php

namespace Minetro\Wordcha\DataSource;

use Exception;
use Nette\Utils\AssertionException;
use Nette\Utils\Strings;

/**
 * Class QuestionDataSource
 *
 * @package Minetro\Wordcha\DataSource
 */
class QuestionDataSource implements DataSource
{

	/**
	 * @var array
	 */
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
			throw new AssertionException('Questions are empty'); //TODO jakou exception?
		}

		$key    = array_rand($this->questions);
		$answer = $this->questions[$key];
		$answer = Strings::lower($answer);
		$pair   = new Pair($key, $answer);

		return $pair;
	}

}