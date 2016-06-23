<?php

namespace Pug\Filter;

use Jade\Compiler;
use Jade\Nodes\Filter;
use Jade\Filter\AbstractFilter;

class Base extends AbstractFilter
{
    public function __invoke(Filter $node, Compiler $compiler)
    {
        return $this->getNodeString($node, $compiler);
    }
}
