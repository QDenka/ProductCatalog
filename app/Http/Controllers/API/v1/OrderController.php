<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Purchase;
use App\Models\ContactInfo;
use App\Traits\ApiResponser;
use App\Traits\CartTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponser, CartTrait;

    public function __construct(Request $request) {
        if($request->bearerToken() && empty(auth()->id())) {
            $this->middleware('auth:sanctum');
            if(empty(auth()->id())) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
        }
    }

    public function make(Request $request)
    {
        $this->getCreateCart();
        if ($this->cardItemsCount() === 0) {
            return $this->error(
                'Your cart is empty!',
                200
            );
        }

        if(empty(auth()->id())) {
            $attr = $request->validate([
                'email' => 'required|string|email|unique:users,email',
                'firstname' => 'required|string|min:2|max:100',
                'lastname' => 'required|string|min:2|max:100',
                'middlename' => 'required|string|min:2|max:100',
                'phone' => 'required|string|min:6|max:100',
                'biling_address' => 'required|string|min:6|max:255'
            ]);
            $user_id = null;
            
            ContactInfo::create([
                'email' => $attr['email'],
                'user_id' => $user_id,
                'firstname' => $attr['firstname'],
                'lastname' => $attr['lastname'],
                'middlename' => $attr['middlename'],
                'phone' => $attr['phone'],
                'biling_address' => $attr['biling_address']
            ]);
        } else {
            $user_id = auth()->id();

            // Can be hasMany
            $contact = ContactInfo::select('id')
                        ->where('user_id', $user_id)->orderByDesc('id')
                        ->first();
        }

        try {
            $purchase = new Purchase();
            $purchase->user_id = $user_id;
            $purchase->contact_id = $contact->id;
            $purchase->cart_id = $this->cart->id;
            $purchase->purchase_amount = $this->cartSum();
            $purchase->save();

            $this->makePurchase();

            return $this->success(
                [
                    'message' => 'Success purchase!',
                    'sum' => $purchase->purchase_amount
                ]
            );
        } catch (\Throwable $err) {
            return $this->error(
                $err->getMessage(),
                200
            );
        }
    }

    public function get()
    {
        return $this->success(
            [
                'purchases' => Purchase::where('user_id', auth()->id())
                                ->with('contact')->with('cart')->get()
            ]
        );
    }
}
