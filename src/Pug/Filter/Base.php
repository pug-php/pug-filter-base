<?php

namespace Pug\Filter;

use Jade\Compiler;
use Jade\Filter\AbstractFilter;
use Jade\Nodes\Filter;

class Base extends AbstractFilter
{
    public function __invoke(Filter $node, Compiler $compiler)
    {
        return $this->getNodeString($node, $compiler);
    }
}
