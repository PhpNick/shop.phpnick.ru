<?php
/**
 * Created by IntelliJ IDEA.
 * User: mostafa
 * Date: 5/15/2018
 * Time: 1:11 PM
 */

namespace App;


class Cart
{
    public $items; // [ ['id' => ['quantity' => , 'price' => , 'data' =>],....]
    public $itemsNumber;
    public $totalQuantity;
    public $totalPrice;


    /**
     * Cart constructor.
     */
    public function __construct($prevCart)
    {
        if($prevCart != null){
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
            $this->itemsNumber = $prevCart->itemsNumber;
        }else{
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
            $this->itemsNumber = 0;
        }
    }

    public function addItem($id, $product, $quantity = 1){

       $price = (float) str_replace("$","",$product->price);

        //the item already exists
        if(array_key_exists($id,$this->items)){

            $productToAdd = $this->items[$id];
            $productToAdd['quantity'] += $quantity;
            $productToAdd['totalSinglePrice'] = $productToAdd['quantity'] *  $price;

            //first time to add this product to cart
        }else{
            $productToAdd = ['quantity'=> $quantity, 'totalSinglePrice'=> $quantity * $price, 'data'=>$product
            ];
            $this->itemsNumber++;
        }

        $this->items[$id] = $productToAdd;
        $this->totalQuantity += $quantity;
        $this->totalPrice = $this->totalPrice + $quantity * $price;
    }

    public function updatePriceAndQunatity(){

         $totalPrice = 0;
         $totalQuanity = 0;
         $itemsNumber = 0;

         foreach($this->items as $item){

            $totalQuanity = $totalQuanity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];
            $itemsNumber++; 
         }

         $this->totalQuantity = $totalQuanity;
         $this->totalPrice =  $totalPrice;
         $this->itemsNumber = $itemsNumber;

    }



}