<?php

namespace Tests;


class LoanControllerTest extends TestCase
{
    protected $headers = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->headers = [
            'Authorization' => $this->token
        ];
    }

    public function tearDown(): void
    {
        $this->headers = [];
    }

//    public function testSuccessfullyGetAllLoans()
//    {
//        $response = $this->json('GET', 'api/loans', [], $this->headers)->seeJson([
//            'data' => [
//                'current_page',
//                'data' => [
//                    'id',
//                    'user_id',
//                    'amount',
//                    'status',
//                    'created_at',
//                    'updated_at',
//                ],
//                'first_page_url',
//                'from',
//                'next_page_url',
//                'path',
//                'per_page',
//                'prev_page_url',
//                'to',
//            ],
//            'message',
//        ]);
//
//        $response->assertResponseOk();
//    }

    public function testSuccessfullyLoanCreate()
    {
        $data = [
            "user_id" => 1,
            "amount" => rand(10000, 100000),
        ];

        $response = $this->json('POST', 'api/loans', $data, $this->headers)->seeJsonStructure(
            [
                'data' => [
                    'id',
                    'user_id',
                    'amount',
                    'created_at',
                    'updated_at',
                ],
                'message',
            ]);

        $response->assertResponseStatus(201);
    }

    public function testSuccessfullyLoanUpdateData()
    {
        $data = [
            'amount' => 111111,
            'status' => false,
        ];

        $response = $this->json('PUT', 'api/loans/1', $data, $this->headers)->seeJsonStructure(
            [
                'data' => [
                    'id',
                    'user_id',
                    'amount',
                    'status',
                    'created_at',
                    'updated_at',
                ],
                'message',
            ]);

        $response->assertResponseOk();
    }

    public function testGetModelDataById()
    {
        $response = $this->json('GET', 'api/loans/1', [], $this->headers)->seeJsonStructure(
            [
                'data' => [
                    'id',
                    'user_id',
                    'amount',
                    'status',
                    'created_at',
                    'updated_at',
                ],
                'message',
            ]);

        $response->assertResponseOk();
    }

    public function testSuccessfullyDeleteModelById()
    {
        $response = $this->json('DELETE', 'api/loans/1', [], $this->headers)->seeJsonStructure(
            [
                'data' => [
                    'id',
                    'user_id',
                    'amount',
                    'status',
                    'created_at',
                    'updated_at',
                ],
                'message',
            ]);

        $response->assertResponseOk();
    }
}
