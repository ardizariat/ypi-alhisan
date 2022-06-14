<article class="entry" id="artikel">

    <div class="entry-img">
        <img src="{{ $urlImage ?? '' }}" alt="blog-image" class="img-artikel img-fluid">
    </div>

    <h2 class="entry-title">
        <a href="{{ $urlDetail }}" class="text-capitalize">{{ $judul }}</a>
    </h2>

    <div class="entry-meta">
        <ul>
            {{ $penulis ?? '' }}
            {{ $tanggal ?? '' }}
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
