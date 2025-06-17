<?php
namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Models\User;

class RegisterController extends Controller 
{
        public function showRegistrationForm()
    {
        return view('auth::register');
    }

    public function register(Request $request)
{
    \Log::info('Reached RegisterController@register', $request->all());
    $data = $request->validate([
        'name'                  => ['required','string','max:255'],
        'email'                 => ['required','email','max:255','unique:users'],
        'password'              => ['required','confirmed','min:8'],
        'birthdate'             => ['required','date'],
    ]);

    // Dengan model di atas, password otomatis bcrypt & id UUID otomatis
    $user = User::create([
        'name'       => $data['name'],
        'email'      => $data['email'],
        'password'   => $data['password'],    
        'birthdate'  => $data['birthdate'],
    ]);
    \Log::info('User created:', ['id' => $user->id]);

    auth()->login($user);

    return redirect('login');
}
}