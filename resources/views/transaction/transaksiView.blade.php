<x-app-layout>
    @push('scripts')
        <script>
            $(function() {
                $('#viewTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('getAllDetailTransactions', $transactions->id) }}',
                    collumns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'koleksi',
                            name: 'koleksi'
                        },
                        {
                            data: 'tanggalPinjam',
                            name: 'tanggalPinjam'
                        },
                        {
                            data: 'tanggalKembali',
                            name: 'tanggalKembali'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ]
                });
            });
        </script>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-4">
                        <x-input-label> Peminjam </x-input-label>
                        <x-text-input type="text" id="peminjam" name="peminjam"
                            value="{{ $transactions->fullnamePeminjam }}" readonly />
                    </div>

                    <div class="mt-4 mb-4">
                        <x-input-label> Petugas </x-input-label>
                        <x-text-input type="text" id="petugas" name="petugas"
                            value="{{ $transactions->fullnamePetugas }}" readonly />
                    </div>

                    <table class=" table table-stripped table-hover mt-4" id="viewTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Koleksi</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
