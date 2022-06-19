@forelse ($data['data'] as $item)
    <x-card-poster-dakwah>
        <x-slot name="onclick">
            onclick="showModal(`{{ route('galeri-detail', $item->id) }}`)"
        </x-slot>
        <x-slot name="pathImage">{!! asset('storage/galeri/' . $item->filename) !!}</x-slot>
    </x-card-poster-dakwah>
@empty
    <h4>Data tidak ada</h4>
@endforelse

@if ($data['data']->hasPages())
    {{ $data['data']->links('components.pagination-admin') }}
@endif
