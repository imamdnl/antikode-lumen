<?php

namespace Feature;


use App\Adapters\Gateways\Database\Mysql\Model\BrandModel;
use App\Adapters\Gateways\Database\Mysql\Model\OutletModel;
use Faker\Factory as Faker;
use TestCase;

class OutletTest extends TestCase
{
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    private function _createOutlet(array $payloads = [])
    {
        return OutletModel::factory()->create($payloads);
    }

    public function testItShouldCreateOutlet()
    {
        $brandFactory = BrandModel::factory()->create();
        $payloads = [
            'brandId' => $brandFactory->id,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->post('/outlet/create', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'picture',
                'address',
                'latitude',
                'longitude',
                'createdAt',
                'updatedAt',
            ]
        ]);
    }

    public function testItShouldCreateOutletWithoutBrandID()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->post('/outlet/create', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'picture',
                'address',
                'latitude',
                'longitude',
                'createdAt',
                'updatedAt',
            ]
        ]);
    }

    public function testCreateOutletErrorBrandIDNotValid()
    {
        $payloads = [
            'brandId' => 'abc5dasar',
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->post('/outlet/create', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testCreateOutletErrorNoName()
    {
        $payloads = [
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->post('/outlet/create', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testItShouldUpdateOutlet()
    {
        $outlet = $this->_createOutlet();
        $payloads = [
            'id' => $outlet->id,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->put('/outlet/update', $payloads);
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

    public function testItShouldUpdateOutletWithBrandId()
    {
        $outlet = $this->_createOutlet();
        $brandFactory = BrandModel::factory()->create();
        $payloads = [
            'id' => $outlet->id,
            'brandId' => $brandFactory->id,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->put('/outlet/update', $payloads);
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

    public function testUpdateOutletIdNotFound()
    {
        $payloads = [
            'id' => 9999999999,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->put('/outlet/update', $payloads);
        $result->assertResponseStatus(404);
    }

    public function testItShouldDeleteOutlet()
    {
        $outlet = $this->_createOutlet();
        $payloads = [
            'id' => $outlet->id,
        ];

        $result = $this->delete('/outlet/delete', $payloads);
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

    public function testDeleteOutletFailedIdNotFound()
    {
        $payloads = [
            'id' => 9999999999999,
        ];

        $result = $this->delete('/outlet/delete', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testItShouldGetOutlets()
    {
        $payloads = [
            'q' => '',
            'page' => 1,
            'limit' => 10,
        ];

        $result = $this->json('get','/outlet', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data' => [
                [
                    [
                        'id',
                        'name',
                        'picture',
                        'address',
                    ],
                    [
                        'id',
                        'name',
                        'picture',
                        'address',
                    ],
                ],
                'count',
                'page',
                'limit',
            ]
        ]);
    }
}
