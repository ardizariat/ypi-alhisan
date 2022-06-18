<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Agenda</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['agenda'] as $item)
            <tr>
                <td>{{ ($data['agenda']->currentpage() - 1) * $data['agenda']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->tanggal ? tanggalJam($item->tanggal) : '' !!}</td>
                <td>{!! $item->keterangan !!}</td>
                <td>
                    <div class="btn-group">
                        <button onclick="showModal(`{{ route('admin.agenda.edit', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="Ubah" data-bs-placement="top" data-bs-original-title="Ubah"
                            class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button onclick="hapus(`{{ route('admin.agenda.delete', $item->id) }}`)"
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
                <td>Data tidak ada</td>
                <td></td>
                <td></td>
            </tr>
        @endforelse
    </tbody>
    <input type="hidden" name="page" value="1" />
</table>
@if ($data['agenda']->hasPages())
    <tfoot>
        {{ $data['agenda']->links('components.pagination-admin') }}
    </tfoot>
@endif
