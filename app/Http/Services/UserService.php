<?php

namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService {
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($data){
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function findById($id){
        return User::find($id);
    }

    public function updateOrCreate($data): User{
        $updatedUser = $this->user->updateOrCreate(
            ['id' => $data['id']], 
            $data
        );

        return $updatedUser;
    }
    
}