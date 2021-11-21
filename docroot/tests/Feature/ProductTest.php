<?php

namespace Feature;


use App\Adapters\Gateways\Database\Mysql\Model\BrandModel;
use App\Adapters\Gateways\Database\Mysql\Model\ProductModel;
use Faker\Factory as Faker;
use TestCase;

class ProductTest extends TestCase
{
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    private function _createProduct(array $payloads = [])
    {
        return ProductModel::factory()->create($payloads);
    }

    public function testItShouldCreateProduct()
    {
        $brandFactory = BrandModel::factory()->create();
        $payloads = [
            'brandId' => $brandFactory->id,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $result = $this->post('/product/create', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'brand',
                'picture',
                'price',
                'createdAt',
                'updatedAt',
            ]
        ]);
    }

    public function testItShouldCreateProductWithoutBrandID()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $result = $this->post('/product/create', $payloads);
        $result->assertResponseStatus(200);
        $result->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'brand',
                'picture',
                'price',
                'createdAt',
                'updatedAt',
            ]
        ]);
    }

    public function testCreateProductErrorBrandIDNotValid()
    {
        $payloads = [
            'brandId' => 'abc5dasar',
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->post('/product/create', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testCreateProductErrorNoName()
    {
        $payloads = [
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $result = $this->post('/product/create', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testItShouldUpdateProduct()
    {
        $product = $this->_createProduct();
        $payloads = [
            'id' => $product->id,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $result = $this->put('/product/update', $payloads);
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

    public function testItShouldUpdateProductWithBrandId()
    {
        $product = $this->_createProduct();
        $brandFactory = BrandModel::factory()->create();
        $payloads = [
            'id' => $product->id,
            'brandId' => $brandFactory->id,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $result = $this->put('/product/update', $payloads);
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

    public function testUpdateProductIdNotFound()
    {
        $payloads = [
            'id' => 9999999999,
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $result = $this->put('/product/update', $payloads);
        $result->assertResponseStatus(404);
    }

    public function testItShouldDeleteProduct()
    {
        $product = $this->_createProduct();
        $payloads = [
            'id' => $product->id,
        ];

        $result = $this->delete('/product/delete', $payloads);
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

    public function testDeleteProductFailedIdNotFound()
    {
        $payloads = [
            'id' => 9999999999999,
        ];

        $result = $this->delete('/product/delete', $payloads);
        $result->assertResponseStatus(500);
    }

    public function testItShouldGetProducts()
    {
        $payloads = [
            'q' => '',
            'page' => 1,
            'limit' => 10,
        ];

        $result = $this->json('get','/product', $payloads);
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
                        'price',
                        'brand',
                    ],
                    [
                        'id',
                        'name',
                        'picture',
                        'price',
                        'brand',
                    ],
                ],
                'count',
                'page',
                'limit',
            ]
        ]);
    }
}
