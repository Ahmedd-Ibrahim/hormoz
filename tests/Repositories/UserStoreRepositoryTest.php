<?php namespace Tests\Repositories;

use App\Models\UserStore;
use App\Repositories\UserStoreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserStoreRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserStoreRepository
     */
    protected $userStoreRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userStoreRepo = \App::make(UserStoreRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_store()
    {
        $userStore = factory(UserStore::class)->make()->toArray();

        $createdUserStore = $this->userStoreRepo->create($userStore);

        $createdUserStore = $createdUserStore->toArray();
        $this->assertArrayHasKey('id', $createdUserStore);
        $this->assertNotNull($createdUserStore['id'], 'Created UserStore must have id specified');
        $this->assertNotNull(UserStore::find($createdUserStore['id']), 'UserStore with given id must be in DB');
        $this->assertModelData($userStore, $createdUserStore);
    }

    /**
     * @test read
     */
    public function test_read_user_store()
    {
        $userStore = factory(UserStore::class)->create();

        $dbUserStore = $this->userStoreRepo->find($userStore->id);

        $dbUserStore = $dbUserStore->toArray();
        $this->assertModelData($userStore->toArray(), $dbUserStore);
    }

    /**
     * @test update
     */
    public function test_update_user_store()
    {
        $userStore = factory(UserStore::class)->create();
        $fakeUserStore = factory(UserStore::class)->make()->toArray();

        $updatedUserStore = $this->userStoreRepo->update($fakeUserStore, $userStore->id);

        $this->assertModelData($fakeUserStore, $updatedUserStore->toArray());
        $dbUserStore = $this->userStoreRepo->find($userStore->id);
        $this->assertModelData($fakeUserStore, $dbUserStore->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_store()
    {
        $userStore = factory(UserStore::class)->create();

        $resp = $this->userStoreRepo->delete($userStore->id);

        $this->assertTrue($resp);
        $this->assertNull(UserStore::find($userStore->id), 'UserStore should not exist in DB');
    }
}
