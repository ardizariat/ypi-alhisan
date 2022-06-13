<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3 class="mt-xl-5 pt-xl-3">
                        <a class="text-decoration-none text-white" href="{{ route('auth.login') }}">YPI Alhisan</a>
                    </h3>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <ul>
                        @foreach ($footer['1'] as $name => $url)
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ $url }}">{{ $name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <ul>
                        @foreach ($footer['2'] as $name => $url)
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ $url }}">{{ $name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Kontak</h4>
                    <p>
                        Jl. Harapan Baru Timur Blok Ga 1 No.82,<br>
                        RT.003/RW.007, Kota Baru, <br>
                        Bekasi Barat, Kota Bekasi,<br>
                        Jawa Barat 17133<br>
                    </p>
                    <p>
                        <strong>Phone:</strong> +1 5589 55488 55<br>
                        <strong>Email:</strong> info@example.com<br>
                    </p>
                    {{-- <form action="" method="post" class="d-flex">
                        <input type="email" class="form-control" name="email">
                        <button type="submit" class="btn btn-outline-success">Subscribe</button>
                    </form> --}}
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Alhisan</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/company-free-html-bootstrap-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="telegram"><i class="bx bxl-telegram"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="youtube"><i class="bx bxl-youtube"></i></a>
        </div>
    </div>
</footer>
