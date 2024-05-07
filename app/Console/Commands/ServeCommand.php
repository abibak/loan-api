<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeCommand extends Command
{
    protected $signature = 'serve {--host=} {--port=}';

    protected $description = 'Command starting development server.';

    public function handle()
    {
        exec($this->serveCommand());
    }

    private function serveCommand(): string
    {
        return 'php -S ' . $this->host() . ':' . $this->port() . ' -t ' . base_path('public');
    }

    private function host(): string
    {
        return $this->input->getOption('host') ??
            parse_url(getenv('APP_URL'), PHP_URL_HOST) ??
            'localhost';
    }

    private function port(): int
    {
        return $this->input->getOption('port') ??
            parse_url(getenv('APP_URL'), PHP_URL_PORT) ??
            9090;
    }
}
