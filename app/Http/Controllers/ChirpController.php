<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ChirpController extends Controller
{

	use AuthorizesRequests;
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{

		// Paginate through chirps
		$chirps = Chirp::with('user')
			->latest()
			->simplePaginate(5);

		// If page query is 1, redirect to home page
		if ((int) $request->query('page') === 1) {
			return redirect()->route('home');
		}

		return view('home', ['chirps' => $chirps]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// Validate the request
		$validated = $request->validate([
			'message' => 'required|string|max:255',
		], [
			'message.required' => 'Please write something to chirp!',
			'message.max' => 'Chirps must be 255 characters or less.',
		]);

		// Create the chirp assigned to specific user
		auth()->user()->chirps()->create($validated);

		// Redirect back to the feed
		return redirect()->route('home')->with('success', 'Your chirp has been posted!');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Chirp $chirp)
	{
		// Validate User
		$this->authorize('update', $chirp);

		return view('chirps.edit', compact('chirp'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Chirp $chirp)
	{
		// Validate User
		$this->authorize('update', $chirp);

		// Validate the request
		$validated = $request->validate([
			'message' => 'required|string|max:255',
		], [
			'message.required' => 'Please write something to chirp!',
			'message.max' => 'Chirps must be 255 characters or less.',
		]);

		// Update the chirp
		$chirp->update($validated);

		// Redirect back to the feed
		return redirect()->route('home')->with('success', 'Your chirp has been updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Chirp $chirp)
	{
		// Validate USer
		$this->authorize('delete', $chirp);

		// Delete the chirp
		$chirp->delete();

		// Redirect back to the feed
		return redirect()->route('home')->with('success', 'Your chirp has been deleted!');
	}
}
