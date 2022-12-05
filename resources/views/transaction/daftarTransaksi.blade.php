<x-app-layout>
    @push('scripts')
        <script>
            $(function() {
                $('#transactionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('transaksi') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'peminjam',
                            name: 'peminjam'
                        },
                        {
                            data: 'petugas',
                            name: 'petugas'
                        },
                        {
                            data: 'tanggalPinjam',
                            name: 'tanggalPinjam'
                        },
                        {
                            data: 'tanggalSelesai',
                            name: 'tanggalSelesai'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class=" table table-stripped table-hover  mt-4" id="transactionTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Petugas</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Selesai</th>
                                <th>Opsi</th>
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
