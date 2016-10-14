<?php

namespace Minetro\Wordcha\Validator;

use Minetro\Wordcha\Generator\Generator;

class WordchaValidator implements Validator
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * NumericValidator constructor.
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param $answer
     * @param $hash
     * @return bool
     */
    public function validate($answer, $hash)
    {
        return $hash === $this->generator->hash($answer);
    }
}