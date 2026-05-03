<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy
{
	/**
	 * Determine whether the user can view any chirps.
	 */
	public function viewAny(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can view chirps.
	 */
	public function view(User $user, Chirp $chirp): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create chirps.
	 */
	public function create(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can update chirps.
	 */
	public function update(User $user, Chirp $chirp): bool
	{
		return $chirp->user()->is($user);
	}

	/**
	 * Determine whether the user can delete chirps.
	 */
	public function delete(User $user, Chirp $chirp): bool
	{
		return $chirp->user()->is($user);
	}

	/**
	 * Determine whether the user can restore chirps.
	 */
	public function restore(User $user, Chirp $chirp): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can permanently delete chirps.
	 */
	public function forceDelete(User $user, Chirp $chirp): bool
	{
		return false;
	}
}
