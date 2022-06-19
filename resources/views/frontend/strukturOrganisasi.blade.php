<x-app-layout title="{{ $data['title'] }}">

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <x-breadcrumbs-component>
            <x-slot name="currentPage">{{ $data['title'] }}</x-slot>
        </x-breadcrumbs-component>
        <!-- End Breadcrumbs -->

        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Dewan Pembina</h2>
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($data['data'] as $item)
                        @if ($item->bagian == 'dewan pembina')
                            <x-card-struktur-organisasi-component>
                                <x-slot name="pathImage">
                                    {{ $item->foto ? asset('storage/pengurusYayasan/' . $item->foto) : 'application/img/user.png' }}
                                </x-slot>
                                <x-slot name="nama">{!! $item->nama !!}</x-slot>
                                <x-slot name="bagian">{!! $item->bagian !!}</x-slot>
                            </x-card-struktur-organisasi-component>
                        @endif
                    @endforeach
                </div>

                <div class="section-title" data-aos="fade-up">
                    <h2>Dewan Pengawas</h2>
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($data['data'] as $item)
                        @if ($item->bagian == 'dewan pengawas')
                            <x-card-struktur-organisasi-component>
                                <x-slot name="pathImage">
                                    {{ $item->foto ? asset('storage/pengurusYayasan/' . $item->foto) : 'application/img/user.png' }}
                                </x-slot>
                                <x-slot name="nama">{!! $item->nama !!}</x-slot>
                                <x-slot name="bagian">{!! $item->bagian !!}</x-slot>
                            </x-card-struktur-organisasi-component>
                        @endif
                    @endforeach
                </div>


                <div class="section-title" data-aos="fade-up">
                    <h2>Pengurus Harian</h2>
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($data['data'] as $item)
                        @if ($item->bagian == 'ketua')
                            <x-card-struktur-organisasi-component>
                                <x-slot name="pathImage">
                                    {{ $item->foto ? asset('storage/pengurusYayasan/' . $item->foto) : 'application/img/user.png' }}
                                </x-slot>
                                <x-slot name="nama">{!! $item->nama !!}</x-slot>
                                <x-slot name="bagian">{!! $item->bagian !!}</x-slot>
                            </x-card-struktur-organisasi-component>
                        @endif
                    @endforeach
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($data['data'] as $item)
                        @if ($item->bagian == 'wakil' || $item->bagian == 'sekretaris' || $item->bagian == 'bendahara')
                            <x-card-struktur-organisasi-component>
                                <x-slot name="pathImage">
                                    {{ $item->foto ? asset('storage/pengurusYayasan/' . $item->foto) : 'application/img/user.png' }}
                                </x-slot>
                                <x-slot name="nama">{!! $item->nama !!}</x-slot>
                                <x-slot name="bagian">{!! $item->bagian !!}</x-slot>
                            </x-card-struktur-organisasi-component>
                        @endif
                    @endforeach
                </div>

                <div class="row d-flex justify-content-center">
                    @foreach ($data['data'] as $item)
                        @if ($item->bagian == 'bidang pendidikan dan dakwah')
                            <x-card-struktur-organisasi-component>
                                <x-slot name="pathImage">
                                    {{ $item->foto ? asset('storage/pengurusYayasan/' . $item->foto) : 'application/img/user.png' }}
                                </x-slot>
                                <x-slot name="nama">{!! $item->nama !!}</x-slot>
                                <x-slot name="bagian">{!! $item->bagian !!}</x-slot>
                            </x-card-struktur-organisasi-component>
                        @endif
                    @endforeach
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($data['data'] as $item)
                        @if ($item->bagian == 'bidang sosial')
                            <x-card-struktur-organisasi-component>
                                <x-slot name="pathImage">
                                    {{ $item->foto ? asset('storage/pengurusYayasan/' . $item->foto) : 'application/img/user.png' }}
                                </x-slot>
                                <x-slot name="nama">{!! $item->nama !!}</x-slot>
                                <x-slot name="bagian">{!! $item->bagian !!}</x-slot>
                            </x-card-struktur-organisasi-component>
                        @endif
                    @endforeach
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($data['data'] as $item)
                        @if ($item->bagian == 'bidang usaha lainnya')
                            <x-card-struktur-organisasi-component>
                                <x-slot name="pathImage">
                                    {{ $item->foto ? asset('storage/pengurusYayasan/' . $item->foto) : 'application/img/user.png' }}
                                </x-slot>
                                <x-slot name="nama">{!! $item->nama !!}</x-slot>
                                <x-slot name="bagian">{!! $item->bagian !!}</x-slot>
                            </x-card-struktur-organisasi-component>
                        @endif
                    @endforeach
                </div>

            </div>
        </section>
        <!-- End Our Team Section -->

    </main>
</x-app-layout>
