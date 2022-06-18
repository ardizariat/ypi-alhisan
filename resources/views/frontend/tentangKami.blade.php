<x-app-layout title="{{ $data['title'] }}">

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <x-breadcrumbs-component>
            <x-slot name="currentPage">{{ $data['title'] }}</x-slot>
        </x-breadcrumbs-component>
        <!-- End Breadcrumbs -->
        <!-- ======= About Us Section ======= -->
        <section id="about-us" class="about-us">
            <div class="container" data-aos="fade-up">

                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-right">
                        <h3>Tentang Kami</h3>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                        <p>
                            {!! alhisan()->tentang !!}
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

    </main>
</x-app-layout>
