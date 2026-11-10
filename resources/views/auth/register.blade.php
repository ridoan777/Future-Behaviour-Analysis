<x-guest-layout>
    <!-- Alert Component -->
    <x-alert-component message="Form Submission" />
    <!-- Alert Component -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-ui_items.input-label for="first_name" :value="__('First Name')" />
            <x-ui_items.text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-ui_items.input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>
        <div>
            <x-ui_items.input-label for="last_name" :value="__('Last Name')" />
            <x-ui_items.text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-ui_items.input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-ui_items.input-label for="email" :value="__('Email')" />
            <x-ui_items.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-ui_items.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-ui_items.input-label for="password" :value="__('Password')" />

            <x-ui_items.text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-ui_items.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-ui_items.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-ui_items.text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-ui_items.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered? Login here.') }}
            </a>

            <x-ui_items.primary-button class="ms-4">
                {{ __('Register') }}
            </x-ui_items.primary-button>
        </div>
    </form>
</x-guest-layout>