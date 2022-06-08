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
                                        Menjadi lembaga dakwah dan pendidikan islam terbaik dalam
                                        mencerahkan dan mencerdaskan kehidupan umat guna mewujudkan
                                        generasi istimewa yang beriman, berilmu dan bertaqwa.
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
                                        <ol>
                                            <li>
                                                Mewujudkan program-program tarbiyah islamiyah yang komperhensif
                                                meliputi semua prinsip-prinsip agama islam, baik aqidah, ibadah,
                                                mu'amalah, akhlaq dan adab.
                                            </li>
                                            <li>
                                                Menjadi wadah sebagai media dakwah, sosial dan pendidikan untuk
                                                melaksanakan prinsip-prinsip ajaran islam yang berlandaskan
                                                Al-Qur'an dan Al-Hadist dalam kehidupan.
                                            </li>
                                            <li>
                                                Membina dan memajukan masyarakat melalui pengembangan kegiatan
                                                yang meningkatkan IMTAQ dan IPTEK sesuai dengan ajaran islam
                                                untuk mewujudkan masyarakat yang beriman, berilmu dan bertaqwa.
                                            </li>
                                            <li>
                                                Mendorong terwujudnya masyarakat yang sejahtera dan menjaga
                                                ukhuwah serta kesatuan umat</li>
                                        </ol>
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
                                        Mencetak generasi istimewa yang berkarakter dan menjadi pionir dalam membangun
                                        masyarakat yang beriman, berilmu dan kesejahteraan umat.
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
