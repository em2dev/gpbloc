<?php

namespace App\Http\Controllers;

use App\Models\TeamClient;
use Illuminate\Http\Request;

class TeamClientController extends Controller
{
    public function get()
    {
        return TeamClient::get();
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'exists:teams,id|required',
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

        return TeamClient::create($validated);
    }

    public function update(Request $request, TeamClient $teamClient)
    {
        $validated = $request->validate([
            'team_id' => 'exists:teams,id|required',
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

        $teamClient->update($validated);
        return $teamClient;
    }

    public function destroy(TeamClient $teamClient)
    {
        $teamClient->delete();
        return response()->noContent();
    }
}
