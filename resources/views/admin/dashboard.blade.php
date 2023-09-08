<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('maps/style.css') }}">



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
                <img class="logo-abbr" src="./images/logo.png" alt="">
                <img class="logo-compact" src="./images/logo-text.png" alt="">
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
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back {{ Auth::user()->name }}</h4>
                            <span class="ml-1">Element</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Arsip Kependudukan </div>
                                    <div class="stat-digit"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success w-" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Arsip Pendidikan</div>
                                    <div class="stat-digit"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary w-" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Arsip Kesehatan</div>
                                    <div class="stat-digit"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning w-" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Arsip Pribadi</div>
                                    <div class="stat-digit"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger w-" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <div class="row">
                    <form action="{{ route('kode.wilayah') }}" method="post">
                        @csrf <!-- Tambahkan token CSRF untuk perlindungan -->
                    
                        <!-- Input tersembunyi untuk kodeWilayah -->
                        <input type="hidden" name="kodeWilayah" value="" id="hiddenKodeWilayah">
                    
                        <!-- Tombol untuk mengirimkan formulir -->
                        <button type="submit" hidden>Kirim</button>
                    </form>
                    
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Chart Kecamatan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-8">
                                        <canvas id="chartKecamatan" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Peta Kecamatan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-8">
                                        @include('admin.layoutmap')
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
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
                <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p> 
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


    <!-- Vectormap -->
    <script src="{{ asset('vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>


    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

</body>
<script>
    var ctx = document.getElementById('chartKecamatan').getContext('2d');

    // Data nama wilayah dari variabel $kecamatan
    var kecamatanData = @json($namaKecamatan->pluck('nama'));
    var kecamatanKode = @json($kodeKecamatan->pluck('kode'));
    var kecamatanCount = @json($totalKecamatan->pluck('total'));
    

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: kecamatanData,
            datasets: [{
                label: 'Diagram Kecamatan',
                data: kecamatanCount,
                backgroundColor: ['rgba(100, 73, 237, 0.5)','rgba(100, 73, 237, 0.75)','rgba(100, 73, 237, 1.0)','rgba(0, 0, 139, 0.75)','rgba(0, 0, 139, 1.0)','rgba(222, 235, 135, 0.75)','rgba(222, 235, 135, 1.0)','rgba(255, 247, 80, 0.75)','rgba(255, 247, 80, 1.0)','rgba(220, 193, 60, 0.75)','rgba(220, 193, 60, 1.0)','rgba(95, 249, 160, 0.5)','rgba(95, 249, 160, 0.75)','rgba(95, 249, 160, 1.0)','rgba(127, 255, 0, 0.5)','rgba(127, 255, 0, 0.75)','rgba(127, 255, 0, 1.0)','rgba(119, 120, 153, 0.5)','rgba(119, 120, 153, 0.75)','rgba(119, 120, 153, 1.0)','rgba(176, 12, 222, 0.5)','rgba(176, 12, 222, 0.75)','rgba(176, 12, 222, 1.0)','rgba(144, 14, 144, 0.75)','rgba(144, 14, 144, 1.0)'],
                borderColor: ['rgba(100, 73, 237, 0.5)','rgba(100, 73, 237, 0.75)','rgba(100, 73, 237, 1.0)','rgba(0, 0, 139, 0.75)','rgba(0, 0, 139, 1.0)','rgba(222, 235, 135, 0.75)','rgba(222, 235, 135, 1.0)','rgba(255, 247, 80, 0.75)','rgba(255, 247, 80, 1.0)','rgba(220, 193, 60, 0.75)','rgba(220, 193, 60, 1.0)','rgba(95, 249, 160, 0.5)','rgba(95, 249, 160, 0.75)','rgba(95, 249, 160, 1.0)','rgba(127, 255, 0, 0.5)','rgba(127, 255, 0, 0.75)','rgba(127, 255, 0, 1.0)','rgba(119, 120, 153, 0.5)','rgba(119, 120, 153, 0.75)','rgba(119, 120, 153, 1.0)','rgba(176, 12, 222, 0.5)','rgba(176, 12, 222, 0.75)','rgba(176, 12, 222, 1.0)','rgba(144, 14, 144, 0.75)','rgba(144, 14, 144, 1.0)'],
                borderWidth: 1
            }]
        },
        options: {
            onClick: function(event, elements) {
            if (elements.length > 0) {
                // Ambil data dari elemen yang diklik
                var data = elements[0]._chart.data;
                var datasetIndex = elements[0]._datasetIndex;
                var index = elements[0]._index;

                // Dapatkan nilai dari bar yang diklik
                var value = data.datasets[datasetIndex].data[index];
                var kodeWilayah = kecamatanKode[index];

                 // Isi nilai kodeWilayah ke input tersembunyi
                document.getElementById('hiddenKodeWilayah').value = kodeWilayah;

                // Submit formulir
                document.querySelector('form').submit();
                
            }
        }
            
        }
    });
</script>
</html>