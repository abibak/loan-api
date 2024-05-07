<?php

namespace App\Console\Commands;

use App\Traits\HelperEnvTrait;
use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;

class JWTGenerateSecretCommand extends Command
{
    use HelperEnvTrait;

    private string $key = 'JWT_SECRET';

    protected $signature = 'jwt:secret';

    protected $description = 'Generating secret jwt key';

    public function handle()
    {
        $this->setEnvValue($this->key, $this->generateSecretJwtKey());
        $this->info('Successfully set secret jwt key.');
    }

    public function generateSecretJwtKey(): string
    {
        return base64_encode(Encrypter::generateKey($this->laravel['config']['app.cipher']));
    }
}
