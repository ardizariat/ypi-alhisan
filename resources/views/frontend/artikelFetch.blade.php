@forelse ($data['artikel'] as $item)
    <x-article-frontend-component>
        <x-slot name="urlImage">{{ asset('storage/artikel/' . $item->thumbnail) }}</x-slot>
        <x-slot name="judul">{!! Str::limit($item->judul, 30, '.') !!}</x-slot>
        <x-slot name="penulis">
            <li class="d-flex align-items-center">
                <i class="bi bi-person"></i>
                <a href="{{ route('artikel-detail', $item->slug) }}">{{ $item->penulis }}</a>
            </li>
        </x-slot>
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
    <input type="hidden" name="page" value="1" id="page-artikel" />

@empty
    <h4>Data tidak ada</h4>
@endforelse

@if ($data['artikel']->hasPages())
    {{ $data['artikel']->links('components.pagination-article') }}
@endif
