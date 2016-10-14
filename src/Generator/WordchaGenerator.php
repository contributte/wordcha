<?php

namespace Minetro\Wordcha\Generator;

use Minetro\Wordcha\DataSource\DataSource;

class WordchaGenerator implements Generator
{

    /**
     * @var DataSource
     */
    private $dataSource;

    /**
     * WordchaGenerator constructor.
     * @param DataSource $dataSource
     */
    public function __construct(DataSource $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return Security
     */
    public function generate()
    {
        $pair = $this->dataSource->get();
        $hash = $this->hash($pair->getAnswer());
        $question = $pair->getQuestion();

        $security = new Security($question, $hash);

        return $security;
    }

    /**
     * @param string $answer
     * @return string
     */
    public function hash($answer)
    {
        return md5($answer, 'AAAA'); //TODO
    }

}