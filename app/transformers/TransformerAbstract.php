<?php

namespace App\Transformers;

abstract class TransformerAbstract
{
    public function transformCollection($items)
    {
        return array_map([$this, 'transform'], $items);
    }

    abstract public function transform($item);
}