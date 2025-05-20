<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;

use App\Models\Quotes\QuoteTransportation;
use Illuminate\Http\Request;

class QuoteTransportationController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_id' => 'exists:quotes,id|required',
            'shipping_contact_first_name' => 'string|nullable',
            'shipping_contact_last_name' => 'string|nullable',
            'shipping_contact_email' => 'string|nullable',
            'shipping_contact_phone' => 'string|nullable',
            'client_notes' => 'string|nullable',
        ]);

        $quoteTransportation = QuoteTransportation::updateOrCreate(['id' => $request->id],$validated);
        if (isset($request->items)) {
            foreach ($request->items as $item) {
                $quoteTransportation->items()->updateOrCreate($item);
            }
        }
        $quoteTransportation->load('items');
        return $quoteTransportation;
    }

    public function destroy(QuoteTransportation $quoteTransportation)
    {
        $quoteTransportation->delete();
        return response()->noContent();
    }
}
