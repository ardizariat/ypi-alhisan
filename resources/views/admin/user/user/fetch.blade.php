<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['user'] as $item)
            <tr>
                <td>{{ ($data['user']->currentpage() - 1) * $data['user']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->name !!}</td>
                <td>{!! $item->username !!}</td>
                <td>{!! $item->email !!}</td>
                <td>
                    @foreach ($item->role as $role)
                        {!! replaceRole($role->name) !!}
                    @endforeach
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.user.edit', $item->id) }}" data-bs-toggle="tooltip" title="Ubah"
                            data-bs-placement="top" data-bs-original-title="Ubah" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.user.reset-password', $item->id) }}" method="post">
                            @method('put')
                            <button type="submit" onclick="resetPassword(this.form)" data-bs-toggle="tooltip"
                                title="Reset password" data-bs-placement="top" data-bs-original-title="Reset password"
                                class="btn btn-outline-info">
                                <i class="bi bi-arrow-repeat"></i>
                            </button>
                        </form>
                        <button onclick="hapus(`{{ route('admin.user.delete', $item->id) }}`)"
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
@if ($data['user']->hasPages())
    <tfoot>
        {{ $data['user']->links('components.pagination-admin') }}
    </tfoot>
@endif
