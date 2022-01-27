<!DOCTYPE html>
<html lang="en">

@include('layouts.header')
@yield('style')

<body class="h-100">
    <div class="app is-primary">
        <div class="layout">
            <!-- Header START -->
            <div class="header mb-5">
                <div class="logo logo-dark border-0">
                    <a href="index.html">
                        <img src="{{ url('') }}/assets/images/logo/logo.png" alt="Logo">
                        <img class="logo-fold" src="{{ url('') }}/assets/images/logo/logo-fold.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white border-0">
                    <a href="index.html">
                        <img src="{{ url('') }}/assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="{{ url('') }}/assets/images/logo/logo-fold-white.png"
                            alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        {{-- <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li> --}}
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li>
                    </ul>

                </div>


            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="container my-5 py-5" style="min-height: 600px">


                <!-- Content Wrapper START -->
                <div class="main-content">

                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('alert') }}">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="row mx-3 mb-2">
                        <button class="btn btn-primary w-100 button_registrasi" data-status="false">REGISTRASI USER
                        </button>
                        <div class="card mt-3 mx-3 w-100 form_registrasi_user d-none">
                            <div class="card-header">
                                <h4 class="mt-2">FORMULIR</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('landing.registrasiUser') }}" method="POST" class="mt-3"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Nama</label>
                                            <input type="text" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                placeholder="Nama" required>
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="no_hp">No HP</label>
                                            <input type="number" name="no_hp"
                                                class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                                placeholder="08xxxx" required>
                                            @error('no_hp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">Jenis Pekerjaan</label>
                                        <input type="text" name="jenis_pekerjaan"
                                            class="form-control @error('jenis_pekerjaan') is-invalid @enderror"
                                            id="no_hp" placeholder="IT Consultant" required>
                                        @error('jenis_pekerjaan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Alamat</label>
                                        <textarea name="alamat"
                                            class="form-control @error('alamat') is-invalid @enderror" required
                                            id="alamat" cols="30" rows="10" placeholder="Jln. xxxx"></textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Upload Foto</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('foto') is-invalid @enderror"
                                                id="customFile" name="foto" required>
                                            @error('foto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="custom-file-label" for="customFile">Pilih Foto</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-3 mb-2">
                        <button class="btn btn-primary w-100 button_aktivasi" data-status="false">AKTIVASI USER
                        </button>
                        <div class="card mt-3 mx-3 w-100 form_aktivasi_user d-none">
                            <div class="card-header">
                                <h4 class="mt-2">FORMULIR</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('landing.aktivasiUser') }}" method="POST" class="mt-3">
                                    @csrf

                                    <div class="form-group">
                                        <label for="no_hp">Verifikasi Kode</label>
                                        <input type="text" name="verifikasi_kode"
                                            class="form-control @error('verifikasi_kode') is-invalid @enderror"
                                            id="no_hp" placeholder="xxxxx" required>
                                        @error('verifikasi_kode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Aktivasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-3 mb-2">
                        <button class="btn btn-primary w-100 button_cari" data-status="false">CARI USER
                        </button>
                        <div class="card mt-3 mx-3 w-100 form_cari_user d-none">
                            <div class="card-header">
                                <h4 class="mt-2">FORMULIR</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="no_hp">No User</label>
                                    <input type="text" name="no_user" class="form-control " id="no_user"
                                        placeholder="xxxxx" required>
                                </div>

                                <button type="submit" class="btn btn-primary cari">Cari</button>
                                <div id="result_cari">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->

            </div>
            <!-- Page Container END -->

            <!-- Footer START -->
            <footer class="footer " style="background: #3f87f5;">
                <div class="footer-content">
                    <div class="container">
                        <p class="text-white m-b-0">Copyright © 2019 Theme_Nate. All rights reserved.</p>
                        <span>
                            <a href="" class="text-white m-r-15">Term &amp; Conditions</a>
                            <a href="" class="text-white">Privacy &amp; Policy</a>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer END -->
            <!-- Search Start-->
            <div class="modal modal-left fade search" id="search-drawer">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between align-items-center">
                            <h5 class="modal-title">Search</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="anticon anticon-close"></i>
                            </button>
                        </div>
                        <div class="modal-body scrollable">
                            <div class="input-affix">
                                <i class="prefix-icon anticon anticon-search"></i>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <div class="m-t-30">
                                <h5 class="m-b-20">Files</h5>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-cyan avatar-icon">
                                        <i class="anticon anticon-file-excel"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);"
                                            class="text-dark m-b-0 font-weight-semibold">Quater
                                            Report.exl</a>
                                        <p class="m-b-0 text-muted font-size-13">by Finance</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-blue avatar-icon">
                                        <i class="anticon anticon-file-word"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);"
                                            class="text-dark m-b-0 font-weight-semibold">Documentaion.docx</a>
                                        <p class="m-b-0 text-muted font-size-13">by Developers</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-purple avatar-icon">
                                        <i class="anticon anticon-file-text"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);"
                                            class="text-dark m-b-0 font-weight-semibold">Recipe.txt</a>
                                        <p class="m-b-0 text-muted font-size-13">by The Chef</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-red avatar-icon">
                                        <i class="anticon anticon-file-pdf"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);"
                                            class="text-dark m-b-0 font-weight-semibold">Project
                                            Requirement.pdf</a>
                                        <p class="m-b-0 text-muted font-size-13">by Project Manager</p>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <h5 class="m-b-20">Members</h5>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-image">
                                        <img src="{{ url('') }}/assets/images/avatars/thumb-1.jpg" alt="">
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Erin
                                            Gonzales</a>
                                        <p class="m-b-0 text-muted font-size-13">UI/UX Designer</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-image">
                                        <img src="{{ url('') }}/assets/images/avatars/thumb-2.jpg" alt="">
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);"
                                            class="text-dark m-b-0 font-weight-semibold">Darryl
                                            Day</a>
                                        <p class="m-b-0 text-muted font-size-13">Software Engineer</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-image">
                                        <img src="{{ url('') }}/assets/images/avatars/thumb-3.jpg" alt="">
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);"
                                            class="text-dark m-b-0 font-weight-semibold">Marshall
                                            Nichols</a>
                                        <p class="m-b-0 text-muted font-size-13">Data Analyst</p>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <h5 class="m-b-20">News</h5>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-image">
                                        <img src="{{ url('') }}/assets/images/others/img-1.jpg" alt="">
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">5
                                            Best Handwriting Fonts</a>
                                        <p class="m-b-0 text-muted font-size-13">
                                            <i class="anticon anticon-clock-circle"></i>
                                            <span class="m-l-5">25 Nov 2018</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search End-->

            <!-- Quick View START -->
            <div class="modal modal-right fade quick-view" id="quick-view">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between align-items-center">
                            <h5 class="modal-title">Theme Config</h5>
                        </div>
                        <div class="modal-body scrollable">
                            <div class="m-b-30">
                                <h5 class="m-b-0">Header Color</h5>
                                <p>Config header background color</p>
                                <div class="theme-configurator d-flex m-t-10">
                                    <div class="radio">
                                        <input id="header-default" name="header-theme" type="radio" checked
                                            value="default">
                                        <label for="header-default"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-primary" name="header-theme" type="radio" value="primary">
                                        <label for="header-primary"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-success" name="header-theme" type="radio" value="success">
                                        <label for="header-success"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-secondary" name="header-theme" type="radio" value="secondary">
                                        <label for="header-secondary"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-danger" name="header-theme" type="radio" value="danger">
                                        <label for="header-danger"></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="m-b-0">Side Nav Dark</h5>
                                <p>Change Side Nav to dark</p>
                                <div class="switch d-inline">
                                    <input type="checkbox" name="side-nav-theme-toogle" id="side-nav-theme-toogle">
                                    <label for="side-nav-theme-toogle"></label>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="m-b-0">Folded Menu</h5>
                                <p>Toggle Folded Menu</p>
                                <div class="switch d-inline">
                                    <input type="checkbox" name="side-nav-fold-toogle" id="side-nav-fold-toogle">
                                    <label for="side-nav-fold-toogle"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick View END -->
        </div>
    </div>


    @include('layouts.footer')
    <script type="text/javascript">
        $('.button_registrasi').on('click', function() {
            $('.form_aktivasi_user').addClass('d-none')
            $('.form_aktivasi_user').attr('data-status', 'false')
            $('.form_cari_user').addClass('d-none')
            $('.form_cari_user').attr('data-status', 'false')

            if ($(this).attr('data-status') === 'false') {
                $('.form_registrasi_user').removeClass('d-none')
                $(this).attr('data-status', 'true')
            } else {
                $('.form_registrasi_user').addClass('d-none')
                $(this).attr('data-status', 'false')
            }
        })
        $('.button_aktivasi').on('click', function() {
            $('.form_registrasi_user').addClass('d-none')
            $('.form_registrasi_user').attr('data-status', 'false')
            $('.form_cari_user').addClass('d-none')
            $('.form_cari_user').attr('data-status', 'false')

            if ($(this).attr('data-status') === 'false') {
                $('.form_aktivasi_user').removeClass('d-none')
                $(this).attr('data-status', 'true')
            } else {
                $('.form_aktivasi_user').addClass('d-none')
                $(this).attr('data-status', 'false')
            }
        })
        $('.button_cari').on('click', function() {
            $('.form_registrasi_user').addClass('d-none')
            $('.form_registrasi_user').attr('data-status', 'false')
            $('.form_aktivasi_user').addClass('d-none')
            $('.form_aktivasi_user').attr('data-status', 'false')

            if ($(this).attr('data-status') === 'false') {
                $('.form_cari_user').removeClass('d-none')
                $(this).attr('data-status', 'true')
            } else {
                $('.form_cari_user').addClass('d-none')
                $(this).attr('data-status', 'false')
            }
        })

        $('.cari').on('click', function() {
            $('#result_cari').html(
                `
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    style="margin:auto;background:#fff;display:block;" width="100px" height="100px"
                    viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <path fill="none" stroke="#3f87f5" stroke-width="8"
                        stroke-dasharray="42.76482137044271 42.76482137044271"
                        d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z"
                        stroke-linecap="round"
                        style="transform:scale(0.8);transform-origin:50px 50px">
                        <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1s"
                            keyTimes="0;1" values="0;256.58892822265625"></animate>
                    </path>
                </svg>
                `
            )

            var no_user = $('#no_user').val()

            $.ajax({
                url: "{{ route('landing.cariUser') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    no_user: no_user,
                }
            }).then((resp) => {
                if (resp.status == 200) {
                    var user = resp.user
                    $('#result_cari').html(
                        `
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <div class="d-md-flex align-items-center">
                                        <div class="text-center text-sm-left ">
                                            <div class="avatar avatar-image"
                                                style="width: 150px; height:150px">
                                                <img src="{{ asset('foto') }}/${user.foto}" alt="">
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-left m-v-15 p-l-30">
                                            <h2 class="m-b-5">${user.nama}</h2>
                                            <p class="text-dark m-b-20">${user.jenis_pekerjaan}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="d-md-block d-none border-left col-1"></div>
                                        <div class="col">
                                            <ul class="list-unstyled m-t-10">
                                                <li class="row">
                                                    <p
                                                        class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                        <i
                                                            class="m-r-10 text-primary anticon anticon-mail"></i>
                                                        <span>No User: </span>
                                                    </p>
                                                    <p class="col font-weight-semibold">
                                                        ${user.no_user}</p>
                                                </li>
                                                <li class="row">
                                                    <p
                                                        class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                        <i
                                                            class="m-r-10 text-primary anticon anticon-phone"></i>
                                                        <span>No HP: </span>
                                                    </p>
                                                    <p class="col font-weight-semibold"> ${user.no_hp}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <p
                                                        class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                                        <i
                                                            class="m-r-10 text-primary anticon anticon-compass"></i>
                                                        <span>Alamat: </span>
                                                    </p>
                                                    <p class="col font-weight-semibold"> ${user.alamat}
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                    )
                } else {
                    $('#result_cari').html(
                        `
                        <div class="alert alert-danger mt-3">
                            ${resp.message}
                        </div>
                        `
                    )
                }
            }).catch((err) => {

            })
        })

    </script>

</body>

</html>
