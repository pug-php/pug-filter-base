<?php

namespace Jade\Filter;

use Jade\Compiler;
use Jade\Nodes\Filter;

class Base extends AbstractFilter
{
    public function __invoke(Filter $node, Compiler $compiler)
    {
        return $this->getNodeString($node, $compiler);
    }
}
