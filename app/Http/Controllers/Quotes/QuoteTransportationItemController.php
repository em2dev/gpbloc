<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;

use App\Models\Quotes\QuoteTransportationItem;
use Illuminate\Http\Request;

class QuoteTransportationItemController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_transportation_id' => 'exists:quote_transportation,id|required',
            'carrier' => 'string|nullable',
            'capacity_without_lift' => 'integer|nullable',
            'capacity_with_lift' => 'integer|nullable',
            'number_of_trips' => 'integer|nullable',
            'number_of_goings' => 'integer|nullable',
            'number_of_comings' => 'integer|nullable',
            'price_per_round_trips' => 'numeric|nullable',
            'price_per_trip' => 'numeric|nullable',
            'total' => 'numeric|nullable',
        ]);

        return QuoteTransportationItem::updateOrCreate(['id' => $request->id],$validated);
    }

    public function destroy(int $id)
    {
        $quoteTransportationItem = QuoteTransportationItem::findOrFail($id);
        $quoteTransportationItem->delete();
        return response()->noContent();
    }
}
