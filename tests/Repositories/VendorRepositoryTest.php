<?php namespace Tests\Repositories;

use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class VendorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var VendorRepository
     */
    protected $vendorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->vendorRepo = \App::make(VendorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_vendor()
    {
        $vendor = factory(Vendor::class)->make()->toArray();

        $createdVendor = $this->vendorRepo->create($vendor);

        $createdVendor = $createdVendor->toArray();
        $this->assertArrayHasKey('id', $createdVendor);
        $this->assertNotNull($createdVendor['id'], 'Created Vendor must have id specified');
        $this->assertNotNull(Vendor::find($createdVendor['id']), 'Vendor with given id must be in DB');
        $this->assertModelData($vendor, $createdVendor);
    }

    /**
     * @test read
     */
    public function test_read_vendor()
    {
        $vendor = factory(Vendor::class)->create();

        $dbVendor = $this->vendorRepo->find($vendor->id);

        $dbVendor = $dbVendor->toArray();
        $this->assertModelData($vendor->toArray(), $dbVendor);
    }

    /**
     * @test update
     */
    public function test_update_vendor()
    {
        $vendor = factory(Vendor::class)->create();
        $fakeVendor = factory(Vendor::class)->make()->toArray();

        $updatedVendor = $this->vendorRepo->update($fakeVendor, $vendor->id);

        $this->assertModelData($fakeVendor, $updatedVendor->toArray());
        $dbVendor = $this->vendorRepo->find($vendor->id);
        $this->assertModelData($fakeVendor, $dbVendor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_vendor()
    {
        $vendor = factory(Vendor::class)->create();

        $resp = $this->vendorRepo->delete($vendor->id);

        $this->assertTrue($resp);
        $this->assertNull(Vendor::find($vendor->id), 'Vendor should not exist in DB');
    }
}
