<?php

namespace Pug\Filter;

use Pug\AbstractFilter as BaseFilter;

class Base extends BaseFilter
{
    public function __invoke($code, array $options = null)
    {
        return $code;
    }
}
