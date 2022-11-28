<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Info Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('userUpdate', $user->id) }}">
                        @csrf

                        <!-- Username -->
                        <div class=" mt-4 grid-cols-2">
                            <x-input-label for="username" :value="__('Username')" />

                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                                value="{{ $user->username }}" readonly />

                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Fullname -->
                        <div class=" mt-4">
                            <x-input-label for="fullname" :value="__('Fullname*')" />

                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname"
                                value="{{ $user->fullname }}" />

                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                value="{{ $user->email }}" readonly />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!--New Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('New Password*')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password*')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class=" mt-4">
                            <x-input-label for="address" :value="__('Alamat*')" />

                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                value="{{ $user->address }}" />

                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Birthdate -->
                        <div class=" mt-4">
                            <x-input-label for="birthdate" :value="__('Tanggal Lahir')" />

                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                value="{{ $user->birthdate }}" readonly />

                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                        </div>

                        <!-- Phone number -->
                        <div class=" mt-4">
                            <x-input-label for="phoneNumber" :value="__('No Telepon*')" />

                            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber"
                                value="{{ $user->phoneNumber }}" />

                            <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                        </div>

                        <!-- religion -->
                        <div class=" mt-4">
                            <x-input-label for="religion" :value="__('Agama')" />

                            <x-text-input id="religion" class="block mt-1 w-full" type="text" name="religion"
                                value="{{ $user->religion }}" readonly />

                            <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                        </div>

                        <!-- gender -->
                        <div class=" mt-4">
                            <x-input-label for="gender" :value="__('Gender')" />

                            <select name="gender" id="gender" class="form-select" readonly>
                                <option value="-1" @if (old('gender', $user->gender) == -1) selected @endif>
                                    Pilih satu
                                </option>
                                <option value="1" @if (old('gender', $user->gender) == 1) selected @endif>
                                    Laki-laki
                                </option>
                                <option value="2" @if (old('gender', $user->gender) == 2) selected @endif>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="ButtonSubmit" id="ButtonSubmit"
                                class="btn btn-outline-primary mt-4">Submit</button>

                            <button type="reset" name="ButtonReset" id="ButtonReset"
                                class="btn btn-outline-danger mt-4">
                                Reset</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
