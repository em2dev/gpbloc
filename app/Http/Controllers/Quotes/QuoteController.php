<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;
use App\Models\Quotes\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuoteController extends Controller
{
    public function get()
    {
        return Quote::with(['quoteType', 'product.items', 'option.items', 'transportation.items','client'])->get();
    }

    public function show(Quote $quote)
    {

    }

    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'order_date' => 'date|nullable',
            'delivery_date' => 'date|nullable',
            'start_date' => 'date|nullable',
            'end_date' => 'date|nullable',
            'PO_client' => 'string|nullable',
            'PO_GPBloc' => 'string|nullable',
            'subtotal' => 'numeric|nullable',
            'discount' => 'numeric|nullable',
            'total' => 'numeric|nullable',
            'quote_type_id' => 'exists:quote_types,id|nullable',
        ]);


        $validated['order_date'] = Carbon::createFromDate($request->order_date)->format('Y-m-d');
        $validated['delivery_date'] = Carbon::createFromDate($request->delivery_date)->format('Y-m-d');
        $validated['start_date'] = Carbon::createFromDate($request->start_date)->format('Y-m-d');
        $validated['end_date'] = Carbon::createFromDate($request->end_date)->format('Y-m-d');

        $validated['status'] = 'pending';

        $quote = Quote::updateOrCreate(['id' => $request->id],$validated);
        $quote->code = 'SOUM' . $quote->created_at->year . sprintf("%02s", $quote->created_at->month) . sprintf("%02s", $quote->created_at->day) . '-' . sprintf("%04s", $quote->id);
        $quote->save();
        return $quote;
    }

    public function edit(int $id) {
        $quote = Quote::findOrFail($id);
        $form = [];
        $form['quote'] = $quote;
        $quote->load(['quoteType', 'product', 'product.items', 'option', 'option.items', 'transportation', 'transportation.items','client', 'notes']);
        $form['type'] = $quote->quoteType;
        $form['products'] = $quote->product;
        $form['options'] = $quote->option;
        $form['transportation'] = $quote->transportation;
        $form['client'] = $quote->client;
        $form['notes'] = $quote->notes;
        return Inertia::render('Quotes/Create', [
            'quote' => $form,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();
        return response()->noContent();
    }
}
