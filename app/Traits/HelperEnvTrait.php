<?php

namespace App\Traits;

trait HelperEnvTrait
{
    public function setEnvValue(string $set, string|int $value): void
    {
        $getEnv = explode("\n", file_get_contents(base_path('.env')));

        foreach ($getEnv as $index => $key) {
            if (str_starts_with($key, $set . '=')) {
                $getEnv[$index] = $set . '=' . $value;
            }
        }

        file_put_contents(base_path('.env'), implode("\n", $getEnv));
    }
}
