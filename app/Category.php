<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function parent()
	{
	    return $this->belongsTo(Category::class, 'parent_id');
	}

	public function children()
	{
	    return $this->hasMany(Category::class, 'parent_id');
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
