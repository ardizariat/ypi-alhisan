<article class="entry">

    <div class="entry-img">
        <img src="application/img/blog/blog-1.jpg" alt="blog-image" class="img-fluid">
    </div>

    <h2 class="entry-title">
        <a href="{{ $urlDetail }}" class="text-capitalize">{{ $judul }}</a>
    </h2>

    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                    href="{{ $urlDetail }}">{{ $penulis }}</a>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ $urlDetail }}"><time
                        datetime="2020-01-01">{{ $tanggal }}</time></a>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ $urlDetail }}">12
                    Comments</a></li>
        </ul>
    </div>

    <div class="entry-content">
        <p>
            {{ $konten }}
        </p>
        <div class="read-more">
            <a href="{{ $urlDetail }}">Baca selengkapnya</a>
        </div>
    </div>

</article>
