<?php namespace Tests\Repositories;

use App\Models\mailing;
use App\Repositories\mailingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class mailingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var mailingRepository
     */
    protected $mailingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mailingRepo = \App::make(mailingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_mailing()
    {
        $mailing = factory(mailing::class)->make()->toArray();

        $createdmailing = $this->mailingRepo->create($mailing);

        $createdmailing = $createdmailing->toArray();
        $this->assertArrayHasKey('id', $createdmailing);
        $this->assertNotNull($createdmailing['id'], 'Created mailing must have id specified');
        $this->assertNotNull(mailing::find($createdmailing['id']), 'mailing with given id must be in DB');
        $this->assertModelData($mailing, $createdmailing);
    }

    /**
     * @test read
     */
    public function test_read_mailing()
    {
        $mailing = factory(mailing::class)->create();

        $dbmailing = $this->mailingRepo->find($mailing->id);

        $dbmailing = $dbmailing->toArray();
        $this->assertModelData($mailing->toArray(), $dbmailing);
    }

    /**
     * @test update
     */
    public function test_update_mailing()
    {
        $mailing = factory(mailing::class)->create();
        $fakemailing = factory(mailing::class)->make()->toArray();

        $updatedmailing = $this->mailingRepo->update($fakemailing, $mailing->id);

        $this->assertModelData($fakemailing, $updatedmailing->toArray());
        $dbmailing = $this->mailingRepo->find($mailing->id);
        $this->assertModelData($fakemailing, $dbmailing->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_mailing()
    {
        $mailing = factory(mailing::class)->create();

        $resp = $this->mailingRepo->delete($mailing->id);

        $this->assertTrue($resp);
        $this->assertNull(mailing::find($mailing->id), 'mailing should not exist in DB');
    }
}
