@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Profil</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="w-full h-48 my-5">
                <x-dialog>
                    <div class="relative w-fit mx-auto group">
                        <x-avatar class="mx-auto w-48 h-48 rounded-full overflow-hidden">
                            <x-avatar.image id="avatarPreviewTrigger" class="object-cover w-full h-full"
                                src="{{ $user->profile_photo ?: asset('assets/user.png') }}" alt="Avatar" />
                        </x-avatar>
                        <x-dialog.trigger>
                            <div
                                class="absolute top-0 left-0 w-48 h-48 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center cursor-pointer">
                                <img src="{{ asset('assets/pencil.png') }}" alt="Edit" class="w-10 h-10" />
                            </div>
                        </x-dialog.trigger>
                    </div>

                    <x-dialog.content
                        class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 sm:max-w-[425px] z-50 bg-white rounded shadow-lg p-6">
                        <div class="grid gap-4">
                            <x-dialog.header>
                                <x-dialog.title>
                                    Change Avatar
                                </x-dialog.title>
                            </x-dialog.header>
                            <div class="grid gap-4 py-4">
                                <x-avatar class="mx-auto w-48 h-48 rounded-full overflow-hidden">
                                    <x-avatar.image id="avatarPreview" class="object-cover w-full h-full"
                                        src="{{ $user->profile_photo ?: asset('assets/user.png') }}" alt="Avatar" />
                                </x-avatar>

                                <x-input placeholder="Foto Profil" name="profile_photo" type="file"
                                    id="profilePhotoInput" />
                            </div>

                            <x-dialog.footer>
                                <x-button type="submit">Save changes</x-button>
                            </x-dialog.footer>

                        </div>
                    </x-dialog.content>
                </x-dialog>
            </div>
            <div class="flex flex-col gap-4">
                <x-input name="name" :value="old('name', $user->name)" />
                <x-input name="email" type="email" :value="old('email', $user->email)" />
                <x-input name="birthdate" type="date" :value="old('birthdate', $user->birthdate)" />

                <x-button class="mt-4 w-full cursor-pointer" type="submit">Simpan Perubahan</x-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <x-button variant="outline" type="submit" class="w-full cursor-pointer">Logout</x-button>
        </form>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector('#profilePhotoInput');
        const previewImageTrigger = document.querySelector('#avatarPreviewTrigger');
        const previewImageDialog = document.querySelector('#avatarPreview');

        if (input && previewImageTrigger) {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImageTrigger.src = e.target.result;
                        if (previewImageDialog) {
                            previewImageDialog.src = e.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
