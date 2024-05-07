<?php

namespace App\Console\Commands;

use App\Traits\HelperEnvTrait;
use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;

class GenerateKeyCommand extends Command
{
    use HelperEnvTrait;

    private string $key = 'APP_KEY';

    protected $signature = 'key:generate';

    protected $description = 'Generate key application.';

    public function handle(): void
    {
        $this->setEnvValue($this->key, $this->generateRandomKey());
        $this->info('App key set successfully.');
    }

    private function generateRandomKey(): string
    {
        return 'base64:' . base64_encode(Encrypter::generateKey($this->laravel['config']['app.cipher']));
    }
}
