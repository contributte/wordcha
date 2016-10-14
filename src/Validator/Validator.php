<?php

namespace Minetro\Wordcha\Validator;

interface Validator
{
    /**
     * @param string $answer
     * @param string $hash
     * @return bool
     */
    public function validate($answer, $hash);
}
