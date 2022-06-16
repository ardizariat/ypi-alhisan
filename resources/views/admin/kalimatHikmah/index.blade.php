<x-admin-app-layout title="{{ $data['title'] }}">
    <x-custom-css>
        <style>
            .btn-opsi {
                position: absolute;
                left: 0px;
                top: 0px;
                z-index: 99999;
            }
        </style>
    </x-custom-css>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $data['title'] }}</h3>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="shadow card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group position-relative has-icon-right">
                                            <button type="button"
                                                onclick="showModal(`{{ route('admin.kalimat-hikmah.modal-create') }}`)"
                                                class="btn icon icon-left btn-outline-dark">Tambah</button>
                                        </div>
                                    </div>
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
                                    @include('admin.kalimatHikmah.fetch')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-slot name="js">
        <x-modal>
            <x-slot name="size">xl</x-slot>
        </x-modal>
        <script>
            const modal = document.getElementById('modal-all-in-one')

            const renderHtml = (template, node) => {
                if (!node) return
                node.innerHTML = template
            }

            const fetchData = async (page = '', q = '') => {
                fetch(`/admin/kalimat-hikmah?page=${page}&q=${q}`, {
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

            const hapus = (url) => {
                event.preventDefault()
                Swal.fire({
                    title: "Apakah anda yakin menghapus data ini?",
                    text: "Data yang sudah dihapus tidak dapat dikembalikan lagi!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteData(url).then((result) => {
                            let res = result.data
                            alertSuccess(res.message)
                            pindahHalaman(res.url, 1000)
                        }).catch((err) => {
                            alertError()
                        })
                    }
                })
            }

            const showModal = (url) => {
                fetch(url)
                    .then(function(res) {
                        return res.text()
                    })
                    .then(function(html) {
                        let modalContent = document.getElementById('modal-content')
                        renderHtml(html, modalContent)
                    })
                    .catch(err => {
                        alertError(err)
                    })
                $(modal).modal('show')
            }

            const save = (data) => {
                event.preventDefault()
                sendData(data).then((response) => {
                    let res = response.data
                    alertSuccess(res.message)
                    pindahHalaman(res.url, 2000)
                }).catch((err) => {
                    alertError()
                })
            }
        </script>
    </x-slot>
</x-admin-app-layout>
