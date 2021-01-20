<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserStore;

class UserStoreApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_store()
    {
        $userStore = factory(UserStore::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_stores', $userStore
        );

        $this->assertApiResponse($userStore);
    }

    /**
     * @test
     */
    public function test_read_user_store()
    {
        $userStore = factory(UserStore::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/user_stores/'.$userStore->id
        );

        $this->assertApiResponse($userStore->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_store()
    {
        $userStore = factory(UserStore::class)->create();
        $editedUserStore = factory(UserStore::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_stores/'.$userStore->id,
            $editedUserStore
        );

        $this->assertApiResponse($editedUserStore);
    }

    /**
     * @test
     */
    public function test_delete_user_store()
    {
        $userStore = factory(UserStore::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_stores/'.$userStore->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_stores/'.$userStore->id
        );

        $this->response->assertStatus(404);
    }
}
