<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/"><span>YPI</span>Alhisan</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="application/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                @foreach ($navbar as $name => $url)
                    @if ($name == 'tentang kami')
                        <li class="dropdown"><a href="#"><span>tentang kami</span> <i
                                    class="bi bi-chevron-down"></i></a>
                            <ul>
                                @foreach ($url as $subName => $subUrl)
                                    <li><a href="{{ $subUrl }}">{{ $subName }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif ($name == 'dakwah')
                        <li class="dropdown"><a href="#"><span>Dakwah</span> <i
                                    class="bi bi-chevron-down"></i></a>
                            <ul>
                                @foreach ($url as $subName => $subUrl)
                                    <li><a href="{{ $subUrl }}">{{ $subName }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ $url }}"
                                class="{{ activeClassFrontend($url) }}">{{ $name }}</a>
                        </li>
                    @endif
                @endforeach

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
