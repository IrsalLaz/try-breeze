<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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

                    <form method="POST" action="{{ url('detailTransactionUpdate') }}" class="col-lg-8">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="idTransaksi" :value="__('ID Transaksi')" />
                            <x-text-input type="text" id="idTransaksi" name="idTransaksi" autocomplete="off"
                                value="{{ $detailTransaction->idTransaksi }}" readonly />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="idDetailTransaksi" :value="__('ID Detail Transaksi')" />
                            <x-text-input type="text" id="idDetailTransaksi" name="idDetailTransaksi"
                                autocomplete="off" value="{{ $detailTransaction->id }}" readonly />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="idPeminjam" :value="__('Peminjam')" />
                            <x-text-input type="text" id="idPeminjam" name="idPeminjam" autocomplete="off"
                                value="{{ $detailTransaction->peminjam }}" disabled />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="idPetugas" :value="__('Petugas')" />
                            <x-text-input type="text" id="idPetugas" name="idPetugas" autocomplete="off"
                                value="{{ $detailTransaction->petugas }}" disabled />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="koleksi" :value="__('Koleksi')" />
                            <x-text-input type="text" id="koleksi" name="koleksi" autocomplete="off"
                                value="{{ $detailTransaction->koleksi }}" disabled />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="form-select rounded-md" required>

                                <option value="1" @if (old('status', $detailTransaction->status) == 1) selected @endif>
                                    Pinjam
                                </option>
                                <option value="2" @if (old('status', $detailTransaction->status) == 2) selected @endif>
                                    Kembali
                                </option>
                                <option value="3" @if (old('status', $detailTransaction->status) == 3) selected @endif>
                                    Hilang
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
