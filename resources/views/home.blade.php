<x-layout>
	<x-slot:title>
		Welcome
	</x-slot:title>
	<div class="max-w-2xl mx-auto">
		<div class="card bg-base-100 shadow mt-8">
			<div class="card-body">
				<div>
					<h1 class="text-3xl font-bold">Welcome to Chirper!</h1>
					<p class="mt-4 text-base-content/60">This is your brand new Laravel application. Time to make it sing (or chirp)!</p>
				</div>
			</div>
		</div>

		@forelse ($chirps as $chirp)
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <div>
                        <div class="font-semibold"> {{ $chirp->user ? $chirp->user->name : 'Anonymous' }}</div>
                        <div class="mt-1">{{ $chirp->message }}</div>
                        <div class="text-sm text-gray-500 mt-2">
                            {{ $chirp->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No chirps yet. Be the first to chirp!</p>
        @endforelse
	</div>
</x-layout>