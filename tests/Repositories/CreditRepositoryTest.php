<?php namespace Tests\Repositories;

use App\Models\Credit;
use App\Repositories\CreditRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CreditRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CreditRepository
     */
    protected $creditRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->creditRepo = \App::make(CreditRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_credit()
    {
        $credit = factory(Credit::class)->make()->toArray();

        $createdCredit = $this->creditRepo->create($credit);

        $createdCredit = $createdCredit->toArray();
        $this->assertArrayHasKey('id', $createdCredit);
        $this->assertNotNull($createdCredit['id'], 'Created Credit must have id specified');
        $this->assertNotNull(Credit::find($createdCredit['id']), 'Credit with given id must be in DB');
        $this->assertModelData($credit, $createdCredit);
    }

    /**
     * @test read
     */
    public function test_read_credit()
    {
        $credit = factory(Credit::class)->create();

        $dbCredit = $this->creditRepo->find($credit->id);

        $dbCredit = $dbCredit->toArray();
        $this->assertModelData($credit->toArray(), $dbCredit);
    }

    /**
     * @test update
     */
    public function test_update_credit()
    {
        $credit = factory(Credit::class)->create();
        $fakeCredit = factory(Credit::class)->make()->toArray();

        $updatedCredit = $this->creditRepo->update($fakeCredit, $credit->id);

        $this->assertModelData($fakeCredit, $updatedCredit->toArray());
        $dbCredit = $this->creditRepo->find($credit->id);
        $this->assertModelData($fakeCredit, $dbCredit->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_credit()
    {
        $credit = factory(Credit::class)->create();

        $resp = $this->creditRepo->delete($credit->id);

        $this->assertTrue($resp);
        $this->assertNull(Credit::find($credit->id), 'Credit should not exist in DB');
    }
}
