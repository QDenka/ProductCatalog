<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;
use App\Models\Cart;

trait CartTrait
{
    /**
     * User cart
     */
    protected Cart $cart;

    /**
     * Get or create user cart
     *
     * @return void
     */
    protected function getCreateCart()
    {
        $this->cart = Cart::with('cart_list')->firstOrCreate(
            [
                'identifier' => Session::get("_token"),
                'purchased'   => 0
            ]
        );
    }

    /**
     * Return cart content
     *
     * @return void
     */
    protected function getCartItems()
    {
        return $this->cart->cart_list;
    }


    /**
     * Return cart items count
     *
     * @return void
     */
    protected function cardItemsCount()
    {
        return $this->cart->cart_list->count();
    }


    /**
     * Make purchase
     *
     * @return void
     */
    protected function makePurchase()
    {
        $this->cart->purchased = 1;
        $this->cart->saveOrFail();
    }


    protected function cartSum()
    {
        // We can use sum() collection, but it works only at integer value
        // $this->cart->cart_list->sum('price')
        $sum = 0;
        $this->cart->cart_list->each(function ($item) use (&$sum) {
            $sum += $item->product->price;
        });

        return $sum;
    }

    /**
     * Find product in cart
     *
     * @return void
     */
    protected function findProduct($id)
    {
        return $this->cart->cart_list->where('product_id', $id)->count() !== 0;
    }
}
