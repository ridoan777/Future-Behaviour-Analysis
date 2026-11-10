<x-guest-layout>
	<!-- Session Status -->
	<x-ui_items.auth-session-status class="mb-4" :status="session('status')" />

	<!-- Alert Component -->
	<x-alert-component message="Login Attempt" />
	<!-- Alert Component -->

	<form method="POST" action="{{ route('login') }}">
		@csrf

		<!-- Email Address -->
		<div>
			<x-ui_items.input-label for="email" :value="__('Email')" />
			<x-ui_items.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
				required autofocus autocomplete="username" />
			<x-ui_items.input-error :messages="$errors->get('email')" class="mt-2" />
		</div>

		<!-- Password -->
		<div class="mt-4">
			<x-ui_items.input-label for="password" :value="__('Password')" />

			<x-ui_items.text-input id="password" class="block mt-1 w-full" type="password" name="password" required
				autocomplete="current-password" />

			<x-ui_items.input-error :messages="$errors->get('password')" class="mt-2" />
		</div>

		<!-- Remember Me -->
		<div class="block mt-4">
			<label for="remember_me" class="inline-flex items-center">
				<input id="remember_me" type="checkbox"
					class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
				<span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
			</label>
		</div>

		<div class="flex items-center justify-end mt-4">
			@if (Route::has('password.request'))
				<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
					href="{{ route('password.request') }}">
					{{ __('Forgot your password?') }}
				</a>
			@endif

			<x-ui_items.primary-button class="ms-3">
				{{ __('Log in') }}
			</x-ui_items.primary-button>
		</div>
	</form>
	<div class="flex items-center justify-end mt-4">
		<a class="underline text-sm text-gray-600 hover:text-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
			href="{{ route('register') }}">
			{{ __('New here? Register.') }}
		</a>
	</div>

</x-guest-layout>