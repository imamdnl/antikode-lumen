<?php

namespace App\Domain;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class Brand
{
    public ?int $id;
    public string $name;
    public string $logo;
    public string $banner;
    public ?string $createdAt;
    public ?string $updatedAt;

    public function __construct(?int $id, string $name, string $logo, string $banner)
    {
        $this->id = $id;
        $this->name = $name;
        $this->logo = $logo;
        $this->banner = $banner;
    }

    /**
     * @param array $payloads
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function create(array $payloads)
    {
        $validate = Validator::make($payloads, [
            'id' => ['nullable', 'numeric'],
            'name' => ['required', 'string'],
            'logo' => ['required', 'string'],
            'banner' => ['required', 'string'],
        ]);
        if ($validate->fails()) {
            throw new \Exception($validate->errors()->first());
        }
        $validated = $validate->validated();

        $app = new self(
            $validated['id'] ?? null,
            $validated['name'],
            $validated['logo'],
            $validated['banner'],
        );
        $app->setCreatedAt($payloads['createdAt'] ?? Carbon::now()->toDateTimeString());
        $app->setUpdatedAt($payloads['updatedAt'] ?? Carbon::now()->toDateTimeString());
        return $app;
    }

    /**
     * @param int|null $id
     * @return Brand
     */
    public function setId(?int $id): Brand
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $createdAt
     * @return Brand
     */
    public function setCreatedAt(?string $createdAt): Brand
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string|null $updatedAt
     * @return Brand
     */
    public function setUpdatedAt(?string $updatedAt): Brand
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
