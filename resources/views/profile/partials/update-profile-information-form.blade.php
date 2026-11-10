<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

         <input type="hidden" name="remove_image" id="remove_image" value="0">

        <div>
            <x-ui_items.input-label for="first_name" :value="__('First name')" />
            <x-ui_items.text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-ui_items.input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-ui_items.input-label for="last_name" :value="__('Last name')" />
            <x-ui_items.text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                :value="old('last_name', $user->last_name)" required autocomplete="last_name" />
            <x-ui_items.input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-ui_items.input-label for="phone" :value="__('Phone')" />
            <x-ui_items.text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autocomplete="phone" />
            <x-ui_items.input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>


        <div>
            <x-ui_items.input-label for="email" :value="__('Email')" />
            <x-ui_items.text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-ui_items.input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <input type="file" name="avatar" class="dropify" id="avatarDropify" data-height="150"
                data-default-file="{{ $user?->avatar ? Storage::url($user->avatar) : '' }}" />


        </div>

        <div class="flex items-center gap-4">
            <x-ui_items.primary-button>{{ __('Save') }}</x-ui_items.primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
$('.dropify').on('dropify.afterClear', function (event, element) {
    document.getElementById('remove_image').value = '1';
});
</script>