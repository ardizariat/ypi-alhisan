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
                    <div class="col-lg-8 col-md-12 col-sm-12 entries" id="konten">

                        @include('frontend.artikelFetch')
                        <input type="hidden" name="page" value="1" id="page-artikel" />

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 entries">
                        <div class="sidebar">
                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item">
                                <form action="">
                                    <input onkeyup="cari(this)" type="text" class="form-control form-search"
                                        name="search" autocomplete="off">
                                </form>
                            </div>

                            <h3 class="sidebar-title">Kategori</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($data['kategori'] as $item)
                                        <li><a
                                                href="{{ route('artikel', 'kategori=' . $item->slug . '') }}">{{ $item->nama }}<span>{{ $item->kategori_count }}</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <h3 class="sidebar-title">Artikel Terbaru</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($data['artikelTerbaru'] as $item)
                                    <div class="post-item clearfix">
                                        <img src="application/img/blog/blog-recent-1.jpg" alt="">
                                        <h4><a href="blog-single.html">{!! $item->judul !!}</a></h4>
                                        <time datetime="2020-01-01">{!! tanggal($item->dipublikasi) !!}</time>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-slot name="js">
        <script src="{{ asset('application/js/jquery-3.6.0.min.js') }}"></script>
        <script>
            const renderHtml = (template, node) => {
                if (!node) return
                node.innerHTML = template
            }

            const fetchData = async (page = '', q = '') => {
                fetch(`/artikel?page=${page}&q=${q}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                    .then(function(res) {
                        return res.text()
                    }).then(function(html) {
                        let artikel = document.getElementById('konten')
                        renderHtml(html, artikel)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }

            const cari = (attr) => {
                let q = attr.value,
                    element = document.getElementsByName("page")[0],
                    page
                if (element != null) {
                    page = element.value;
                } else {
                    page = 1;
                }
                fetchData(page, q)
            }

            // let pagination = document.querySelector('.pagination-link')
            // let links = pagination.querySelectorAll('a')

            // links.forEach(link => {
            //     link.addEventListener('click', (e) => {
            //         e.preventDefault()
            //         let page = link.href.split("page=")[1],
            //             q = document.getElementsByName('search')[0].value
            //         fetchData(page, q)
            //     })
            // })

            $(document).on('click', '.pagination-link a', function(e) {
                e.preventDefault()
                let page = $(this).attr('href').split('page=')[1],
                    q = $('input[name=search]').val()
                fetchData(page, q)
            })
        </script>
    </x-slot>

</x-app-layout>
