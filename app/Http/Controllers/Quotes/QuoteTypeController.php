<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;

use App\Models\Quotes\QuoteType;
use Illuminate\Http\Request;

class QuoteTypeController extends Controller
{
    public function get()
    {
        return QuoteType::get();
    }


    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'icon' => 'string|nullable',
        ]);

        return QuoteType::create($validated);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:quote_types,id',
            'name' => 'string|required',
            'icon' => 'string|nullable',
        ]);

        $quoteType = QuoteType::findOrFail($validated['id']);
        $quoteType->update($validated);
        return $quoteType;
    }

    public function destroy(int $id)
    {
        $quoteType = QuoteType::findOrFail($id);
        if ($quoteType->quotes()->exists()) {
            return response()->json(['error' => 'Cannot delete quote type with existing quotes'], 422);
        }
        $quoteType->delete();
        return response()->noContent();
    }
}
