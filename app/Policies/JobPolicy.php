<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;
class JobPolicy
{
    public function viewAny(?User $user)
    {
        return true;
    }
    public function viewAnyEmployer(User $user)
    {
        return true;
    }

    public function view(?User $user, Job $job)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->employer !== null;
    }

    public function update(User $user, Job $job): bool|Response
    {
        if ($job->employer->user_id !== $user->id) {
            return false;
        }
        if ($job->jobApplications()->count() > 0) {
            return Response::deny('Cannot update a job that has applications');
        }
        return true;
    }

    public function delete(User $user, Job $job)
    {
        return $job->employer->user_id === $user->id;
    }

    public function restore(User $user, Job $job)
    {
        return $job->employer->user_id === $user->id;
    }
    public function forceDelete(User $user, Job $job)
    {
        return $job->employer->user_id === $user->id;
    }

    public function apply(User $user, Job $job): bool
    {
        return !$job->hasUserApplied($user);
    }
}
