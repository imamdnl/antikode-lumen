<?php

namespace App\Domain;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class Product
{
    public ?int $id;
    public string $name;
    public string $picture;
    public int $price;
    public ?string $createdAt;
    public ?string $updatedAt;

    public ?Brand $brand;

    public function __construct(?int $id, string $name, string $picture, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->picture = $picture;
        $this->price = $price;
    }

    /**
     * @param array $payloads
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function create(array $payloads, ?Brand $brand = null)
    {
        $validate = Validator::make($payloads, [
            'id' => ['nullable', 'numeric'],
            'name' => ['required', 'string'],
            'picture' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ]);
        if ($validate->fails()) {
            throw new \Exception($validate->errors()->first());
        }
        $validated = $validate->validated();

        $app = new self(
            $validated['id'] ?? null,
            $validated['name'],
            $validated['picture'],
            $validated['price'],
        );
        $app->setBrand($brand);
        $app->setCreatedAt($payloads['createdAt'] ?? Carbon::now()->toDateTimeString());
        $app->setUpdatedAt($payloads['updatedAt'] ?? Carbon::now()->toDateTimeString());
        return $app;
    }

    /**
     * @param int|null $id
     * @return Product
     */
    public function setId(?int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $createdAt
     * @return Product
     */
    public function setCreatedAt(?string $createdAt): Product
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string|null $updatedAt
     * @return Product
     */
    public function setUpdatedAt(?string $updatedAt): Product
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param Brand|null $brand
     * @return $this
     */
    public function setBrand(?Brand $brand): Product
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Brand|null
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }
}
