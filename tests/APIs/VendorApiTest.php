<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Vendor;

class VendorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_vendor()
    {
        $vendor = factory(Vendor::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/vendors', $vendor
        );

        $this->assertApiResponse($vendor);
    }

    /**
     * @test
     */
    public function test_read_vendor()
    {
        $vendor = factory(Vendor::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/vendors/'.$vendor->id
        );

        $this->assertApiResponse($vendor->toArray());
    }

    /**
     * @test
     */
    public function test_update_vendor()
    {
        $vendor = factory(Vendor::class)->create();
        $editedVendor = factory(Vendor::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/vendors/'.$vendor->id,
            $editedVendor
        );

        $this->assertApiResponse($editedVendor);
    }

    /**
     * @test
     */
    public function test_delete_vendor()
    {
        $vendor = factory(Vendor::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/vendors/'.$vendor->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/vendors/'.$vendor->id
        );

        $this->response->assertStatus(404);
    }
}
