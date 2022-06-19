<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga Beli Satuan</th>
            <th>Jumlah</th>
            <th>Keadaan</th>
            <th>Tahun Pembelian</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['inventaris'] as $item)
            <tr>
                <td>{{ ($data['inventaris']->currentpage() - 1) * $data['inventaris']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->kode !!}</td>
                <td>{!! $item->nama !!}</td>
                <td>{!! $item->kategori !!}</td>
                <td>{!! $item->harga_beli_satuan !!}</td>
                <td>{!! $item->jumlah !!}</td>
                <td>{!! $item->keadaan !!}</td>
                <td>{!! $item->tahun_pembelian !!}</td>
                <td>
                    <div class="btn-group dropdown me-1 mb-1">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" id="dropdownMenuOffset"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="5,20">
                            Pilihan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" style="">
                            <a class="dropdown-item" href="{{ route('admin.inventaris.edit', $item->id) }}">Ubah</a>
                            <a class="dropdown-item" href="{{ route('admin.inventaris.show', $item->id) }}">Detail</a>
                            <a class="dropdown-item"
                                onclick="hapus(`{{ route('admin.inventaris.delete', $item->id) }}`)"
                                href="#">Hapus</a>
                        </div>
                    </div>
                </td>
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
    <input type="hidden" name="page" value="1" />
</table>
@if ($data['inventaris']->hasPages())
    <tfoot>
        {{ $data['inventaris']->links('components.pagination-admin') }}
    </tfoot>
@endif
