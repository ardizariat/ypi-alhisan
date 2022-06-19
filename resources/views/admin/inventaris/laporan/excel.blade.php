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
        </table>
    </div>
</div>
<table>
    <thead>
        <tr>
            <th class="text-dark">No</th>
            <th class="text-dark">Kode Barang</th>
            <th class="text-dark">Nama Barang</th>
            <th class="text-dark">Tahun Pembelian</th>
            <th class="text-dark">Kategori</th>
            <th class="text-dark">Keadaan Barang</th>
            <th class="text-dark">Jumlah</th>
            <th class="text-dark">Keterangan</th>
            <th class="text-dark pr-3 fs-18px ff-mono">Harga Beli Satuan</th>
            <th class="text-dark pr-3 fs-18px ff-mono">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['data'] as $item)
            <tr>
                <td>{!! $loop->iteration !!}</td>
                <td>{!! $item->kode !!}</td>
                <td>{!! $item->nama !!}</td>
                <td>{!! $item->tahun_pembelian !!}</td>
                <td>{!! $item->kategori !!}</td>
                <td>{!! $item->keadaan !!}</td>
                <td>{!! $item->jumlah !!}</td>
                <td>{!! $item->keterangan !!}</td>
                <td class="text-right pr-3 fs-18px ff-mono">{!! $item->harga_beli_satuan ? rp($item->harga_beli_satuan) : '' !!}</td>
                <td class="text-right pr-3 fs-18px ff-mono">{!! $item->harga_beli_satuan && $item->jumlah ? rp($item->harga_beli_satuan * $item->jumlah) : '' !!}</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Data tidak ada</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7"></td>
            <td colspan="2" class="fs-15px">Total Aset</td>
            <td class="text-right pr-3 fs-18px ff-mono">{!! $data['total'] ? rp($data['total']) : 0 !!}</td>
        </tr>
    </tfoot>
</table>
