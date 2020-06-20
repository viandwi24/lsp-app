<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style>
            .carousel-inner>.carousel-item {
                max-height: 50vh;
                height: 50vh;
                background: black;
            }
            .carousel-inner>.carousel-item>img {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                opacity: .8;
                width: 100%;
            }
        </style>
        <title>{{ env('APP_NAME', 'Laravel') }}</title>
    </head>
    <body>
        <nav class="navbar navbar-expand navbar-light bg-light shadow">
            <div class="container">
                <a class="navbar-brand" href="#">{{ env('APP_NAME', 'Laravel') }} - SMKN 1 MOJOKERTO</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row justify-content-center mt-4 mb-4">
            <div class="col-8">
                <div class="container">
                    <video id="lspvideo" class="mb-2" style="width: 100%;height: auto;">
                        <source src="{{ asset('assets/lsp.mp4') }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>

                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 1; $i < 6; $i++)
                                <div class="carousel-item {{ ($i == 1) ? 'active' : '' }}">
                                    <img src="{{ asset('assets/images/slides/' . $i . '.jpg') }}" class="d-block w-100" alt="Photo">
                                </div>
                            @endfor
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">Tentang</div>

                        <div class="card-body">
                            <p>
                                Lembaga Sertifikasi Profesi (LSP) SMKN 1 Mojokerto adalah 
                                lembaga pendukung BNSP yang bertanggung jawab 
                                melaksanakan sertifikasi kompetensi profesi. 
                                LSP SMKN 1 Mojokerto didirikan oleh SMKN 1 Mojokerto 
                                melalui SK Dewan Pengarah.
                            </p>
                            <p>
                                LSP SMKN 1 Mojokerto bertujuan untuk melakukan sertifikasi 
                                sumber daya manusia pada sektor DIPB, TKRO, TSM, MM, dan TKJ.
                                Pendirian LSP SMKN 1 Mojokerto mendapatkan dukungan dari asosiasi 
                                profesi dan para profesional bidang Administrasi Perkantoran, 
                                Akuntansi, Jasa Boga,Tata Busana dan Teknik Komputer Dan Jaringan 
                                antara lain: Asosiasi Sekretaris, Asosiasi Akuntansi, Asosiasi 
                                Jasa Makanan, Asosiasoi Pengusaha Butik/konveksi dan Asosiasi IT
                            </p>
                            <p>
                                LSP SMKN 1 Mojokerto bertugas mengembangkan standar kompetensi, 
                                melaksanakan uji kompetensi, menerbitkan sertifikat kompetensi 
                                serta melakukan sertifikasi tempat uji kompetensi.
                            </p>
                            <p>
                                Dalam melaksanakan tugas dan fungsi, LSP SMKN 1 Mojokerto mengacu 
                                kepada Pedoman yang dikeluarkan BNSP. Dalam pedoman tersebut 
                                ditetapkan persyaratan yang harus ditaati untuk menjamin agar 
                                lembaga sertifikasi menjalankan prosedur sertifikasi kepada pihak
                                ketiga secara konsisten dan profesional, sehingga dapat diterima 
                                di tingkat nasional yang relevan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>
            $(document).ready(() => {
                Swal.fire('Welcome to <br>LSP SMKN 1 Mojokerto.').then((result) => {
                    if (result.value) {
                        document.getElementById('lspvideo').play();
                        document.getElementById('lspvideo').loop = true;
                    }
                });
            })
        </script>
    </body>
</html>