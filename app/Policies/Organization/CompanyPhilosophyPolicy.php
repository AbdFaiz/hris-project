<?php

declare(strict_types=1);

namespace App\Policies\Organization;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Organization\CompanyPhilosophy;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPhilosophyPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CompanyPhilosophy');
    }

    public function view(AuthUser $authUser, CompanyPhilosophy $companyPhilosophy): bool
    {
        return $authUser->can('View:CompanyPhilosophy');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CompanyPhilosophy');
    }

    public function update(AuthUser $authUser, CompanyPhilosophy $companyPhilosophy): bool
    {
        return $authUser->can('Update:CompanyPhilosophy');
    }

    public function delete(AuthUser $authUser, CompanyPhilosophy $companyPhilosophy): bool
    {
        return $authUser->can('Delete:CompanyPhilosophy');
    }

    public function restore(AuthUser $authUser, CompanyPhilosophy $companyPhilosophy): bool
    {
        return $authUser->can('Restore:CompanyPhilosophy');
    }

    public function forceDelete(AuthUser $authUser, CompanyPhilosophy $companyPhilosophy): bool
    {
        return $authUser->can('ForceDelete:CompanyPhilosophy');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CompanyPhilosophy');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CompanyPhilosophy');
    }

    public function replicate(AuthUser $authUser, CompanyPhilosophy $companyPhilosophy): bool
    {
        return $authUser->can('Replicate:CompanyPhilosophy');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CompanyPhilosophy');
    }

}