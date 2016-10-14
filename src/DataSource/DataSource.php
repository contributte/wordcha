<?php

namespace Minetro\Wordcha\DataSource;

interface DataSource
{
    /**
     * @return Pair
     */
    public function get();
}