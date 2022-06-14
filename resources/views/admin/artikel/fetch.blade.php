<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Waktu Dibuat</th>
            <th>Status</th>
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
                <td>
                    @if ($item->status == 'dipublikasi')
                        <span class="badge bg-light-success text-capitalize">{!! $item->status !!}</span>
                    @else
                        <span class="badge bg-light-warning text-capitalize">{!! $item->status !!}</span>
                    @endif
                </td>
                <td>{!! tanggal($item->dipublikasi) !!}</td>
            </tr>
        @empty
            <tr>

                <td></td>
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
@if ($data['artikel']->hasPages())
    <tfoot>
        {{ $data['artikel']->links('components.pagination-admin') }}
    </tfoot>
@endif
