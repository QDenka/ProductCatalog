<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Traits\CartTrait;
use App\Traits\ApiResponser;
use App\Models\CartList;
use Illuminate\Validation\Rule;

/**
 * Class-controller for User Shopping Cart
 */
class CartController extends Controller
{
    // We connect CartTrait for simple using at Cart and Order controller
    use ApiResponser, CartTrait;


    /**
     * Show all product in the cart
     *
     * @return void
     */
    public function showProducts()
    {
        $this->getCreateCart();

        return $this->success([
            'cart_sum' => $this->cartSum(),
            'items' => $this->getCartItems()
        ]);
    }

    public function addProduct(Request $request)
    {
        $atr = $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $this->getCreateCart();

        try {
            if (!$this->editProduct($atr['product_id'])) {
                return $this->success(
                    [
                        'product' => $atr['product_id'],
                        'status'   => 'added'
                    ]
                );
            } else {
                return $this->error(
                    'Product already at cart',
                    200
                );
            }
        } catch (\Throwable $err) {
            return $this->error(
                $err->getMessage(),
                200
            );
        }
    }

    public function editCount(Request $request)
    {
        $atr = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'type' => [
                'required',
                'string',
                Rule::in('increase', 'discrease')
            ],
            'count' => 'required|integer|min:1|max:1000'
        ]);

        $this->getCreateCart();

        try {
            if ($this->setCountProduct(
                $atr['product_id'],
                $atr['type'],
                $atr['count']
            )) {
                return $this->success(
                    [
                        'product' => $atr['product_id'],
                        'status'   => $atr['type'],
                        'at_count' => $atr['count']
                    ]
                );
            } else {
                return $this->error(
                    'Product not found at cart or discrease value so big',
                    200
                );
            }
        } catch (\Throwable $err) {
            return $this->error(
                $err->getMessage(),
                200
            );
        }
    }

    public function deleteFrom(Request $request)
    {
        $atr = $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $this->getCreateCart();

        try {
            if ($this->editProduct($atr['product_id'], 'delete')) {
                return $this->success(
                    [
                        'product' => $atr['product_id'],
                        'status'   => 'deleted'
                    ]
                );
            } else {
                return $this->error(
                    'Product not found',
                    200
                );
            }
        } catch (\Throwable $err) {
            return $this->error(
                $err->getMessage(),
                200
            );
        }
    }

    protected function editProduct(
        int $productID,
        $type = 'add'
    ) {

        if ($this->findProduct($productID)) {
            if ($type === 'delete') {
                $cart = CartList::where('product_id', $productID)
                    ->where('cart_id', $this->cart->id)
                    ->delete();
            }
            return true;
        } else if ($type === 'add') {
            $cart = new CartList;
            $cart->cart_id = $this->cart->id;
            $cart->product_id = $productID;
            $cart->count = 1; // Can be editing to add >1 product count
            $cart->saveOrFail();
        }
        return false;
    }

    protected function setCountProduct(
        int $productID,
        string $type,
        int $count
    ) {
        if (!$this->findProduct($productID))
            return false;

        $cart = CartList::where('product_id', $productID)
            ->where('cart_id', $this->cart->id)
            ->first();


        if ($type === 'increase') {
            $cart->count = $cart->count + $count;
        } else if ($type === 'discrease') {
            if ($cart->count <= $count)
                return false;
            $cart->count = $cart->count - $count;
        }
        $cart->saveOrFail();

        return true;
    }
}
