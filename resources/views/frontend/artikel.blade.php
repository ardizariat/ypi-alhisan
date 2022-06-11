<x-app-layout title="{{ $data['title'] }}">
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <x-breadcrumbs-component>
            <x-slot name="currentPage">{{ $data['title'] }}</x-slot>
        </x-breadcrumbs-component>
        <!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 entries">
                        @foreach ($data['artikel'] as $item)
                            <x-article-frontend-component>
                                <x-slot name="urlImage">{{ asset('application/img/blog/blog-1.jpg') }}</x-slot>
                                <x-slot name="judul">{!! Str::limit($item->judul, 30, '.') !!}</x-slot>
                                <x-slot name="penulis">
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-person"></i>
                                        <a
                                            href="{{ route('artikel-detail', $item->slug) }}">{{ $item->penulis }}</a>
                                    </li>
                                </x-slot>
                                <x-slot name="tanggal">
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-clock"></i>
                                        <a
                                            href="{{ route('artikel-detail', $item->slug) }}">{!! tanggal($item->dipublikasi) !!}</a>
                                    </li>
                                </x-slot>
                                <x-slot name="konten">
                                    {!! Str::limit($item->konten, 50, '.') !!}
                                </x-slot>
                                <x-slot name="urlDetail">{{ route('artikel-detail', $item->slug) }}</x-slot>
                            </x-article-frontend-component>
                        @endforeach

                        <div class="blog-pagination mb-3">
                            <ul class="justify-content-center">
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 entries">
                        <div class="sidebar">
                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item">
                                <form action="">
                                    <input type="search" class="form-control" name="search" autocomplete="off">
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($data['kategori'] as $item)
                                        <li><a
                                                href="{{ route('artikel', 'kategori=' . $item->slug . '') }}">{{ $item->nama }}<span>0</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Recent Posts</h3>
                            <div class="sidebar-item recent-posts">
                                <div class="post-item clearfix">
                                    <img src="application/img/blog/blog-recent-1.jpg" alt="">
                                    <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="application/img/blog/blog-recent-2.jpg" alt="">
                                    <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="application/img/blog/blog-recent-3.jpg" alt="">
                                    <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a>
                                    </h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="application/img/blog/blog-recent-4.jpg" alt="">
                                    <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="application/img/blog/blog-recent-5.jpg" alt="">
                                    <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                            </div><!-- End sidebar recent posts-->

                            <h3 class="sidebar-title">Tags</h3>
                            <div class="sidebar-item tags">
                                <ul>
                                    <li><a href="#">App</a></li>
                                    <li><a href="#">IT</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Mac</a></li>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Office</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Studio</a></li>
                                    <li><a href="#">Smart</a></li>
                                    <li><a href="#">Tips</a></li>
                                    <li><a href="#">Marketing</a></li>
                                </ul>
                            </div><!-- End sidebar tags-->

                        </div><!-- End sidebar -->

                    </div>

                </div>

            </div>
        </section>
    </main>

</x-app-layout>
