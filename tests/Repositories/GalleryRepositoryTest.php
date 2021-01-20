<?php namespace Tests\Repositories;

use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GalleryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GalleryRepository
     */
    protected $galleryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->galleryRepo = \App::make(GalleryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_gallery()
    {
        $gallery = factory(Gallery::class)->make()->toArray();

        $createdGallery = $this->galleryRepo->create($gallery);

        $createdGallery = $createdGallery->toArray();
        $this->assertArrayHasKey('id', $createdGallery);
        $this->assertNotNull($createdGallery['id'], 'Created Gallery must have id specified');
        $this->assertNotNull(Gallery::find($createdGallery['id']), 'Gallery with given id must be in DB');
        $this->assertModelData($gallery, $createdGallery);
    }

    /**
     * @test read
     */
    public function test_read_gallery()
    {
        $gallery = factory(Gallery::class)->create();

        $dbGallery = $this->galleryRepo->find($gallery->id);

        $dbGallery = $dbGallery->toArray();
        $this->assertModelData($gallery->toArray(), $dbGallery);
    }

    /**
     * @test update
     */
    public function test_update_gallery()
    {
        $gallery = factory(Gallery::class)->create();
        $fakeGallery = factory(Gallery::class)->make()->toArray();

        $updatedGallery = $this->galleryRepo->update($fakeGallery, $gallery->id);

        $this->assertModelData($fakeGallery, $updatedGallery->toArray());
        $dbGallery = $this->galleryRepo->find($gallery->id);
        $this->assertModelData($fakeGallery, $dbGallery->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_gallery()
    {
        $gallery = factory(Gallery::class)->create();

        $resp = $this->galleryRepo->delete($gallery->id);

        $this->assertTrue($resp);
        $this->assertNull(Gallery::find($gallery->id), 'Gallery should not exist in DB');
    }
}
