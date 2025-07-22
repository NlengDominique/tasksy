<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getUserProfile(Request $request)
    {
        return response()->json($request->user());
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $user = Auth::user();
            \Illuminate\Support\Facades\Gate::authorize('update-profile', $user);
            $data = $request->validate([
                    'username' => 'required|string',
                ]
            );
            $user->update($data);
            return response()->json(["message" => "User updated successfully"]);
        }
        catch (\Exception $e){
            Log::error($e);
            return response()->json(["message" => "Error updating user"], 500);
        }

    }

}
