<?php

namespace App\Specifications;

use App\Models\ShortLink;
use Carbon\Carbon;

class LifetimeSpecification implements Specification
{
    public function isSatisfiedBy(ShortLink $shortLink): bool
    {
        return Carbon::now()->lte(Carbon::parse($shortLink->lifetime));
    }
}
