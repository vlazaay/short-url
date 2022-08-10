<?php

declare(strict_types=1);

namespace App\Specifications;

use App\Models\ShortLink;

interface Specification
{
    public function isSatisfiedBy(ShortLink $shortLink): bool;
}
