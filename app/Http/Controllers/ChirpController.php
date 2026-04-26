<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		/*$chirps = Chirp::with('user')
			->latest()
			->take(50)  // Limit to 50 most recent chirps
			->get();*/

		$chirps = Chirp::with('user')
			->latest()
			->simplePaginate(3);

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

		// Create the chirp (no user for now - we'll add auth later)
		Chirp::create([
			'message' => $validated['message'],
			'user_id' => null, // We'll add authentication in lesson 11
		]);

		// Redirect back to the feed
		//return redirect('/')->with('success', 'Chirp created!');
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
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
