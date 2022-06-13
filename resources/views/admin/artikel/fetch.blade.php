<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Waktu Dibuat</th>
            <th>Waktu Dipublikasi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['artikel'] as $item)
            <tr>
                <td>{{ ($data['artikel']->currentpage() - 1) * $data['artikel']->perpage() + $loop->index + 1 }}</td>
                <td>{!! $item->judul !!}</td>
                <td>{!! $item->penulis !!}</td>
                <td>{!! tanggalJam($item->dibuat) !!}</td>
                <td>{!! tanggal($item->dipublikasi) !!}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Data tidak ada</td>
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
