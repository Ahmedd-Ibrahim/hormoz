<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\mailing;

class mailingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mailing()
    {
        $mailing = factory(mailing::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/mailings', $mailing
        );

        $this->assertApiResponse($mailing);
    }

    /**
     * @test
     */
    public function test_read_mailing()
    {
        $mailing = factory(mailing::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/mailings/'.$mailing->id
        );

        $this->assertApiResponse($mailing->toArray());
    }

    /**
     * @test
     */
    public function test_update_mailing()
    {
        $mailing = factory(mailing::class)->create();
        $editedmailing = factory(mailing::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/mailings/'.$mailing->id,
            $editedmailing
        );

        $this->assertApiResponse($editedmailing);
    }

    /**
     * @test
     */
    public function test_delete_mailing()
    {
        $mailing = factory(mailing::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/mailings/'.$mailing->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/mailings/'.$mailing->id
        );

        $this->response->assertStatus(404);
    }
}
