<?php declare(strict_types = 1);

namespace Contributte\Wordcha\DataSource;

use Exception;
use Nette\InvalidArgumentException;

class QuestionDataSource implements DataSource
{

	/** @var array<string, string> Pairs of question:answer */
	private array $questions;

	/**
	 * @param array<string, string> $questions
	 */
	public function __construct(array $questions)
	{
		$this->questions = $questions;
	}

	/**
	 * @throws Exception
	 */
	public function get(): Pair
	{
		if ($this->questions === []) {
			throw new InvalidArgumentException('Questions are empty');
		}

		$question = array_rand($this->questions);
		$answer = $this->questions[$question];

		return new Pair($question, $answer);
	}

}
