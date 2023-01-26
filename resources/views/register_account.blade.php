<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="registeren">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            @foreach ($users as $user)
                @if (Auth::user()->email == $user->email)
                    @if ($user->role_id == 1)
                        <x-input id="role_id"
                        type="text"
                        name="role_id" hidden="true" value="2" />
                        <x-label for="schoolnaam" value="School naam" />
                        <x-input id="schoolnaam"
                        type="text"
                        name="schoolnaam" />
                        <x-label for="schooladdress" value="School adres" />
                        <x-input id="schooladdress"
                        type="text"
                        name="schooladres" />
                        <x-label for="schoolplaats" value="Plaatsnaam" />
                        <x-input id="schoolplaats"
                        type="text"
                        name="schoolplaats" />

                    @endif
                    @if ($user->role_id == 2)
                    <x-input id="role_id"
                        type="text"
                        name="role_id" hidden="true" value="3" />
                        <x-label for="klasnaam" value="Klas naam" />
                        <x-input id="klasnaam"
                        type="text"
                        name="klasnaam" />
                    @endif
                    @if ($user->role_id == 3)
                    <x-input id="role_id"
                        type="text"
                        name="role_id" hidden="true" value="4" />
                        <x-label for="leerlingnaam" value="leerling naam" />
                        <x-input id="leerlingnaam"
                        type="text"
                        name="leerlingnaam" />
                    @endif
                @endif
            @endforeach
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
