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
                                <li>Tanggal Rapat : {!! tanggalJam($data['rapatYayasan']->tanggal) !!}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="invoice-bills">
                    <h4>Peserta</h4>
                    <ol>
                        @forelse ($data['peserta'] as $item)
                            <li>{!! $item->nama_peserta !!}</li>
                        @empty
                            <li>Belum ada</li>
                        @endforelse
                    </ol>
                    <h4 class="mt-5">Bahasan</h4>
                    <div class="row">
                        <div class="col-12">
                            {!! $data['rapatYayasan']->bahasan !!}
                        </div>
                    </div>
                    <h4 class="mt-5">Hasil</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-justify">
                                {!! $data['rapatYayasan']->hasil !!}
                            </div>
                        </div>
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
