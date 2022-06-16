<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Penulis</th>
            <th>Kalimat Hikmah</th>
            <th>Waktu Dibuat</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['kalimatHikmah'] as $item)
            <tr>
                <td>{{ ($data['kalimatHikmah']->currentpage() - 1) * $data['kalimatHikmah']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->penulis !!}</td>
                <td>{!! $item->text !!}</td>
                <td>{!! tanggalJam($item->created_at) !!}</td>
                <td>
                    <div class="btn-group">
                        <button onclick="showModal(`{{ route('admin.kalimat-hikmah.edit', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="Ubah" data-bs-placement="top" data-bs-original-title="Ubah"
                            class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button onclick="hapus(`{{ route('admin.kalimat-hikmah.delete', $item->id) }}`)"
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
            </tr>
        @endforelse
    </tbody>
    <input type="hidden" name="page" value="1" />
</table>
@if ($data['kalimatHikmah']->hasPages())
    <tfoot>
        {{ $data['artikel']->links('components.pagination-admin') }}
    </tfoot>
@endif
