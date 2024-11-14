<?php

namespace App\Utils;

use Faker\Factory as Faker;

class JobFaker
{
    const CLASSES_AVAILABLE = [
        'CounterService' => 'countTo',
        'ErrorService' => 'arrayError',
        'HelloService' => 'sayHello',
    ];

    public function generateJob()
    {
        $faker = Faker::create();

        $class = $faker->randomKey(self::CLASSES_AVAILABLE);
        $method = self::CLASSES_AVAILABLE[$class];
        $delay = $faker->numberBetween(0, 3);
        $highPriority = $faker->boolean;
        $params = [$faker->numberBetween(1, 30)];

        return [
            'class' => $class,
            'method' => $method,
            'delay' => $delay,
            'high_priority' => $highPriority,
            'params' => $params,
        ];
    }
}
