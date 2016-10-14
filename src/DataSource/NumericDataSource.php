<?php

namespace Minetro\Wordcha\DataSource;

class NumericDataSource implements DataSource
{

    /**
     * @return Pair
     */
    public function get()
    {
        $question = '1 + 1';
        $answer = '2';

        $pair = new Pair($question, $answer);

        return $pair;
    }
}