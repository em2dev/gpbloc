<?php

namespace App\Http\Controllers\Quotes;

use App\Http\Controllers\Controller;
use App\Models\Quotes\QuoteClient;
use App\Models\TeamClient;
use Illuminate\Http\Request;

class QuoteClientController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'quote_id' => 'exists:quotes,id|required',
            'name' => 'string|nullable',
            'phone' => 'string|nullable',
            'email' => 'string|nullable',
            'website' => 'string|nullable',
            'description' => 'string|nullable',
            'address' => 'string|nullable',
            'city' => 'string|nullable',
            'province' => 'string|nullable',
            'zip' => 'string|nullable',
            'delivery_address' => 'string|nullable',
            'delivery_city' => 'string|nullable',
            'delivery_province' => 'string|nullable',
            'delivery_zip' => 'string|nullable',
            'contact_first_name' => 'string|nullable',
            'contact_last_name' => 'string|nullable',
            'contact_email' => 'string|nullable',
            'contact_phone' => 'string|nullable',
        ]);

        $teamClient = TeamClient::where('name', $request->name)->first();
        if ($teamClient) {
            $teamClient->update($validated);
        } else {
            $validated['team_id'] = auth()->user()->currentTeam->id ?? null;
            TeamClient::create($validated);
        }

        return QuoteClient::updateOrCreate(['id' => $request->id],$validated);
    }

    public function destroy(QuoteClient $quoteClient)
    {
        $quoteClient->delete();
        return response()->noContent();
    }
}
