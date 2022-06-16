<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Artikel Terbaru</h2>
        </div>
        <div class="row d-flex">
            @foreach ($data as $item)
                <div class="col-lg-4 col-md-12 col-sm-12 entries">
                    <x-article-frontend-component>
                        <x-slot name="urlImage">{{ asset('storage/artikel/' . $item->thumbnail) }}</x-slot>
                        <x-slot name="judul">{!! Str::limit($item->judul, 30, '.') !!}</x-slot>
                        <x-slot name="tanggal">
                            <li class="d-flex align-items-center">
                                <i class="bi bi-clock"></i>
                                <a href="{{ route('artikel-detail', $item->slug) }}">{!! tanggal($item->dipublikasi) !!}</a>
                            </li>
                        </x-slot>
                        <x-slot name="konten">
                            {!! Str::limit($item->konten, 50, '.') !!}
                        </x-slot>
                        <x-slot name="urlDetail">{{ route('artikel-detail', $item->slug) }}</x-slot>
                    </x-article-frontend-component>
                </div>
            @endforeach
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 col-md-6 col-sm-8">
                <a class="btn-link text-center btn text-decoration-none" href="">Baca Artikel </a>
            </div>
        </div>
    </div>
</section>
