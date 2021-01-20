<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Credit;

class CreditApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_credit()
    {
        $credit = factory(Credit::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/credits', $credit
        );

        $this->assertApiResponse($credit);
    }

    /**
     * @test
     */
    public function test_read_credit()
    {
        $credit = factory(Credit::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/credits/'.$credit->id
        );

        $this->assertApiResponse($credit->toArray());
    }

    /**
     * @test
     */
    public function test_update_credit()
    {
        $credit = factory(Credit::class)->create();
        $editedCredit = factory(Credit::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/credits/'.$credit->id,
            $editedCredit
        );

        $this->assertApiResponse($editedCredit);
    }

    /**
     * @test
     */
    public function test_delete_credit()
    {
        $credit = factory(Credit::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/credits/'.$credit->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/credits/'.$credit->id
        );

        $this->response->assertStatus(404);
    }
}
