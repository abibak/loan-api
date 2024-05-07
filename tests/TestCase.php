<?php

namespace Tests;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;

    protected $token;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');

        $this->insertTestData();

        $response = $this->json('POST', 'api/login', [
            'email' => 'user@mail.ru',
            'password' => 'pass123'
        ]);

        $response->assertResponseOk();
        $this->token = $response->response['data']['token'];
    }

    public function insertTestData(): void
    {
        User::create([
            'email' => 'user@mail.ru',
            'password' => Hash::make('pass123'),
        ]);

        Loan::create([
            'user_id' => 1,
            'amount' => rand(10000, 100000)
        ]);
    }
}
