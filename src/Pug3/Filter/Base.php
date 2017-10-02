<?php

namespace Pug\Filter;

use Pug\AbstractFilter as BasFilter;

class Base extends BasFilter
{
    public function __invoke($code, array $options = null)
    {
        return $code;
    }
}
