<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Masukan Informasi Pengguna</b>

                    <form method="post" action="{{ url('register') }}">
                        @csrf

                        <!-- Username -->
                        <div class=" mt-4 grid-cols-2">
                            <x-input-label for="username" :value="__('Username')" />

                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                                :value="old('username')" required autofocus />

                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Fullname -->
                        <div class=" mt-4">
                            <x-input-label for="fullname" :value="__('Fullname')" />

                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname"
                                :value="old('ullname')" required />

                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class=" mt-4">
                            <x-input-label for="address" :value="__('Alamat')" />

                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old('address')" required />

                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Birthdate -->
                        <div class=" mt-4">
                            <x-input-label for="birthdate" :value="__('Tanggal Lahir')" />

                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="old('birthdate')" required />

                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                        </div>

                        <!-- Phone number -->
                        <div class=" mt-4">
                            <x-input-label for="phoneNumber" :value="__('No Telepon')" />

                            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber"
                                :value="old('phoneNumber')" required />

                            <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                        </div>

                        <!-- religion -->
                        <div class=" mt-4">
                            <x-input-label for="religion" :value="__('Agama')" />

                            <x-text-input id="religion" class="block mt-1 w-full" type="text" name="religion"
                                :value="old('religion')" />

                            <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                        </div>

                        <!-- gender -->
                        <div class=" mt-4">
                            <x-input-label for="gender" :value="__('Gender')" />

                            <input id="male" type="radio" value="1" name="gender"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="male"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laki-laki</label>

                            <br>

                            <input id="female" type="radio" value="2" name="gender"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="female"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Perempuan</label>

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
