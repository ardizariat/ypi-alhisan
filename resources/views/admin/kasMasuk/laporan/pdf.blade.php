<x-print-page title="{{ $data['title'] }}">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('backend/images/logo-rs.jpeg') }}">
                    <h3 class="title text-center">{!! $data['title'] !!}</h3>
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <div class="invoice-contact-info">
                            <ul class="list-plain">
                                <li>Diekspor oleh : {!! auth()->user()->name !!}</li>
                                <li>Periode : {!! tanggal($data['dari']) !!} - {!! tanggal($data['sampai']) !!}</li>
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
                                    <th class="text-dark">Tanggal</th>
                                    <th class="text-dark">Dari</th>
                                    <th class="text-dark">Keterangan</th>
                                    <th class="text-dark pr-3 fs-18px ff-mono">Nominal</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="js">

        <script>
            function printPromot() {
                window.print();
            }
        </script>
    </x-slot>
</x-print-page>
