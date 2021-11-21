<?php

namespace App\Adapters\Gateways\Database\Mysql\Model;

use Database\Factories\BrandFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @package App
 * @property int id
 * @property string name
 * @property string logo
 * @property string banner
 */
class BrandModel extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'brand';
    public $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'name',
        'logo',
        'banner',
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
        return BrandFactory::new();
    }

    public function outlet()
    {
        $this->hasMany(OutletModel::class, 'brandId', 'id');
    }

    public function product()
    {
        $this->hasMany(ProductModel::class, 'brandId', 'id');
    }
}
