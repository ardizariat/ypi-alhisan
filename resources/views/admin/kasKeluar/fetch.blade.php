<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Untuk</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['kasKeluar'] as $item)
            <tr>
                <td>{{ ($data['kasKeluar']->currentpage() - 1) * $data['kasKeluar']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->untuk !!}</td>
                <td>{!! $item->tanggal ? tanggal($item->tanggal) : '' !!}</td>
                <td>{!! $item->nominal ? rp($item->nominal) : '' !!}</td>
                <td>{!! $item->keterangan !!}</td>
                <td>
                    <div class="btn-group">
                        <button onclick="showModal(`{{ route('admin.kas-keluar.edit', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="Ubah" data-bs-placement="top" data-bs-original-title="Ubah"
                            class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button onclick="hapus(`{{ route('admin.kas-keluar.delete', $item->id) }}`)"
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
@if ($data['kasKeluar']->hasPages())
    <tfoot>
        {{ $data['kasKeluar']->links('components.pagination-admin') }}
    </tfoot>
@endif
