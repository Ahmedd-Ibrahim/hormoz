<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserProduct;

class UserProductApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_product()
    {
        $userProduct = factory(UserProduct::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_products', $userProduct
        );

        $this->assertApiResponse($userProduct);
    }

    /**
     * @test
     */
    public function test_read_user_product()
    {
        $userProduct = factory(UserProduct::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/user_products/'.$userProduct->id
        );

        $this->assertApiResponse($userProduct->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_product()
    {
        $userProduct = factory(UserProduct::class)->create();
        $editedUserProduct = factory(UserProduct::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_products/'.$userProduct->id,
            $editedUserProduct
        );

        $this->assertApiResponse($editedUserProduct);
    }

    /**
     * @test
     */
    public function test_delete_user_product()
    {
        $userProduct = factory(UserProduct::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_products/'.$userProduct->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_products/'.$userProduct->id
        );

        $this->response->assertStatus(404);
    }
}
