<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['message'])] // Used to specify which field we should be able to add to the database
class Chirp extends Model
{
	// Tells us that a Chirp can have a single User associated with it
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
