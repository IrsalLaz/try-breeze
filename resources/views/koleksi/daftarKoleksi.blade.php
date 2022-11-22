<x-app-layout>
    @push('scripts')
        <script>
            $(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('koleksi') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'namaKoleksi',
                            name: 'namaKoleksi'
                        },
                        {
                            data: 'jumlahKoleksi',
                            name: 'jumlahKoleksi'
                        },
                    ]
                });
            });
        </script>
    @endpush


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Koleksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 raw form-inline">
                    <table class=" table table-stripped mt-4" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Jumlah</th>
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


{{-- @foreach ($collections as $collection)
    <td>{{ $collection->id }}</td>
    <td>{{ $collection->namaKoleksi }}</td>
    <td>{{ $collection->jenisKoleksi }}</td>
    <td>{{ $collection->jumlahKoleksi }}</td>
@endforeach --}}
