<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Rapat</th>
            <th>Tanggal</th>
            <th>Bahasan</th>
            <th>Pilihan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['rapatYayasan'] as $item)
            <tr>
                <td>{{ ($data['rapatYayasan']->currentpage() - 1) * $data['rapatYayasan']->perpage() + $loop->index + 1 }}
                </td>
                <td>
                    {!! $item->kode !!}
{{--                    {!! QrCode::size(100)->generate($item->kode) !!}--}}
                </td>
                <td>{!! tanggalJam($item->tanggal) !!}</td>
                <td>{!! $item->bahasan !!}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.rapat-yayasan.share', $item->id) }}" target="_blank"
                            data-bs-toggle="tooltip" title="bagikan" data-bs-placement="top"
                            data-bs-original-title="bagikan" class="btn btn-outline-info">
                            <i class="bi bi-share"></i>
                        </a>
                        <button data-bs-toggle="tooltip" title="ubah" data-bs-placement="top"
                            data-bs-original-title="ubah" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <a href="{{ route('admin.rapat-yayasan.show', $item->id) }}" data-bs-toggle="tooltip"
                            title="detail" data-bs-placement="top" data-bs-original-title="detail"
                            class="btn btn-outline-dark"><i class="bi bi-eye"></i></a>
                        <button onclick="hapus(`{{ route('admin.rapat-yayasan.delete', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="hapus" data-bs-placement="top"
                            data-bs-original-title="Hapus" class="btn btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Data tidak ada</td>
            </tr>
        @endforelse
    </tbody>
    <input type="hidden" name="page" value="1" />
</table>
@if ($data['rapatYayasan']->hasPages())
    <tfoot>
        {{ $data['rapatYayasan']->links('components.pagination-admin') }}
    </tfoot>
@endif
