<?php

namespace Modules\Profile\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;
use Modules\Profile\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile::edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $ext = $file->extension();
            $filename = "user_{$user->id}_" . time() . ".{$ext}";

            if ($user->profile_photo) {
                $deleteResponse = Http::withHeaders([
                    'apikey' => config('services.supabase.key'),
                    'Authorization' => 'Bearer ' . config('services.supabase.key'),
                ])->delete(
                    config('services.supabase.url')
                    . "/storage/v1/object/"
                    . config('services.supabase.bucket')
                    . "/" . basename($user->profile_photo)
                );

                if ($deleteResponse->failed()) {
                    // Optionally log the failure or handle it as needed
                    // For now, just continue without interrupting the update
                }
            }

            $response = Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])
                ->attach('file', fopen($file->getRealPath(), 'r'), $filename)
                ->post(
                    config('services.supabase.url')
                    . "/storage/v1/object/" . config('services.supabase.bucket') . "/{$filename}"
                );

            if ($response->failed()) {
                return back()->withErrors(['profile_photo' => 'Gagal upload avatar']);
            }

            // Simpan URL publik
            $user->profile_photo = config('services.supabase.url')
                . "/storage/v1/object/public/"
                . config('services.supabase.bucket')
                . "/{$filename}";
        }

        // Update data lain
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthdate = $request->input('birthdate');
        $user->save();

        return redirect()->route('profile.edit')
            ->with('status', 'Profile updated success.');
    }
}
