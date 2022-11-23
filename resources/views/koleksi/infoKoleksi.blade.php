<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Info Koleksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ url('koleksiUpdate', $collection->id) }}">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="idKoleksi" :value="__('ID Koleksi')" />
                            <input type="text" id="id" name="id" class="form-control" autocomplete="off"
                                value="{{ $collection->id }}" readonly>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="namaKoleksi" :value="__('Judul Koleksi')" />
                            <input type="text" id="id" name="id" class="form-control" autocomplete="off"
                                value="{{ $collection->namaKoleksi }}" readonly>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="jenisKoleksi" :value="__('Jenis Koleksi')" />
                            <select name="jenisKoleksi" id="jenisKoleksi" class="form-select" required>
                                <option value="-1" @if (old('jenisKoleksi', $collection->jenis) == -1) selected @endif>
                                    Pilih satu
                                </option>
                                <option value="1" @if (old('jenisKoleksi', $collection->jenis) == 1) selected @endif>
                                    Buku
                                </option>
                                <option value="2" @if (old('jenisKoleksi', $collection->jenis) == 2) selected @endif>
                                    Majalah
                                </option>
                                <option value="3" @if (old('jenisKoleksi', $collection->jenis) == 3) selected @endif>
                                    Cakram Digital
                                </option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="jumlahKoleksi" :value="__('Jumlah Koleksi')" />
                            <input type="text" id="jumlahKoleksi" name="jumlahKoleksi" class="form-control"
                                autocomplete="off" value="{{ $collection->jumlahKoleksi }}">
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
