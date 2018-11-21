<?php declare(strict_types = 1);

namespace Contributte\Wordcha\Generator;

interface Generator
{

	public function generate(): Security;

	public function hash(string $answer): string;

}
