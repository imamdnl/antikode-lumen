<?php

namespace App\Adapters\Gateways\Database\Mysql\Model;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @package App
 * @property int id
 * @property string name
 * @property string picture
 * @property integer price
 * @property BrandModel|null brand
 */
class ProductModel extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'product';
    public $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'brandId',
        'name',
        'picture',
        'price',
    ];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function brand()
    {
        return $this->hasOne(BrandModel::class, 'id', 'brandId');
    }
}
