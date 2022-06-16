<x-app-layout title="{{ $data['title'] }}">
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <x-breadcrumbs-component>
            <x-slot name="currentPage">{{ $data['title'] }}</x-slot>
        </x-breadcrumbs-component>

        <!-- ======= Kalimat Hikmah ======= -->
        <section id="testimonials" class="testimonials section-bg">
            <div class="container">
                <div class="row">
                    @forelse ($data['data'] as $item)
                        <x-card-kalimat-hikmah>
                            <x-slot name="penulis">{{ $item->penulis }}</x-slot>
                            <x-slot name="text">{{ $item->text }}</x-slot>
                        </x-card-kalimat-hikmah>
                    @empty
                        <h4>Belum ada data</h4>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
