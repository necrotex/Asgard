<?php

namespace Asgard\Support;

trait Hashidable
{
    public function getRouteKey()
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}