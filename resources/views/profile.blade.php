
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AISYA - Arsip Masyarakat </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
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
                {{-- <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back {{ Auth()->user()->name }}</h4>
                            <p class="mb-0">Your business dashboard template</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                        </ol>
                    </div>
                </div> --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile">
                            <div class="profile-head">
                                {{-- <div class="photo-content">
                                    <div class="cover-photo">
                                        <img src="{{ asset('images/profile/8.jpg') }}" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <div class="profile-photo">
                                        <img src="{{ asset('images/profile/6.jpg') }}" class="img-fluid rounded" alt="">
                                    </div>
                                </div> --}}
                                {{-- <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('images/profile/6.jpg') }}" alt="user-avatar" class="d-block rounded mr-3 mb-3" height="100" width="100" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload Foto</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="foto_profile" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                            </form>
                                        </label>
                                        <p class="text-muted mb-0">JPG, GIF or PNG. Ukuran Max 2MB</p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-personal-info">
                                    <br>
                                    <h4 class="text-primary mb-4">Informasi Pribadi</h4>
                                    <div class="row mb-4">
                                        <div class="col-5">
                                            @if (Auth()->user()->url)
                                                <img src="{{ Auth()->user()->url }}" alt="user-avatar" class="d-block mr-3 rounded-circle mb-3" height="150" width="150" id="uploadedAvatar" />
                                            @else
                                            <img src="{{ asset('images/svg/profile.svg') }}" alt="user-avatar" class="d-block mr-3 rounded-circle mb-3" height="150" width="150" id="uploadedAvatar" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-5">
                                            <h5 class="f-w-500">Nama <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-7"><span>{{ Auth()->user()->name }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-5">
                                            <h5 class="f-w-500">Tanggal Lahir <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-7"><span>{{ $user->tanggal_lahir }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-5">
                                            <h5 class="f-w-500">NO HP <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-7"><span>{{ $user->no_hp }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-5">
                                            <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-7"><span>{{ Auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-5">
                                            <h5 class="f-w-500">No KK <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-7"><span>{{ Auth()->user()->kk }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-5">
                                            <h5 class="f-w-500">No NIK <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-7 "><span>{{ Auth()->user()->nik }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <h4 class="text-primary mt-4">Pengaturan Akun</h4>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link active show">Akun</a>
                                            </li>
                                            <li class="nav-item"><a href="#change-pw" data-toggle="tab" class="nav-link">Password</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="profile-settings" class="tab-pane fade active show">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Upload foto Profile</h4>
                                                        <form action="{{ route('m.update-fotodir') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <input type="file" name="image" class="form-control" placeholder="Pilih File">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <button type="submit" class="btn btn-sm btn-rounded btn-primary"><span
                                                                        class="btn-icon-left text-primary"><i class="fa fa-upload color-success"></i>
                                                                    </span>Unggah</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <h4 class="text-primary">Upload foto Profile</h4>
                                                        <form id="camera-upload-form" action="{{ route('m.update-foto') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <button type="button" id="start-camera" data-target="#cameraModal" data-toggle="modal" class="btn btn-sm btn-rounded btn-primary">
                                                                        <span class="btn-icon-left text-primary"><i class="fa fa-camera color-success"></i></span>Gunakan Kamera
                                                                    </button>
                                                                    <button type="button" id="take-photo" class="btn btn-sm btn-rounded btn-primary" style="display: none;">
                                                                        <span class="btn-icon-left text-primary"><i class="fa fa-camera color-success"></i></span>Ambil Foto
                                                                    </button>
                                                                    <input type="hidden" name="photo" id="photo" value="">
                                                                    <button type="submit" id="upload-photo" class="btn btn-sm btn-rounded btn-primary" style="display: none;">
                                                                        <span class="btn-icon-left text-primary"><i class="fa fa-upload color-success"></i></span>Unggah
                                                                    </button>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <video id="camera-stream" width="100%" height="100%"></video>
                                                                </div>
                                                                
                                                            </div>
                                                        </form>
                                                        <!-- Modal untuk menampilkan kamera -->
                                                        {{-- <div class="modal fade" id="cameraModal" tabindex="-1" role="dialog" aria-labelledby="cameraModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="cameraModalLabel">Kamera Pengguna</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <video id="camera-stream" width="100%" height="100%"></video>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" id="start-camera" data-target="#cameraModal" data-toggle="modal" class="btn btn-sm btn-rounded btn-primary">
                                                                            <span class="btn-icon-left text-primary"><i class="fa fa-camera color-success"></i></span>Mulai Kamera
                                                                        </button>
                                                                        <button type="button" id="take-photo" class="btn btn-sm btn-rounded btn-primary" style="display: none;">
                                                                            <span class="btn-icon-left text-primary"><i class="fa fa-camera color-success"></i></span>Ambil Foto
                                                                        </button>
                                                                        <input type="hidden" name="photo" id="photo" value="">
                                                                        <button type="submit" id="upload-photo" class="btn btn-sm btn-rounded btn-primary" style="display: none;">
                                                                            <span class="btn-icon-left text-primary"><i class="fa fa-upload color-success"></i></span>Unggah
                                                                        </button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                        <button type="button" class="btn btn-primary" id="take-photo">Ambil Foto</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                        <!-- Hidden input to store the base64 data of the taken photo -->
                                                        

                                                        <hr>
                                                        <h4 class="text-primary">Edit Data</h4>
                                                        <form action="{{ route('m.update-profile') }}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Nama</label>
                                                                    <input type="text" name="name" placeholder="Nama" class="form-control" value="{{ $user->name }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Email</label>
                                                                    <input type="email" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>NIK</label>
                                                                    <input type="number" name="nik" disabled placeholder="NIK" class="form-control" value="{{ $user->nik }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>KK</label>
                                                                    <input type="number" name="kk" disabled placeholder="KK" class="form-control" value="{{ $user->kk }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Tanggal Lahir</label>
                                                                    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control" value="{{ $user->tanggal_lahir }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>No HP</label>
                                                                    <input type="number" name="no_hp" placeholder="NO Hp" class="form-control" value="{{ $user->no_hp }}">
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-primary edit_confirm" type="submit">Ubah Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="change-pw" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Ganti Password</h4>
                                                        <form action="{{ route('m.update-password') }}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label>Password Lama</label>
                                                                        <input type="password" name="current_password" id="password" placeholder="Password" class="form-control">
                                                                        <input type="checkbox" id="showPassword" onchange="togglePasswordVisibility()">
                                                                        <label for="showPassword">Lihat Password</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label>Password Baru</label>
                                                                        <input type="password" name="new_password" id="password2" placeholder="Password Baru" class="form-control">
                                                                        <input type="checkbox" id="showPassword2" onchange="togglePasswordVisibility2()">
                                                                        <label for="showPassword2">Lihat Password</label>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Konfimasi Password</label>
                                                                        <input type="password" name="konfirmasi_password" id="password3" placeholder="Konfimasi Password" class="form-control">
                                                                        <input type="checkbox" id="showPassword3" onchange="togglePasswordVisibility3()">
                                                                        <label for="showPassword3">Lihat Password</label>
                                                                    </div>
                                                                </div>
                                                            <button class="btn btn-primary show_confirm" type="submit">Ubah Password</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
<script>
    $('.edit_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Apakah Anda Ingin Mengubah Data?`,
            icon: "info",
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
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var showPasswordCheckbox = document.getElementById('showPassword');
    
            if (showPasswordCheckbox.checked) {
                passwordInput.setAttribute("type", "text");
            } else {
                passwordInput.setAttribute("type", "password");
            }
        }
    </script>
    <script>
        function togglePasswordVisibility2() {
            var passwordInput = document.getElementById('password2');
            var showPasswordCheckbox = document.getElementById('showPassword2');
    
            if (showPasswordCheckbox.checked) {
                passwordInput.setAttribute("type", "text");
            } else {
                passwordInput.setAttribute("type", "password");
            }
        }
    </script>
    <script>
        function togglePasswordVisibility3() {
            var passwordInput = document.getElementById('password3');
            var showPasswordCheckbox = document.getElementById('showPassword3');
    
            if (showPasswordCheckbox.checked) {
                passwordInput.setAttribute("type", "text");
            } else {
                passwordInput.setAttribute("type", "password");
            }
        }
    </script>

<script>
    // Fungsi untuk mengambil akses kamera pengguna
    function startCamera() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                var video = document.getElementById('camera-stream');
                video.srcObject = stream;
                video.play();
                document.getElementById('start-camera').style.display = 'none';
                document.getElementById('take-photo').style.display = 'block';
            })
            .catch(function (err) {
                console.error('Error accessing the camera: ', err);
            });
    }

    // Fungsi untuk mengambil foto dari kamera
    function takePhoto() {
        var video = document.getElementById('camera-stream');
        var canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        var context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Simpan gambar sebagai base64 di hidden input
        document.getElementById('photo').value = canvas.toDataURL('image/jpeg');

        // Tampilkan gambar yang diambil (opsional)
        var takenPhoto = document.createElement('img');
        takenPhoto.src = canvas.toDataURL('image/jpeg');
        takenPhoto.width = 320;
        takenPhoto.height = 240;
        document.getElementById('camera-upload-form').appendChild(takenPhoto);

        document.getElementById('take-photo').style.display = 'none';
        document.getElementById('upload-photo').style.display = 'block';
    }

    document.getElementById('start-camera').addEventListener('click', startCamera);
    document.getElementById('take-photo').addEventListener('click', takePhoto);
</script>

    

</html>