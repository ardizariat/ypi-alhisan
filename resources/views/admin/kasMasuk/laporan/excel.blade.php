<div class="row">
    <div class="col-12">
        <table>
            <tr>
                <td>Diekspor Oleh</td>
                <td>:</td>
                <td>{!! auth()->user()->name !!}</td>
            </tr>
            <tr>
                <td>Tanggal Diekspor</td>
                <td>:</td>
                <td>{!! tanggalJam(now()) !!}</td>
            </tr>
            <tr>
                <td>Periode Tanggal</td>
                <td>:</td>
                <td>{!! tanggal($data['dari']) !!} - {!! tanggal($data['sampai']) !!}</td>
            </tr>
        </table>
    </div>
</div>
<table>
    <thead>
        <tr>
            <th class="text-dark">No</th>
            <th class="text-dark">Tanggal</th>
            <th class="text-dark">Dari</th>
            <th class="text-dark">Keterangan</th>
            <th class="text-dark">Nominal</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['data'] as $item)
            <tr>
                <td>{!! $loop->iteration !!}</td>
                <td>{!! $item->tanggal ? tanggal($item->tanggal) : '' !!}</td>
                <td>{!! $item->dari !!}</td>
                <td>{!! $item->keterangan !!}</td>
                <td class="text-right pr-3 fs-18px ff-mono">{!! $item->nominal ? rp($item->nominal) : '' !!}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Data tidak ada</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td colspan="2" class="fs-15px">Grand Total</td>
            <td class="text-right pr-3 fs-18px ff-mono">{!! $data['data']->sum('nominal') ? rp($data['data']->sum('nominal')) : 0 !!}</td>
        </tr>
    </tfoot>
</table>
