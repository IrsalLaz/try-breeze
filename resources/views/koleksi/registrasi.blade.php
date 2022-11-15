<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Koleksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ url('koleksiStore') }}" class=" col-lg-6">
                        @csrf

                        <div class=" mt-4">
                            <x-input-label for="namaKoleksi" :value="__('Nama')" />

                            <x-text-input id="namaKoleksi" class="block mt-1 w-full" type="text" name="namaKoleksi"
                                :value="old('namaKoleksi')" />

                            <x-input-error :messages="$errors->get('namaKoleksi')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="jenisKoleksi" :value="__('Jenis Koleksi')" />

                            <input id="jenis1" type="radio" value="1" name="jenisKoleksi"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="jenis1"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Buku</label>
                            <br>
                            <input id="jenis2" type="radio" value="2" name="jenisKoleksi"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="jenis2"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Majalah</label>
                            <br>
                            <input id="jenis3" type="radio" value="3" name="jenisKoleksi"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="jenis3"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cakram Digital</label>
                        </div>

                        <div class=" mt-4">
                            <x-input-label for="jumlahKoleksi" :value="__('Jumlah Koleksi')" />

                            <x-text-input id="jumlahKoleksi" class="block mt-1 w-full" type="text"
                                name="jumlahKoleksi" :value="old('jumlahKoleksi')" />

                            <x-input-error :messages="$errors->get('JumlahKoleksi')" class="mt-2" />
                        </div>

                        <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Default</button>

                        <button type="submit" name="ButtonSubmit" id="ButtonSubmit"
                            class="btn btn-outline-primary mt-4">Submit</button>

                        <button type="reset" name="ButtonReset" id="ButtonReset" class="btn btn-outline-primary mt-4">
                            Reset</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
