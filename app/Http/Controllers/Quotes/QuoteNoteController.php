<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;
use App\Models\Quotes\QuoteNote;
use Illuminate\Http\Request;

class QuoteNoteController extends Controller
{
    public function index()
    {

    }

    public function show(QuoteNote $quoteNote)
    {

    }

    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_id' => 'exists:quotes,id|required',
            'quote_valid_days' => 'integer|nullable',
            'thawing_days' => 'integer|nullable',
            'general_rental_terms' => 'string|nullable',
            'payement_method' => 'string|nullable',
            'bank_transfer' => 'string|nullable',
        ]);

        return QuoteNote::updateOrCreate(['id' => $request->id],$validated);
    }

    public function destroy(QuoteNote $quoteNote)
    {
        $quoteNote->delete();
        return response()->noContent();
    }
}
