<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            @role('superAdmin')
                <th>Penulis</th>
            @endrole
            <th>Waktu Dibuat</th>
            <th>Status</th>
            <th>Waktu Dipublikasi</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['artikel'] as $item)
            <tr>
                <td>{{ ($data['artikel']->currentpage() - 1) * $data['artikel']->perpage() + $loop->index + 1 }}</td>
                <td>{!! $item->judul !!}</td>
                <td>{!! $item->penulis !!}</td>
                <td>{!! tanggalJam($item->dibuat) !!}</td>
                <td>
                    @if ($item->status == 'dipublikasi')
                        <span class="badge bg-light-success text-capitalize">{!! $item->status !!}</span>
                    @else
                        <span class="badge bg-light-warning text-capitalize">{!! $item->status !!}</span>
                    @endif
                </td>
                <td>{!! tanggal($item->dipublikasi) !!}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.artikel.share', $item->id) }}" target="_blank" data-bs-toggle="tooltip"
                            title="bagikan" data-bs-placement="top" data-bs-original-title="bagikan"
                            class="btn btn-outline-info">
                            <i class="bi bi-share"></i>
                        </a>
                        <a href="{{ route('admin.artikel.edit', $item->id) }}" data-bs-toggle="tooltip" title="Ubah"
                            data-bs-placement="top" data-bs-original-title="Ubah" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a target="_blank" href="{{ route('admin.artikel.show', $item->id) }}"
                            data-bs-toggle="tooltip" title="detail" data-bs-placement="top"
                            data-bs-original-title="detail" class="btn btn-outline-dark"><i class="bi bi-eye"></i></a>
                        <button onclick="hapus(`{{ route('admin.artikel.delete', $item->id) }}`)"
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
@if ($data['artikel']->hasPages())
    <tfoot>
        {{ $data['artikel']->links('components.pagination-admin') }}
    </tfoot>
@endif
