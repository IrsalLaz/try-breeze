<x-app-layout>
    @push('scripts')
        <script>
            $(function() {
                $('#userTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('user') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'fullname',
                            name: 'fullname'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'phoneNumber',
                            name: 'phoneNumber'
                        },
                        {
                            data: 'birthdate',
                            name: 'birthdate'
                        },
                        {
                            data: 'religion',
                            name: 'religion'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
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
            {{ __('Daftar Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class=" table table-stripped table-hover  mt-4" id="userTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Gender</th>
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
