<?php

namespace App\Actions\Fortify;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input): User
    {
        $request = app(RegisterRequest::class);
        $validated = $request->validated();

        return User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    }
}
