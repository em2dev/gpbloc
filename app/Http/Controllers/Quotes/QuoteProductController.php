<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;
use App\Models\Quotes\QuoteProduct;
use Illuminate\Http\Request;

class QuoteProductController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_id' => 'exists:quotes,id|required',
        ]);

        $quoteProduct = QuoteProduct::updateOrCreate(['id' => $request->id],$validated);
        if (isset($request->items)) {
            foreach ($request->items as $item) {
                $quoteProduct->items()->updateOrCreate($item);
            }
        }
        $quoteProduct->load('items');
        return $quoteProduct;
    }

    public function destroy(int $id)
    {
        $quoteProduct = QuoteProduct::findOrFail($id);
        $quoteProduct->delete();
        return response()->noContent();
    }
}
