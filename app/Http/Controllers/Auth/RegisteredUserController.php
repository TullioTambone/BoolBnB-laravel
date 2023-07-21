<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => 'date_format:Y-m-d|before:2006-01-01|after:1923-01-01|date'
            
        ],
        [
            'email.required' => 'Il campo E-mail è richiesto',
            'email.string' => 'Il campo E-mail non può contenere solo numeri',
            'email.email' => 'Il formato E-mail deve essere: "BoolBnb@mail.com"',
            'email.max' => 'Il campo E-mail deve avere massimo 255 caratteri',
            'email.unique' => 'Il campo E-mail deve essere univoco ed è già presente',
            'password.required' => 'Il campo Password è richiesto',
            'password.confirmed' => 'Il campo Password deve essere confermato riempendo il campo Conferma Password',
            'birthday.date_format' => 'Il formato della data deve rispettare la seguente tipologia giorno/mese/anno',
            'birthday.before' => 'Devi avere almeno 16 anni per creare un appartamento',
            'birthday.after' => 'Noi di Boolbnb crediamo che tu non possa essere ancora insieme a noi!!!',
            'birthday.date' => 'Il formato non è valido'
        ]
    );

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
