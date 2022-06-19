<x-app-layout title="{{ $data['title'] }}">
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <x-breadcrumbs-component>
            <x-slot name="currentPage">{{ $data['title'] }}</x-slot>
        </x-breadcrumbs-component>

        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Galeri</h2>
                </div>
                <div class="row d-flex justify-content-center" id="data-poster">
                    @include('frontend.fetch.galeriFetch')
                    <input type="hidden" name="page" value="1" />
                </div>
            </div>
        </section>
    </main>

    <x-modal>
        <x-slot name="size">md</x-slot>
    </x-modal>


    <x-slot name="js">
        <script src="{{ asset('application/js/jquery-3.6.0.min.js') }}"></script>
        <script>
            const modal = document.getElementById('modal-all-in-one')

            const renderHtml = (template, node) => {
                if (!node) return
                node.innerHTML = template
            }

            const fetchData = async (page = '') => {
                fetch(`/galeri?page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                    .then(function(res) {
                        return res.text()
                    }).then(function(html) {
                        let data = document.getElementById('data-poster')
                        console.log(data);
                        renderHtml(html, data)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault()
                let page = $(this).attr('href').split('page=')[1]
                fetchData(page)
            })

            const showModal = (url) => {
                event.preventDefault()
                fetch(url)
                    .then(function(res) {
                        return res.text()
                    })
                    .then(function(html) {
                        let modalContent = document.getElementById('modal-content')
                        renderHtml(html, modalContent)
                    })
                    .catch(err => {
                        console.log(err)
                    })
                $(modal).modal('show')
            }
        </script>
    </x-slot>
</x-app-layout>
