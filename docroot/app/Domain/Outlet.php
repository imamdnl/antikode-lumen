<?php

namespace App\Domain;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class Outlet
{
    public ?int $id;
    public string $name;
    public string $picture;
    public string $address;
    public float $longitude;
    public float $latitude;
    public ?string $createdAt;
    public ?string $updatedAt;

    public ?Brand $brand;

    public function __construct(?int $id, string $name, string $picture, string $address, string $longitude, string $latitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->picture = $picture;
        $this->address = $address;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @param array $payloads
     * @return Outlet
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function create(array $payloads, ?Brand $brand = null)
    {
        $validate = Validator::make($payloads, [
            'id' => ['nullable', 'numeric'],
            'name' => ['required', 'string'],
            'picture' => ['required', 'string'],
            'address' => ['required', 'string'],
            'longitude' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric'],
        ]);
        if ($validate->fails()) {
            throw new \Exception($validate->errors()->first());
        }
        $validated = $validate->validated();

        $app = new self(
            $validated['id'] ?? null,
            $validated['name'],
            $validated['picture'],
            $validated['address'],
            $validated['longitude'],
            $validated['latitude'],
        );
        $app->setBrand($brand ?? null);
        $app->setCreatedAt($payloads['createdAt'] ?? Carbon::now()->toDateTimeString());
        $app->setUpdatedAt($payloads['updatedAt'] ?? Carbon::now()->toDateTimeString());
        return $app;
    }

    /**
     * @param int|null $id
     * @return Outlet
     */
    public function setId(?int $id): Outlet
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $createdAt
     * @return Outlet
     */
    public function setCreatedAt(?string $createdAt): Outlet
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string|null $updatedAt
     * @return Outlet
     */
    public function setUpdatedAt(?string $updatedAt): Outlet
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param Brand|null $brand
     * @return $this
     */
    public function setBrand(?Brand $brand): Outlet
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
