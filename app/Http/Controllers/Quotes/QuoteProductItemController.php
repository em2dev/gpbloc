<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;

use App\Models\Quotes\QuoteProductItem;
use Illuminate\Http\Request;

class QuoteProductItemController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_product_id' => 'exists:quote_product,id|required',
            'code' => 'string|required',
            'description' => 'string|nullable',
            'width' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'lenght' => 'numeric|nullable',
            'weight' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'rental_price_per_day' => 'numeric|nullable',
            'quantity' => 'integer|nullable',
            'rental_days' => 'integer|nullable',
            'total' => 'numeric|nullable',
        ]);

        return QuoteProductItem::updateOrCreate(['id' => $request->id],$validated);
    }


    public function destroy(int $id)
    {
        $quoteProductItem = QuoteProductItem::findOrFail($id);
        $quoteProductItem->delete();
        return response()->noContent();
    }
}
