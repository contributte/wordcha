<?php

namespace Minetro\Wordcha\DataSource;

use Exception;

class QuestionDataSource implements DataSource
{
    /**
     * @var array
     */
    private $questions;

    public function __construct(array $questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return Pair
     * @throws Exception
     */
    public function get()
    {
        if (empty($this->questions)) {
            throw new Exception('Questions are empty');
        }

        $key = array_rand($this->questions);
        $answer = $this->questions[$key];

        //TODO ok, přesunout do toLower, nebo použítí Strings::toLower?
        $answer = mb_strtolower($answer, 'UTF-8');

        $pair = new Pair($key, $answer);
        return $pair;
    }

}