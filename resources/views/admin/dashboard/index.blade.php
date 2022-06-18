<x-admin-app-layout title="{!! $data['title'] !!}">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{!! $data['title'] !!}</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                @foreach ($data['saldoKas'] as $nama => $saldo)
                    <div class="col-12 col-md-4 col-lg-4 col-sm-6">
                        <div class="card shadow">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold text-capitalize">{!! $nama !!}
                                        </h6>
                                        <h6 class="font-extrabold mb-0">{!! rp($saldo) !!}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Agenda Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kegiatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data['agenda'] as $item)
                                            <tr>
                                                <td>{!! $loop->iteration !!}</td>
                                                <td>{!! $item->tanggal ? tanggalJam($item->tanggal) : '' !!}</td>
                                                <td>{!! $item->keterangan !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td>Belum ada data</td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-xl-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Kas Masuk Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Dari</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data['kasMasukKeluar']['masuk'] as $item)
                                            <tr>
                                                <td>{!! $loop->iteration !!}</td>
                                                <td>{!! $item->tanggal ? tanggal($item->tanggal) : '' !!}</td>
                                                <td>{!! $item->dari !!}</td>
                                                <td>{!! $item->nominal ? rp($item->nominal) : '' !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td>Belum ada data</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Kas Keluar Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Untuk</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data['kasMasukKeluar']['keluar'] as $item)
                                            <tr>
                                                <td>{!! $loop->iteration !!}</td>
                                                <td>{!! $item->tanggal ? tanggal($item->tanggal) : '' !!}</td>
                                                <td>{!! $item->dari !!}</td>
                                                <td>{!! $item->nominal ? rp($item->nominal) : '' !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td>Belum ada data</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-admin-app-layout>
