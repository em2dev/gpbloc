<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;

use App\Models\Quotes\QuoteOptionItem;
use Illuminate\Http\Request;

class QuoteOptionItemController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_option_id' => 'exists:quote_option,id|required',
            'name' => 'string|required',
            'quantity' => 'integer|nullable',
            'unit_price' => 'numeric|nullable',
            'total' => 'numeric|nullable',
        ]);

        return QuoteOptionItem::updateOrCreate(['id' => $request->id],$validated);
    }

    public function destroy(int $id)
    {
        $quoteOptionItem = QuoteOptionItem::findOrFail($id);
        $quoteOptionItem->delete();
        return response()->noContent();
    }
}
