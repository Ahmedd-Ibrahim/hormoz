<?php namespace Tests\Repositories;

use App\Models\UserProduct;
use App\Repositories\UserProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserProductRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserProductRepository
     */
    protected $userProductRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userProductRepo = \App::make(UserProductRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_product()
    {
        $userProduct = factory(UserProduct::class)->make()->toArray();

        $createdUserProduct = $this->userProductRepo->create($userProduct);

        $createdUserProduct = $createdUserProduct->toArray();
        $this->assertArrayHasKey('id', $createdUserProduct);
        $this->assertNotNull($createdUserProduct['id'], 'Created UserProduct must have id specified');
        $this->assertNotNull(UserProduct::find($createdUserProduct['id']), 'UserProduct with given id must be in DB');
        $this->assertModelData($userProduct, $createdUserProduct);
    }

    /**
     * @test read
     */
    public function test_read_user_product()
    {
        $userProduct = factory(UserProduct::class)->create();

        $dbUserProduct = $this->userProductRepo->find($userProduct->id);

        $dbUserProduct = $dbUserProduct->toArray();
        $this->assertModelData($userProduct->toArray(), $dbUserProduct);
    }

    /**
     * @test update
     */
    public function test_update_user_product()
    {
        $userProduct = factory(UserProduct::class)->create();
        $fakeUserProduct = factory(UserProduct::class)->make()->toArray();

        $updatedUserProduct = $this->userProductRepo->update($fakeUserProduct, $userProduct->id);

        $this->assertModelData($fakeUserProduct, $updatedUserProduct->toArray());
        $dbUserProduct = $this->userProductRepo->find($userProduct->id);
        $this->assertModelData($fakeUserProduct, $dbUserProduct->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_product()
    {
        $userProduct = factory(UserProduct::class)->create();

        $resp = $this->userProductRepo->delete($userProduct->id);

        $this->assertTrue($resp);
        $this->assertNull(UserProduct::find($userProduct->id), 'UserProduct should not exist in DB');
    }
}
