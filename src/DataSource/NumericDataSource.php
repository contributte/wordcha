<?php declare(strict_types = 1);

namespace Contributte\Wordcha\DataSource;

use Nette\InvalidArgumentException;

class NumericDataSource implements DataSource
{

	private int $min;

	private int $max;

	public function __construct(int $min = 0, int $max = 10)
	{
		if ($min > $max) {
			throw new InvalidArgumentException(sprintf('Min (%d) must be less than or equal to max (%d)', $min, $max));
		}

		$this->min = $min;
		$this->max = $max;
	}

	public function get(): Pair
	{
		$numberA = $this->generateNumber();
		$numberB = $this->generateNumber();

		$question = sprintf('%s + %s', $numberA, $numberB);
		$answer = $numberA + $numberB;

		return new Pair($question, (string) $answer);
	}

	private function generateNumber(): int
	{
		return random_int($this->min, $this->max);
	}

}
