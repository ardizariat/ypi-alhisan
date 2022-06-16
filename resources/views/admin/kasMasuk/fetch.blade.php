<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Dari</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['kasMasuk'] as $item)
            <tr>
                <td>{{ ($data['kasMasuk']->currentpage() - 1) * $data['kasMasuk']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->dari !!}</td>
                <td>{!! $item->tanggal ? tanggal($item->tanggal) : '' !!}</td>
                <td>{!! $item->nominal ? rp($item->nominal) : '' !!}</td>
                <td>{!! $item->keterangan !!}</td>
                <td>
                    <div class="btn-group">
                        <button onclick="showModal(`{{ route('admin.kas-masuk.edit', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="Ubah" data-bs-placement="top" data-bs-original-title="Ubah"
                            class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button onclick="hapus(`{{ route('admin.kas-masuk.delete', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="hapus" data-bs-placement="top"
                            data-bs-original-title="Hapus" class="btn btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td></td>
                <td>Data tidak ada</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforelse
    </tbody>
    <input type="hidden" name="page" value="1" />
</table>
@if ($data['kasMasuk']->hasPages())
    <tfoot>
        {{ $data['kasMasuk']->links('components.pagination-admin') }}
    </tfoot>
@endif
