<?php

namespace Feature;


use App\Adapters\Gateways\Database\Mysql\Model\BrandModel;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use TestCase;

class BrandTest extends TestCase
{
    private \Faker\Generator $faker;
    private Model $brandFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->brandFactory = BrandModel::factory()->create();
    }

    public function testItShouldCreateBrand()
    {
        $payloads = [
            'name' => $this->faker->name,
            'logo' => $this->faker->firstName,
            'banner' => $this->faker->text,
        ];

        $result = $this->post('/brand/create', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'logo',
                'banner',
                'createdAt',
                'updatedAt',
            ]
        ]);
    }

    public function testCreateBrandErrorNoName()
    {
        $payloads = [
            'logo' => $this->faker->firstName,
            'banner' => $this->faker->text,
        ];

        $result = $this->post('/brand/create', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testItShouldUpdateBrand()
    {
        $payloads = [
            'id' => $this->brandFactory->id,
            'name' => $this->faker->name,
            'logo' => $this->faker->firstName,
            'banner' => $this->faker->text,
        ];

        $result = $this->put('/brand/update', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data'
        ]);
        $result->seeJson([
            'success' => true,
            'message' => 'Success',
            'data' => true
        ]);
    }

    public function testUpdateBrandIdNotFound()
    {
        $payloads = [
            'id' => 9999999999,
            'name' => $this->faker->name,
            'logo' => $this->faker->firstName,
            'banner' => $this->faker->text,
        ];

        $result = $this->put('/brand/update', $payloads);
        $result->assertResponseStatus(404);
    }

    public function testItShouldDeleteBrand()
    {
        $payloads = [
            'id' => $this->brandFactory->id,
        ];

        $result = $this->delete('/brand/delete', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data'
        ]);
        $result->seeJson([
            'success' => true,
            'message' => 'Success',
            'data' => true
        ]);
    }

    public function testDeleteBrandFailedIdNotFound()
    {
        $payloads = [
            'id' => 9999999999999,
        ];

        $result = $this->delete('/brand/delete', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testItShouldGetBrands()
    {
        $payloads = [
            'q' => '',
            'page' => 1,
            'limit' => 10,
        ];

        $result = $this->json('get','/brand', $payloads);
        $result->assertResponseStatus(200);
    }
}
