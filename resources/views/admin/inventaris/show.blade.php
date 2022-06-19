<x-admin-app-layout title="{{ $data['title'] }}">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{!! $data['title'] !!}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.inventaris.edit', $data['data']->id) }}">Ubah Data <i
                                        class="bi bi-arrow-right"></i></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-sm-12">
                    <div class="card shadow">
                        <div class="card-content">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/inventaris/' . $data['data']->foto) }}"
                                    class="mt-3 img-fluid" style="max-height: 200px" alt="foto barnag">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center text-uppercase">{!! $data['data']->nama !!}</h5>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5>Kode Barang</h5>
                                <p>{!! $data['data']->kode !!}</p>
                            </li>
                            <li class="list-group-item">
                                <h5>Detail</h5>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td width="20%">Kategori</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->kategori !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Tahun Pembelian</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->tahun_pembelian !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Harga Beli Satuan</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->harga_beli_satuan ? rp($data['data']->harga_beli_satuan) : '' !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Jumlah</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->jumlah !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Keadaan Barang</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->keadaan !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Keterangan</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->keterangan !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-slot name="js">
        <script></script>
    </x-slot>
</x-admin-app-layout>
