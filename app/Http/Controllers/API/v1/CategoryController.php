<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Category;
use App\Traits\ApiResponser;

/**
 * Class-controller for Product Categories
 */
class CategoryController extends Controller
{
    use ApiResponser;

    /**
     * Get Tree Category
     *
     * @return void
     */
    public function getTree()
    {
        return $this->success([
            'categories' => Category::with('childrenCategory')->get()
        ]);
    }
}
