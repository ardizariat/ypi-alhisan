<x-print-page title="{{ $data['title'] }}">
    <x-slot name="css">
        <style>
            @page {
                size: 25cm 35.7cm;
                margin: 5mm 5mm 5mm 5mm;
                /* change the margins as you want them to be. */
            }
        </style>
    </x-slot>
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('assets/images/logo/alhisanLogo.png') }}">
                    <h3 class="title text-center">{!! $data['title'] !!}</h3>
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <div class="invoice-contact-info">
                            <ul class="list-plain">
                                <li>Diekspor oleh : {!! auth()->user()->name !!}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="js">

        <script>
            function printPromot() {
                var css = '@page { size: landscape; }',
                    head = document.head || document.getElementsByTagName('head')[0],
                    style = document.createElement('style');

                style.type = 'text/css';
                style.media = 'print';

                if (style.styleSheet) {
                    style.styleSheet.cssText = css;
                } else {
                    style.appendChild(document.createTextNode(css));
                }

                head.appendChild(style);

                window.print();
            }
            // window.onfocus=function(){ window.close();}
        </script>
    </x-slot>
</x-print-page>
