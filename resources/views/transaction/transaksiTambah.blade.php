<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-center">
                    @if ($errors->any())
                        <div class="row form-inline" onclick="$(this).parent().remove();">
                            <div class="alert alert-success flex justify-between">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <span class="label"><strong>x</strong></span>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('transaksiStore') }}" class="col-lg-8">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="peminjam" :value="__('Peminjam')" />
                            <select name="idPeminjam" id="idPeminjam" class="form-select rounded-md" required>
                                <option value="-1">Pilih Dahulu</option>
                                @foreach ($users as $user)
                                    @if ($user->id == old('userPeminjam'))
                                        <option value="{{ $user->id }}" selected>{{ $user->fullname }}</option>
                                    @else
                                        <option value="{{ $user->id }}" selected>{{ $user->fullname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="koleksi1" :value="__('Koleksi 1*')" />
                            <select name="koleksi1" id="koleksi1" class="form-select rounded-md" required>
                                <option value="-1">Pilih Dahulu</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi1'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->namaKoleksi }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->namaKoleksi }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="koleksi2" :value="__('Koleksi 2')" />
                            <select name="koleksi2" id="koleksi2" class="form-select rounded-md" required>
                                <option value="-1">Pilih Dahulu</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi2'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->namaKoleksi }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->namaKoleksi }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="koleksi3" :value="__('Koleksi 3')" />
                            <select name="koleksi3" id="koleksi3" class="form-select rounded-md" required>
                                <option value="-1">Pilih Dahulu</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi3'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->namaKoleksi }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->namaKoleksi }}
                                        </option>
                                    @endif
                                @endforeach
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
