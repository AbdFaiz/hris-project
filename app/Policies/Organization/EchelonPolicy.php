<?php

declare(strict_types=1);

namespace App\Policies\Organization;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Organization\Echelon;
use Illuminate\Auth\Access\HandlesAuthorization;

class EchelonPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Echelon');
    }

    public function view(AuthUser $authUser, Echelon $echelon): bool
    {
        return $authUser->can('View:Echelon');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Echelon');
    }

    public function update(AuthUser $authUser, Echelon $echelon): bool
    {
        return $authUser->can('Update:Echelon');
    }

    public function delete(AuthUser $authUser, Echelon $echelon): bool
    {
        return $authUser->can('Delete:Echelon');
    }

    public function restore(AuthUser $authUser, Echelon $echelon): bool
    {
        return $authUser->can('Restore:Echelon');
    }

    public function forceDelete(AuthUser $authUser, Echelon $echelon): bool
    {
        return $authUser->can('ForceDelete:Echelon');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Echelon');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Echelon');
    }

    public function replicate(AuthUser $authUser, Echelon $echelon): bool
    {
        return $authUser->can('Replicate:Echelon');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Echelon');
    }

}