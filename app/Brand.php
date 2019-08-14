<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	 /**
	 * Boot the model.
	 */
    protected static function boot()
    {
        parent::boot();
        // считаем товары для каждой категории (products_count)
        static::addGlobalScope('productCount', function ($builder) {
        $builder->withCount('products');
        });                
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        /* используется для того чтобы можно было в маршруте 
        * например таком: Route::get('products/{category}/{product}', 'ProductsController@index');
        * получить 
        * нужную категорию не по колонке id, а по колонке slug
        */
        return 'slug';
    }          
}
