<?php

if (!function_exists('runBackgroundJob')) {
    function runBackgroundJob(string $className, string $methodName, array $params = [], $delay = 0, $highPriority = false)
    {
        $paramsString = implode(',', $params);

        $delayString = $delay > 0 ? "--delay=$delay" : '';
        $highPriorityString = $highPriority ? '--high-priority' : '';

        $command = "php " . base_path('artisan') . " startJob $className $methodName --params=\"$paramsString\" $delayString $highPriorityString > /dev/null 2>&1 &";

        exec($command);
    }
}
