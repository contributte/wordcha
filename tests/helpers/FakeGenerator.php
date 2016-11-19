<?php
use Minetro\Wordcha\Generator\Generator;
use Minetro\Wordcha\Generator\Security;

/**
 * Class FakeGenerator
 */
class FakeGenerator implements Generator
{

	const HASH = 'a1b2';

	/**
	 * @return Security
	 */
	public function generate()
	{
		return new Security('...', self::HASH);
	}

	/**
	 * @param string $answer
	 *
	 * @return string
	 */
	public function hash($answer)
	{
		return self::HASH;
	}

}
