<?php
namespace App\Services;

use Carbon\Carbon;

class ShortLinkService
{
    public function prepareDate(Carbon $date)
    {
        $result = $date->lte(Carbon::now());
        if ($result) {
            return $date->addDay();
        }
        return $date;
    }
}
