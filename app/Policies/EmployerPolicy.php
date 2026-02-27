<?php

namespace App\Policies;

use App\Models\Employer;
use App\Models\User;

class EmployerPolicy
{
    public function create(User $user)
    {
        return !$user->employer()->exists();
    }

    public function store(User $user)
    {
        // Usually same as create
        return !$user->employer()->exists();
    }
    
}