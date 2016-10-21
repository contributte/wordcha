<?php

namespace Minetro\Wordcha;

use Minetro\Wordcha\DataSource\DataSource;

class WordchaUniqueFactory extends WordchaFactory
{

    /** @var string */
    private $uniqueKey;

    /**
     * NumericFactory constructor.
     * @param DataSource $dataSource
     * @param string $uniqueKey
     */
    public function __construct(DataSource $dataSource, $uniqueKey)
    {
        parent::__construct($dataSource);

        $this->uniqueKey = $uniqueKey;
    }

    public function createGenerator()
    {
        $generator = parent::createGenerator();
        $generator->setUniqueKey($this->uniqueKey);

        return $generator;
    }

}