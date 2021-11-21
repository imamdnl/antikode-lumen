<?php

namespace App\Adapters\Gateways\Database\Mysql\Model;

use Database\Factories\OutletFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @package App
 * @property int id
 * @property string name
 * @property string picture
 * @property string address
 * @property string longitude
 * @property string latitude
 * @property BrandModel|null brand
 */
class OutletModel extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'outlet';
    public $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'brandId',
        'name',
        'picture',
        'address',
        'longitude',
        'latitude',
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
        return OutletFactory::new();
    }

    public function brand()
    {
        return $this->hasOne(BrandModel::class, 'id', 'brandId');
    }

    public function scopeIsWithinMaxDistance($query, $location, $radius = 25)
    {
        $haversine = "(6371 * acos(cos(radians($location->latitude))
                     * cos(radians(model.latitude))
                     * cos(radians(model.longitude)
                     - radians($location->longitude))
                     + sin(radians($location->latitude))
                     * sin(radians(model.latitude))))";
        return $query
            ->select("*") //pick the columns you want here.
            ->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius]);
    }
}
