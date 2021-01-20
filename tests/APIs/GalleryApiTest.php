<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Gallery;

class GalleryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_gallery()
    {
        $gallery = factory(Gallery::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/galleries', $gallery
        );

        $this->assertApiResponse($gallery);
    }

    /**
     * @test
     */
    public function test_read_gallery()
    {
        $gallery = factory(Gallery::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/galleries/'.$gallery->id
        );

        $this->assertApiResponse($gallery->toArray());
    }

    /**
     * @test
     */
    public function test_update_gallery()
    {
        $gallery = factory(Gallery::class)->create();
        $editedGallery = factory(Gallery::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/galleries/'.$gallery->id,
            $editedGallery
        );

        $this->assertApiResponse($editedGallery);
    }

    /**
     * @test
     */
    public function test_delete_gallery()
    {
        $gallery = factory(Gallery::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/galleries/'.$gallery->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/galleries/'.$gallery->id
        );

        $this->response->assertStatus(404);
    }
}
