@extends('layouts.parent')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('alert') }}">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            {{-- <h4 class="mt-2">Data User</h4> --}}
            <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary my-3">Tambah User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code User</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Asal</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row->no_user != null ? $row->no_user : '-' }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>{{ $row->jenis_pekerjaan }}</td>
                                <td>{{ $row->asal }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>
                                    @if ($row->is_active == 0)
                                        <span class="badge badge-danger">Non-Aktif</span>
                                    @elseif ($row->is_active == 1)
                                        <span class="badge badge-warning">Menunggu Aktivasi</span>
                                    @elseif ($row->is_active == 2)
                                        <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="button-group">
                                        <a href="{{ route('admin.user.edit', ['id' => $row->id]) }}"
                                            class="btn btn-sm btn-warning mb-1">Edit</a>
                                        <button class="btn btn-sm btn-danger mb-1 buttonDelete"
                                            data-id="{{ $row->id }}">Hapus</button>
                                        @if (!in_array($row->is_active, [0, 2]))
                                            <button class="btn btn-sm btn-success mb-1 buttonAktivasi"
                                                data-id="{{ $row->id }}">Aktivasi</button>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.user.aktivasi') }}" method="POST" class="d-none form_aktivasi">
        @csrf
        <input type="hidden" name="id_registrasi_user" id="id_registrasi_user">
    </form>
    <form action="{{ route('admin.user.delete') }}" method="POST" class="d-none form_delete">
        @csrf
        <input type="hidden" name="id_registrasi_user" id="id_registrasi_user_delete">
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $('.buttonAktivasi').on('click', function() {
            $('#id_registrasi_user').val($(this).attr('data-id'))

            Swal.fire({
                title: 'Are you sure?',
                text: "User akan diaktivasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proses it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tunggu Sebentar',
                        html: 'Sedang Melakukan Aktivasi...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                            $('.form_aktivasi').submit()
                        }
                    })
                }
            })
        })

        $('.buttonDelete').on('click', function() {
            $('#id_registrasi_user_delete').val($(this).attr('data-id'))

            Swal.fire({
                title: 'Are you sure?',
                text: "User akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proses it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tunggu Sebentar',
                        html: 'Sedang Melakukan Penghapusan...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                            $('.form_delete').submit()
                        }
                    })
                }
            })
        })

    </script>
@endsection
