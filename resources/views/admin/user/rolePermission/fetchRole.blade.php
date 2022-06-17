<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Role</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['roles'] as $item)
            <tr>
                <td>{{ $loop->iteration }}
                </td>
                <td>{!! $item->name !!}</td>
                <td>
                    <div class="btn-group">
                        <button onclick="showModal(`{{ route('admin.role-permission.edit-role', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="Ubah" data-bs-placement="top" data-bs-original-title="Ubah"
                            class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button onclick="hapus(`{{ route('admin.role-permission.delete-role', $item->id) }}`)"
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
            </tr>
        @endforelse
    </tbody>
</table>
