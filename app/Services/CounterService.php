<?php

namespace App\Services;

class CounterService
{
    public function countTo($limit = 1000)
    {
        $output = '';
        for ($i = 1; $i <= $limit; $i++) {
            $output .= $i . PHP_EOL;
            sleep(1);
        }
        return $output;
    }
}
