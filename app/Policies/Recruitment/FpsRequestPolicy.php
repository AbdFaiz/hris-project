<?php

declare(strict_types=1);

namespace App\Policies\Recruitment;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Recruitment\FpsRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class FpsRequestPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FpsRequest');
    }

    public function view(AuthUser $authUser, FpsRequest $fpsRequest): bool
    {
        return $authUser->can('View:FpsRequest');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FpsRequest');
    }

    public function update(AuthUser $authUser, FpsRequest $fpsRequest): bool
    {
        return $authUser->can('Update:FpsRequest');
    }

    public function delete(AuthUser $authUser, FpsRequest $fpsRequest): bool
    {
        return $authUser->can('Delete:FpsRequest');
    }

    public function restore(AuthUser $authUser, FpsRequest $fpsRequest): bool
    {
        return $authUser->can('Restore:FpsRequest');
    }

    public function forceDelete(AuthUser $authUser, FpsRequest $fpsRequest): bool
    {
        return $authUser->can('ForceDelete:FpsRequest');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FpsRequest');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FpsRequest');
    }

    public function replicate(AuthUser $authUser, FpsRequest $fpsRequest): bool
    {
        return $authUser->can('Replicate:FpsRequest');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FpsRequest');
    }

}