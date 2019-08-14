<?php

Route::get('/',  ["uses"=>"ProductsController@index", "as"=> "allProducts"]);

//contacts
Route::get('contacts', ["uses"=>"Contacts\ContactsController@index", "as"=> "contacts"]);

//contacts
Route::post('contacts/ask', ["uses"=>"Contacts\ContactsController@ask", "as"=> "contactsAskForm"]);

//get products by category 
Route::get('products/category/{category}', 'ProductsController@index')->name('allProductsByCategory');

//get products by brand 
Route::get('products/brand/{brand}', 'ProductsController@index')->name('allProductsByBrand');

//get products by price 
Route::get('products/price/', 'ProductsController@price')->name('allProductsByPrice');

//product-details page 
Route::get('products/{product}/', 'ProductsController@showProduct')->name('productDetailsPage');

//search
Route::get('search', ["uses"=>"ProductsController@search", "as"=> "searchProducts"]);

//add to cart
Route::get('product/addToCart/{id}',['uses'=>'ProductsController@addProductToCart','as'=>'AddToCartProduct']);

//show cart items
Route::get('cart', ["uses"=>"ProductsController@showCart", "as"=> "cartproducts"]);

//delete item from cart
Route::get('product/deleteItemFromCart/{id}',['uses'=>'ProductsController@deleteItemFromCart','as'=>'DeleteItemFromCart']);

//increase single product in cart
Route::get('product/increaseSingleProduct/{id}',['uses'=>'ProductsController@increaseSingleProduct','as'=>'IncreaseSingleProduct']);

//decrease single product in cart
Route::get('product/decreaseSingleProduct/{id}',['uses'=>'ProductsController@decreaseSingleProduct','as'=>'DecreaseSingleProduct']);

//checkout page
Route::get('product/checkoutProducts/',['uses'=>'ProductsController@checkoutProducts','as'=>'checkoutProducts']);

//process checkout page
Route::post('product/createNewOrder/',['uses'=>'ProductsController@createNewOrder','as'=>'createNewOrder']);

//payment page
Route::get('payment/paymentpage', ["uses"=> "Payment\PaymentsController@showPaymentPage", 'as'=> 'showPaymentPage']);

//process payment & receipt page
Route::get('payment/paymentreceipt/{paymentID}/{payerID}', ["uses"=> "Payment\PaymentsController@showPaymentReceipt", 'as'=> 'showPaymentReceipt']);

