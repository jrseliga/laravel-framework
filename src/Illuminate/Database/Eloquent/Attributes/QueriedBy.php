<?php

namespace Illuminate\Database\Eloquent\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class QueriedBy
{
    /**
     * Create a new attribute instance.
     *
     * @param  class-string<\Illuminate\Database\Eloquent\Builder>  $builderClass
     * @return void
     */
    public function __construct(public string $builderClass)
    {
    }
}
