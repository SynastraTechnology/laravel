<?php
namespace Modules\Profile\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Profile\Requests\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;

class ProfileApiController extends Controller
{
    /**
     * Display the authenticated user's profile
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        
        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile_photo_url' => $user->profile_photo_url,
                'bio' => $user->bio,
                'phone' => $user->phone,
                'address' => $user->address,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]);
    }

    /**
     * Update the authenticated user's profile
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        
        $validated = $request->validated();
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->extension();
            
            // Upload to Supabase
            $response = Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])
                ->attach('file', fopen($file->getRealPath(), 'r'), $filename)
                ->post(config('services.supabase.url') . "/storage/v1/object/" . config('services.supabase.avatars_bucket') . "/{$filename}");

            if (!$response->failed()) {
                $validated['profile_photo_path'] = config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.avatars_bucket') . "/{$filename}";
            }
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile_photo_url' => $user->profile_photo_url,
                'bio' => $user->bio,
                'phone' => $user->phone,
                'address' => $user->address,
            ]
        ]);
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request): JsonResponse
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = $request->user();
        
        // Delete old avatar if exists
        if ($user->profile_photo_path) {
            $oldPath = str_replace(config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.avatars_bucket') . "/", "", $user->profile_photo_path);
            
            Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])->delete(config('services.supabase.url') . "/storage/v1/object/" . config('services.supabase.avatars_bucket') . "/{$oldPath}");
        }

        // Upload new avatar
        $file = $request->file('profile_photo');
        $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->extension();
        
        $response = Http::withHeaders([
            'apikey' => config('services.supabase.key'),
            'Authorization' => 'Bearer ' . config('services.supabase.key'),
        ])
            ->attach('file', fopen($file->getRealPath(), 'r'), $filename)
            ->post(config('services.supabase.url') . "/storage/v1/object/" . config('services.supabase.avatars_bucket') . "/{$filename}");

        if (!$response->failed()) {
            $avatarUrl = config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.avatars_bucket') . "/{$filename}";
            $user->update(['profile_photo_path' => $avatarUrl]);
            
            return response()->json([
                'message' => 'Avatar updated successfully',
                'data' => ['profile_photo_url' => $user->profile_photo_url]
            ]);
        }

        return response()->json([
            'message' => 'Failed to upload avatar'
        ], 500);
    }

    /**
     * Delete user avatar
     */
    public function deleteAvatar(Request $request): JsonResponse
    {
        $user = $request->user();
        
        if ($user->profile_photo_path) {
            $oldPath = str_replace(config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.avatars_bucket') . "/", "", $user->profile_photo_path);
            
            Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])->delete(config('services.supabase.url') . "/storage/v1/object/" . config('services.supabase.avatars_bucket') . "/{$oldPath}");
            
            $user->update(['profile_photo_path' => null]);
        }

        return response()->json([
            'message' => 'Avatar deleted successfully'
        ]);
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Password updated successfully'
        ]);
    }
}
