<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $currentPage }}</h2>
            <ol>
                <li><a href="{{ route('beranda') }}">Beranda</a></li>
                <li>{{ $currentPage }}</li>
            </ol>
        </div>
    </div>
</section>
