<x-admin-app-layout title="{{ $data['title'] }}">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $data['title'] }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data['title'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="shadow card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group position-relative has-icon-right">
                                            <input onkeyup="cari(this)" type="text" class="form-control"
                                                placeholder="Search" autocomplete="off">
                                            <div class="form-control-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" id="data">
                                    @include('admin.artikel.fetch')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-slot name="js">
        <script>
            const renderHtml = (template, node) => {
                if (!node) return
                node.innerHTML = template
            }

            const fetchData = async (page = '', q = '') => {
                fetch(`/admin/artikel?page=${page}&q=${q}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                    .then(function(res) {
                        return res.text()
                    }).then(function(html) {
                        let data = document.getElementById('data')
                        renderHtml(html, data)
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

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault()
                let page = $(this).attr('href').split('page=')[1],
                    q = $('input[name=search]').val()
                fetchData(page, q)
            })
        </script>
    </x-slot>
</x-admin-app-layout>
