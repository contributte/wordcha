<?php declare(strict_types = 1);

namespace Contributte\Wordcha\DataSource;

class NumericDataSource implements DataSource
{

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
		return random_int(0, 10);
	}

}
