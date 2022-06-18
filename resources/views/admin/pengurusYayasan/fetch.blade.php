<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Bagian</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['pengurusYayasan'] as $item)
            <tr>
                <td>{{ ($data['pengurusYayasan']->currentpage() - 1) * $data['pengurusYayasan']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->nama !!}</td>
                <td>{!! $item->bagian !!}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.pengurus-yayasan.edit', $item->id) }}" data-bs-toggle="tooltip"
                            title="Ubah" data-bs-placement="top" data-bs-original-title="Ubah"
                            class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button"
                            onclick="showModal(`{{ route('admin.pengurus-yayasan.show', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="detail" data-bs-placement="top"
                            data-bs-original-title="detail" class="btn btn-outline-dark"><i
                                class="bi bi-eye"></i></button>
                        <button onclick="hapus(`{{ route('admin.pengurus-yayasan.delete', $item->id) }}`)"
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
@if ($data['pengurusYayasan']->hasPages())
    <tfoot>
        {{ $data['pengurusYayasan']->links('components.pagination-admin') }}
    </tfoot>
@endif
