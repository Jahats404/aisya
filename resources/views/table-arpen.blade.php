
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AISYA - Arsip Masyarakat </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('landing/images/aisya_new.2.3.4.png') }}">
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
        
            @include('layout.navbar-logo')

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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Daftar Arsip</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Arsip Pendidikan</a></li>
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
                                <div class="basic-form text-dark">
                                    <form action="{{ route('m.arpen-store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="text-danger">Upload file | jpeg,png,jpg,pdf | max:2MB</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Pilih File">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message == 'The image failed to upload.' ? 'Ukuran maksimal 2MB' : $message ; }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jenjang Pendidikan</label>
                                            <select name="jenjang" class="form-control @error('jenjang') is-invalid @enderror">
                                                <option value="">-- Pilih Jenjang Pendidikan --</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                                            </select>
                                            @error('jenjang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="ijazah">Ijazah</option>
                                                <option value="raport">Raport</option>
                                                <option value="lain-lain">Lain - Lain</option>
                                            </select>
                                            @error('kategori')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_arpen" placeholder="Isi Deskripsi (Optional)" rows="4" id="comment"></textarea>
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-dark table-responsive-sm display" id="example" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Jenjang</th>
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
                                                    <td> {{ $a->jenjang }} </td>
                                                    <td> {{ $a->users->name }} </td>
                                                    <td class="text-center">
                                                        @if ($a->deskripsi_arpen == NULL)
                                                            -
                                                        @else
                                                        {{ $a->deskripsi_arpen }}                                                         
                                                        @endif
                                                    </td>
                                                    <td>{{ $a->created_at->format('l, d-m-Y') }}</td>
                                                    <td class="d-flex justify-content-center">
                                                        {{-- <a href="{{ $a->url }}" target="_blank" class="btn"><i class="ti-layout-media-center-alt"></i></a> --}}
                                                        <a href="{{ $a->url }}" target="_blank" style="width: 61px; margin-right: 2%" class="btn btn-rounded btn-primary btn-xs">Lihat</a>
                                                        {{-- <button type="button" class="btn" data-toggle="modal" data-target="#editModal{{ $a->id_arpen }}" data-bs-toggle="button"><i class="ti-pencil"></i></button> --}}
                                                        <button type="button" style="width: 61px; margin-right: 2%" data-toggle="modal" data-target="#editModal{{ $a->id_arpen }}" class="btn btn-rounded btn-info btn-xs">Edit</button>
                                                        <form action="{{ route('m.delete-arpen', ['id_arpen' => $a->id_arpen]) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            {{-- <button type="button" class="btn show_delete" data-bs-toggle="button"><i class="ti-trash"></i></button> --}}
                                                            <button type="submit" style="width: 61px" class="btn btn-rounded btn-danger btn-xs show_delete">Hapus</button>
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
                                                                        <label>Jenjang Pendidikan</label>
                                                                        <select name="jenjang" class="form-control @error('jenjang') is-invalid @enderror">
                                                                            <option @if ($a->jenjang == 'SD') selected @endif value="SD">SD</option>
                                                                            <option @if ($a->jenjang == 'SMP') selected @endif value="SMP">SMP</option>
                                                                            <option @if ($a->jenjang == 'SMA') selected @endif value="SMA">SMA</option>
                                                                            <option @if ($a->jenjang == 'Perguruan Tinggi') selected @endif value="Perguruan Tinggi">Perguruan Tinggi</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Kategori</label>
                                                                        <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                                                            <option @if ($a->kategori == 'ijazah') selected @endif value="ijazah">Ijazah</option>
                                                                            <option @if ($a->kategori == 'raport') selected @endif value="raport">Raport</option>
                                                                            <option value="lain-lain">Lain - Lain</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Deskripsi:</label>
                                                                        <textarea name="deskripsi_arpen" placeholder="Isi Deskripsi (Optional)" class="form-control">{{ $a->deskripsi_arpen }}</textarea>
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