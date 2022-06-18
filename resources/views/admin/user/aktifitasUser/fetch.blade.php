<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Aktifitas</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['aktifitasUser'] as $item)
            <tr>
                <td>{{ ($data['aktifitasUser']->currentpage() - 1) * $data['aktifitasUser']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->nama !!}</td>
                <td>{!! $item->aktifitas !!}</td>
                <td>{!! $item->created_at ? tanggalJam($item->created_at) : '' !!}</td>
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
@if ($data['aktifitasUser']->hasPages())
    <tfoot>
        {{ $data['aktifitasUser']->links('components.pagination-admin') }}
    </tfoot>
@endif
