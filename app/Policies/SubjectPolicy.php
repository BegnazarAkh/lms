<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;

class SubjectPolicy
{
    /**
     * Determine whether the user can view the subject.
     */
    public function view(User $user, Subject $subject): bool
    {
        // Teachers see only their own subjects
        return $user->role === 'teacher'
            && $subject->user_id === $user->id;
    }

    /**
     * Determine whether the user can create subjects.
     */
    public function create(User $user): bool
    {
        return $user->role === 'teacher';
    }

    /**
     * Determine whether the user can update the subject.
     */
    public function update(User $user, Subject $subject): bool
    {
        return $this->view($user, $subject);
    }

    /**
     * Determine whether the user can delete the subject.
     */
    public function delete(User $user, Subject $subject): bool
    {
        return $this->view($user, $subject);
    }

    // (other methods left as default or you can add restore/forceDelete if using soft deletes)
}
