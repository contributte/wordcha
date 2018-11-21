<?php declare(strict_types = 1);

namespace Contributte\Wordcha;

use Contributte\Wordcha\Generator\Generator;
use Contributte\Wordcha\Validator\Validator;

interface Factory
{

	public function createValidator(): Validator;

	public function createGenerator(): Generator;

}
