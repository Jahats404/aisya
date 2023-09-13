
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
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
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" aria-placeholder="AISYA" src="{{ asset('images/favicon.png') }}" alt="">
                <img class="logo-compact" aria-placeholder="AISYA" src="{{ asset('images/favicon.png') }}" alt="">
                <img class="brand-title" src="./images/logo-text.png" alt="">
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Arsip</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Arsip</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-4 col-xxl-4">
                        <div class="card">
                            <div class="card-header">
                                
                                <h4 class="card-title">Arsip Pendidikan</h4>
                            </div>
                            <div class="card-body">
                                {{-- @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('fail'))
                                    <div class="alert alert-danger">
                                        {{ session('fail') }}
                                    </div>
                                @endif --}}
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                <div class="basic-form text-dark">
                                    <form action="{{ route('m.arpen-store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Upload file</label>
                                            <input type="file" name="image" class="form-control" placeholder="Pilih File">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jenjang Pendidikan</label>
                                            <select name="kategori" class="form-control">
                                                {{-- @foreach ($kategori as $k)
                                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                                @endforeach --}}
                                                <option value="ijazah">SD</option>
                                                <option value="raport">SMP</option>
                                                <option value="lain-lain">SMA</option>
                                                <option value="lain-lain">Perguruan Tinggi</option>
                                            </select>
                                            {{-- @error('kategori')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror --}}
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="kategori" class="form-control">
                                                {{-- @foreach ($kategori as $k)
                                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                                @endforeach --}}
                                                <option value="ijazah">Ijazah</option>
                                                <option value="raport">Raport</option>
                                                <option value="lain-lain">Lain - Lain</option>
                                            </select>
                                            @error('kategori')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_arpen" rows="4" id="comment"></textarea>
                                            @error('deskripsi_arpen')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8 col-xxl-8">
                        <div class="card">
                            <div class="card-header">
                                
                                <h4 class="card-title">Arsip Pendidikan</h4>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-dark table-responsive-sm display" id="example" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Tanggal Upload</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arpen as $a)
                                                <tr>
                                                    <td> {{ $a->kategori }} </td>
                                                    <td> {{ $a->users->name }} </td>
                                                    <td> {{ $a->deskripsi_arpen }} </td>
                                                    <td>{{ $a->created_at->format('l, d-m-Y') }}</td>
                                                    <td class="d-flex justify-content-center">
                                                        {{-- <button type="button" style="width: 70px; margin-right: 4%" data-toggle="modal" data-target="#gambarModal{{ $a->id_arpen }}" class="btn btn-rounded btn-primary">Lihat</button> --}}
                                                        <a href="{{ $a->url }}" target="_blank" class="btn"><i class="ti-layout-media-center-alt"></i></a>
                                                        {{-- <button type="button" style="width: 70px; margin-right: 4%" data-toggle="modal" data-target="#editModal{{ $a->id_arpen }}" class=""><i class="ti-pencil"></i></button> --}}
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#editModal{{ $a->id_arpen }}" data-bs-toggle="button"><i class="ti-pencil"></i></button>
                                                        <form action="{{ route('m.delete-arpen', ['id_arpen' => $a->id_arpen]) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            {{-- <button type="submit" style="width: 70px" class="ti-trash show_delete">Hapus</button> --}}
                                                            <button type="button" class="btn show_delete" data-bs-toggle="button"><i class="ti-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="gambarModal{{ $a->id_arpen }}" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel{{ $a->id_arpen }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="gambarModalLabel{{ $a->id }}">Gambar</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="{{ $a->url }}" alt="Gambar" class="img-fluid">
                                                                <a href="{{ $a->url }}" class="btn btn-primary" download>Download</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($arpen as $a)
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="editModal{{ $a->id_arpen }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $a->id_arpen }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel{{ $a->id_arpen }}">Edit Arsip</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('m.update-arpen', ['id_arpen' => $a->id_arpen]) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group">
                                                                        <label>Nama:</label>
                                                                        <input type="text" name="nama_arpen" class="form-control" value="{{ $a->nama_arpen }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Deskripsi:</label>
                                                                        <textarea name="deskripsi_arpen" class="form-control">{{ $a->deskripsi_arpen }}</textarea>
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
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
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
            title: `Apakah Anda Ingin Menghapus Data Ini`,
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