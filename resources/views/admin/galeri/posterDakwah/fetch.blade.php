<div class="row gallery">
    @forelse ($data['posterDakwah'] as $item)
        <div class="col-12 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
            <h5 class="card-title">{!! $item->keterangan !!}</h5>
            <a href="#" onclick="showModal(`{{ route('admin.poster-dakwah.show', $item->id) }}`)">
                <img class="w-100" src="{!! asset('storage/posterDakwah/' . $item->filename) !!}">
            </a>
        </div>
    @empty
        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
            <h5 class="card-title">Belum ada</h5>
        </div>
    @endforelse
</div>
<input type="hidden" name="page" value="1" />

@if ($data['posterDakwah']->hasPages())
    <tfoot>
        {{ $data['posterDakwah']->links('components.pagination-admin') }}
    </tfoot>
@endif
