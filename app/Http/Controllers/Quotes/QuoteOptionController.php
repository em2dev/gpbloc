<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;
use App\Models\Quotes\QuoteOption;
use Illuminate\Http\Request;

class QuoteOptionController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_id' => 'exists:quotes,id|required',
        ]);

        $quoteOption = QuoteOption::updateOrCreate(['id' => $request->id],$validated);
        // dd($request->items);
        if (isset($request->items)) {
            foreach ($request->items as $item) {
                $quoteOption->items()->updateOrCreate($item);
            }
        }
        $quoteOption->load('items');
        return $quoteOption;
    }

    public function destroy(QuoteOption $quoteOption)
    {
        $quoteOption->delete();
        return response()->noContent();
    }
}
