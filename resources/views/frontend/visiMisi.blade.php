<x-app-layout title="{{ $data['title'] }}">


    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <x-breadcrumbs-component>
            <x-slot name="currentPage">{{ $data['title'] }}</x-slot>
        </x-breadcrumbs-component>
        <!-- End Breadcrumbs -->

        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">
                <!-- Visi -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="section-title">
                            <h2>Visi</h2>
                        </div>
                        <div class="faq-list">
                            <ul>
                                <x-visi-misi-component>
                                    <x-slot name="konten">
                                        {!! alhisan()->visi !!}
                                    </x-slot>
                                </x-visi-misi-component>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Misi -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="section-title mt-5">
                            <h2>Misi</h2>
                        </div>
                        <div class="faq-list">
                            <ul>
                                <x-visi-misi-component>
                                    <x-slot name="konten">
                                        {!! alhisan()->misi !!}
                                    </x-slot>
                                </x-visi-misi-component>
                            </ul>
                        </div>
                    </div>
                </div>



                <!-- Tujuan -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="section-title mt-5">
                            <h2>Tujuan</h2>
                        </div>
                        <div class="faq-list">
                            <ul>
                                <x-visi-misi-component>
                                    <x-slot name="konten">
                                        {!! alhisan()->tujuan !!}
                                    </x-slot>
                                </x-visi-misi-component>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

</x-app-layout>