//User Authentication
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['restrictToAdmin']], function () {

	//display edit product form
	Route::get('admin/editProductForm/{id}', ["uses"=>"Admin\AdminProductsController@editProductForm", "as"=> "adminEditProductForm"]);

	//display edit product image form
	Route::get('admin/editProductImageForm/{id}', ["uses"=>"Admin\AdminProductsController@editProductImageForm", "as"=> "adminEditProductImageForm"]);

	//update product image
	Route::post('admin/updateProductImage/{id}', ["uses"=>"Admin\AdminProductsController@updateProductImage", "as"=> "adminUpdateProductImage"]);

	//make product data
	Route::post('admin/updateProduct/{id}', ["uses"=>"Admin\AdminProductsController@updateProduct", "as"=> "adminUpdateProduct"]);

	//make product popular
	Route::patch('admin/products/{product}/popular', ["uses"=>"Admin\AdminProductsController@popular", "as"=> "adminPopularProduct"]);

	//make product published
	Route::patch('admin/products/{product}/publish', ["uses"=>"Admin\AdminProductsController@publish", "as"=> "adminPublishProduct"]);		

	//display create product form
	Route::get('admin/createProductForm', ["uses"=>"Admin\AdminProductsController@createProdcutForm", "as"=> "adminCreateProductForm"]);

	//send new product data to database
	Route::post('admin/sendCreateProductForm/', ["uses"=>"Admin\AdminProductsController@sendCreateProductForm", "as"=> "adminSendCreateProductForm"]);

	//delete product
	Route::get('admin/deleteProduct/{id}', ["uses"=>"Admin\AdminProductsController@deleteProduct", "as"=> "adminDeleteProduct"]);

	//display create category form
	Route::get('admin/createCategoryForm', ["uses"=>"Admin\AdminCategoryController@createCategoryForm", "as"=> "adminCreateCategoryForm"]);

	//send new category data to database
	Route::post('admin/sendCreateCategoryForm/', ["uses"=>"Admin\AdminCategoryController@sendCreateCategoryForm", "as"=> "adminSendCreateCategoryForm"]);

	//categories control panel
	Route::get('admin/categoriesPanel/', ["uses" => "Admin\AdminCategoryController@categoriesPanel" , "as" => "categoriesPanel"]);

	//display edit category form
	Route::get('admin/editCategoryForm/{id}', ["uses"=>"Admin\AdminCategoryController@editCategoryForm", "as"=> "adminEditCategoryForm"]);

	//display edit category image form
	Route::get('admin/editCategoryImageForm/{id}', ["uses"=>"Admin\AdminCategoryController@editCategoryImageForm", "as"=> "adminEditCategoryImageForm"]);	

	//update category image
	Route::post('admin/updateCategoryImage/{id}', ["uses"=>"Admin\AdminCategoryController@updateCategoryImage", "as"=> "adminUpdateCategoryImage"]);

	//update category data
	Route::post('admin/updateCategory/{id}', ["uses"=>"Admin\AdminCategoryController@updateCategory", "as"=> "adminUpdateCategory"]);

	//delete category
	Route::get('admin/deleteCategory/{id}', ["uses"=>"Admin\AdminCategoryController@deleteCategory", "as"=> "adminDeleteCategory"]);

	//display create brand form
	Route::get('admin/createBrandForm', ["uses"=>"Admin\AdminBrandController@createBrandForm", "as"=> "adminCreateBrandForm"]);

	//send new brand data to database
	Route::post('admin/sendCreateBrandForm/', ["uses"=>"Admin\AdminBrandController@sendCreateBrandForm", "as"=> "adminSendCreateBrandForm"]);

	//brands control panel
	Route::get('admin/brandsPanel/', ["uses" => "Admin\AdminBrandController@brandsPanel" , "as" => "brandsPanel"]);

	//delete brand
	Route::get('admin/deleteBrand/{id}', ["uses"=>"Admin\AdminBrandController@deleteBrand", "as"=> "adminDeleteBrand"]);

	//display edit brand form
	Route::get('admin/editBrandForm/{id}', ["uses"=>"Admin\AdminBrandController@editBrandForm", "as"=> "adminEditBrandForm"]);

	//update brand data
	Route::post('admin/updateBrand/{id}', ["uses"=>"Admin\AdminBrandController@updateBrand", "as"=> "adminUpdateBrand"]);

	//display edit brand image form
	Route::get('admin/editBrandImageForm/{id}', ["uses"=>"Admin\AdminBrandController@editBrandImageForm", "as"=> "adminEditBrandImageForm"]);	

	//update brand image
	Route::post('admin/updateBrandImage/{id}', ["uses"=>"Admin\AdminBrandController@updateBrandImage", "as"=> "adminUpdateBrandImage"]);			

	//shipments control panel
	Route::get('admin/shipmentsPanel/', ["uses" => "Admin\AdminShipmentController@shipmentsPanel" , "as" => "shipmentsPanel"]);

	//display create shipment form
	Route::get('admin/createShipmentForm', ["uses"=>"Admin\AdminShipmentController@createShipmentForm", "as"=> "adminCreateShipmentForm"]);

	//send new shipment data to database
	Route::post('admin/sendCreateShipmentForm/', ["uses"=>"Admin\AdminShipmentController@sendCreateShipmentForm", "as"=> "adminSendCreateShipmentForm"]);

	//delete shipment
	Route::get('admin/deleteShipment/{id}', ["uses"=>"Admin\AdminShipmentController@deleteShipment", "as"=> "adminDeleteShipment"]);

	//display edit shipment form
	Route::get('admin/editShipmentForm/{id}', ["uses"=>"Admin\AdminShipmentController@editShipmentForm", "as"=> "adminEditShipmentForm"]);

	//update shipment data
	Route::post('admin/updateShipment/{id}', ["uses"=>"Admin\AdminShipmentController@updateShipment", "as"=> "adminUpdateShipment"]);	

	//orders control panel
	Route::get('admin/ordersPanel/', ["uses" => "Admin\AdminOrdersController@ordersPanel" , "as" => "ordersPanel"]);

	//delete order
	Route::get('admin/deleteOrder/{id}', ["uses"=>"Admin\AdminOrdersController@deleteOrder", "as"=> "adminDeleteOrder"]);

	//getPaymentInfoByOrderId
	Route::get('payment/getPaymentInfoByOrderId/{order_id}', ["uses" => "Payment\PaymentsController@getPaymentInfoByOrderId"
	, "as" => "getPaymentInfoByOrderId"]);

	//display edit order form
	Route::get('admin/editOrderForm/{order_id}', ["uses"=>"Admin\AdminOrdersController@editOrderForm", "as"=> "adminEditOrderForm"]);

	//update order data
	Route::post('admin/updateOrder/{order_id}', ["uses"=>"Admin\AdminOrdersController@updateOrder", "as"=> "adminUpdateOrder"]);

});

//Admin Panel
Route::get('admin/products', ["uses"=>"Admin\AdminProductsController@index", "as"=> "adminDisplayProducts"])->middleware('restrictToAdmin');

//storage
Route::get('/testStorage',function(){

     // return "<img src=".Storage::url('product_images/jacket.jpg').">";
    // return Storage::disk('local')->url('product_images/jacket.jpg');
    // print_r(Storage::disk("local")->exists("public/product_images/jacket.jpg"));
   // Storage::delete('public/product_images/jacket.jpg');

});





//storage
Route::get('/session',function(\Illuminate\Http\Request $request){

 dd($request->session()->all());
});








