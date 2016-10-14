<?php

namespace Minetro\Wordcha;

use Minetro\Wordcha\Generator\Generator;
use Minetro\Wordcha\Validator\Validator;

interface Factory
{

    /**
     * @return Validator
     */
    public function createValidator();

    /**
     * @return Generator
     */
    public function createGenerator();

}