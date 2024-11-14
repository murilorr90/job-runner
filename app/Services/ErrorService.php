<?php

namespace App\Services;

use Carbon\Carbon;

class ErrorService
{
    public function arrayError($array = [])
    {
        return $array['subArrayUndefined'];
    }
}
