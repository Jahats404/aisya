
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AISYA - Arsip Masyarakat </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="https://aisya.cilacapkab.go.id/" class="brand-logo">
                {{-- <img class="logo-abbr" src="{{ asset('images/faviconb.png') }}" alt=""> --}}
                <img class="logo-compact" src="{{ asset('images/favicon.png') }}" alt="">
                <img class="brand-title" src="{{ asset('images/favicon.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                @include('layout.navbar')
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layout.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Selamat Datang {{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Daftar Masyarakat</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                
                                <h4 class="card-title">Daftar Masyarakat</h4>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-dark table-responsive-sm display" id="example" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Kecamatan</th>
                                                <th>Desa</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($masyarakat as $a)
                                                <tr>
                                                    <td> {{ $a->name }} </td>
                                                    <td> {{ $a->kecamatan }} </td>
                                                    <td> {{ $a->desa }} </td>
                                                    <td class="d-flex justify-content-center">
                                                        {{-- <button type="button" style="width: 61px; margin-right: 2%" data-toggle="modal" data-target="#editModal{{ $a->id_arkep }}" class="btn btn-rounded btn-info btn-xs">Edit</button> --}}
                                                        <form action="{{ route('a.delete-masyarakat', ['id' => $a->id]) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <button type="submit" style="width: 61px" class="btn btn-rounded btn-danger btn-xs show_delete">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach ($masyarakat as $a)
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="editModal{{ $a->id_arkep }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $a->id_arkep }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel{{ $a->id_arkep }}">Edit Arsip</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label>Kategori</label>
                                                                        <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                                                            <option @if ($a->kategori == 'Kartu Keluarga') selected @endif value="Kartu Keluarga">Kartu Keluarga</option>
                                                                            <option @if ($a->kategori == 'Akte Kelahiran') selected @endif value="Akte Kelahiran">Akte Kelahiran</option>
                                                                            <option @if ($a->kategori == 'Lain - Lain') selected @endif value="Lain - Lain">Lain - Lain</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Deskripsi:</label>
                                                                        <textarea name="deskripsi_arkep" placeholder="Isi Deskripsi" class="form-control">{{ $a->deskripsi_arkep }}</textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://aisya.cilacapkab.go.id/">AIYSA</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
<script>
    $('.show_delete').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Apakah Anda ingin menghapus Data ini`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
  </script>
  <script>
    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Apakah Anda Ingin mengubah Password?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
  </script>

</html>