<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laravel\Sanctum\PersonalAccessToken;

class ApiTokenController extends Controller
{
    /**
     * Generate a new api token for a user.
     */
    public function create(Request $request): RedirectResponse
    {
        $request->user()->createToken('api-token');

        return Redirect::route('profile.edit')->with('status', 'api-token-generated');
    }

    /**
     * Delete the user's api token.
     */
    public function destroy(Request $request, PersonalAccessToken $token): RedirectResponse
    {
        $token->delete();

        return Redirect::route('profile.edit')->with('status', 'api-token-deleted');
    }
}
