<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use FullTextSearch;
    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['category', 'brand'];     

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'popular' => 'boolean',
        'publish' => 'boolean',
    ];

    public function getPriceAttribute($value){
      //  $newForm = "$".$value;
        return $value;

    }

    /**
     * A product is assigned a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A product is assigned a brand.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
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

    public function scopePublished($query)
    {
        if(auth()->check()) {
            if(!auth()->user()->isAdmin()) {
                return $query->where('products.publish', '=', 1);
            }
            else
                return $query;
        }
        else
            return $query->where('products.publish', '=', 1);       
    }

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'name',
        'slug',
        'short_description',
        'description'
    ];                      

}


























