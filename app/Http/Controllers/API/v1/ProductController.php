<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Product;

/**
 * Class-controller for Products
 */
class ProductController extends Controller
{
    use ApiResponser;

    /**
     * Get products, with filter
     *
     * @param Request $request
     * @return void
     */
    public function getFiltered(Request $request)
    {
        $atr = $request->validate([
            'categories' => 'array|max:10',
            'categories.*' => 'string|distinct|max:100',
            'features' => 'array|max:10',
            'features.*' => 'string|distinct|max:100',
            'price_to' => 'numeric|between:0,99999.99|gt:price_from',
            'price_from' => 'numeric|between:0,99999.99'
        ]);

        $query = Product::query()
            ->with('category')
            ->with('features');


        if (!empty($atr['categories'])) {
            $query = $query
                ->whereHas('category_connect', function ($query) use ($atr) {
                    $query->whereHas('category', function ($query) use ($atr) {
                        $query->whereIn('name', $atr['categories']);
                    });
                });
        }

        if (!empty($atr['features'])) {
            $query = $query
                ->whereHas('feature_connect', function ($query) use ($atr) {
                    $query->whereHas('feature', function ($query) use ($atr) {
                        $query->whereIn('name', $atr['features']);
                    });
                });
        }

        if (!empty($atr['price_from'])) {
            $query = $query
                ->where('price', '>=', $atr['price_from']);
        }

        if (!empty($atr['price_to'])) {
            $query = $query
                ->where('price', '<=', $atr['price_to']);
        }

        return $this->success([
            'products' => $query->get()
        ]);
    }

    /**
     * Get products by slug
     *
     * @param Request $request
     * @return void
     */
    public function getBySlug(Request $request)
    {
        $atr = $request->validate([
            'value' => 'required|string|min:1|max:255|exists:products,slug'
        ]);

        return $this->success([
            'product' => Product::where('slug', $atr['value'])
                ->with('category')->get()
        ]);
    }
}
