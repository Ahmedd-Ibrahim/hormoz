<?php namespace Tests\Repositories;

use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderProductRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderProductRepository
     */
    protected $orderProductRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderProductRepo = \App::make(OrderProductRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_product()
    {
        $orderProduct = factory(OrderProduct::class)->make()->toArray();

        $createdOrderProduct = $this->orderProductRepo->create($orderProduct);

        $createdOrderProduct = $createdOrderProduct->toArray();
        $this->assertArrayHasKey('id', $createdOrderProduct);
        $this->assertNotNull($createdOrderProduct['id'], 'Created OrderProduct must have id specified');
        $this->assertNotNull(OrderProduct::find($createdOrderProduct['id']), 'OrderProduct with given id must be in DB');
        $this->assertModelData($orderProduct, $createdOrderProduct);
    }

    /**
     * @test read
     */
    public function test_read_order_product()
    {
        $orderProduct = factory(OrderProduct::class)->create();

        $dbOrderProduct = $this->orderProductRepo->find($orderProduct->id);

        $dbOrderProduct = $dbOrderProduct->toArray();
        $this->assertModelData($orderProduct->toArray(), $dbOrderProduct);
    }

    /**
     * @test update
     */
    public function test_update_order_product()
    {
        $orderProduct = factory(OrderProduct::class)->create();
        $fakeOrderProduct = factory(OrderProduct::class)->make()->toArray();

        $updatedOrderProduct = $this->orderProductRepo->update($fakeOrderProduct, $orderProduct->id);

        $this->assertModelData($fakeOrderProduct, $updatedOrderProduct->toArray());
        $dbOrderProduct = $this->orderProductRepo->find($orderProduct->id);
        $this->assertModelData($fakeOrderProduct, $dbOrderProduct->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_product()
    {
        $orderProduct = factory(OrderProduct::class)->create();

        $resp = $this->orderProductRepo->delete($orderProduct->id);

        $this->assertTrue($resp);
        $this->assertNull(OrderProduct::find($orderProduct->id), 'OrderProduct should not exist in DB');
    }
}
