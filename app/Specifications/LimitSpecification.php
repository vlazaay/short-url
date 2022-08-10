<?php

namespace App\Specifications;

use App\Models\ShortLink;

class LimitSpecification implements Specification
{
    public function isSatisfiedBy(ShortLink $shortLink): bool
    {
        if ($shortLink->limit === 0) {
            return true;
        }
        return $shortLink->count < $shortLink->limit;
    }
}
