@extends('layouts.parent')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('alert') }}">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="mt-2">Data User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="POST" class="mt-3">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            placeholder="Nama" value="{{ $user->nama }}" required>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="no_hp">No HP</label>
                        <input type="number" name="no_hp" value="{{ $user->no_hp }}"
                            class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="08xxxx"
                            required>
                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_hp">Jenis Pekerjaan</label>
                    <input type="text" name="jenis_pekerjaan" value="{{ $user->jenis_pekerjaan }}"
                        class="form-control @error('jenis_pekerjaan') is-invalid @enderror" id="no_hp"
                        placeholder="IT Consultant" required>
                    @error('jenis_pekerjaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputAddress">Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required id="alamat"
                        cols="30" rows="10" placeholder="Jln. xxxx">{{ $user->alamat }}</textarea>
                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputAddress">Upload Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="customFile"
                            name="foto" required>
                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label class="custom-file-label" for="customFile">Pilih Foto</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
@endsection
