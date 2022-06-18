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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.edit-profil', $data['data']->id) }}">Ubah
                                    Profil <i class="bi bi-arrow-right"></i></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-sm-12">
                    <div class="card shadow">
                        <div class="card-content">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/user/' . $data['data']->foto) }}" class="mt-3 img-fluid"
                                    style="max-height: 200px" alt="foto profil">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center text-uppercase">{!! $data['data']->name !!}</h5>
                            </div>
                        </div>

                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="col-3">Username</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->username !!}</td>
                                </tr>
                                <tr>
                                    <td class="col-3">Email</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->email !!}</td>
                                </tr>
                                <tr>
                                    <td class="col-3">NIK</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->nik !!}</td>
                                </tr>
                                <tr>
                                    <td class="col-3">Tempat Lahir</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->tempat_lahir !!}</td>
                                </tr>
                                <tr>
                                    <td class="col-3">Tanggal Lahir</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->tanggal_lahir ? tanggal($data['data']->tanggal_lahir) : '' !!}</td>
                                </tr>
                                <tr>
                                    <td class="col-3">Jenis Kelamin</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->jenis_kelamin !!}</td>
                                </tr>
                                <tr>
                                    <td class="col-3">No Hape</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->no_hp !!}</td>
                                </tr>
                                <tr>
                                    <td class="col-3">Alamat</td>
                                    <td class="col-6">
                                    </td>
                                    <td class="col-3 text-center">{!! $data['data']->alamat !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <x-slot name="js">
        <x-modal>
            <x-slot name="size">md</x-slot>
        </x-modal>
        <script>
            const modal = document.getElementById('modal-all-in-one')

            const renderHtml = (template, node) => {
                if (!node) return
                node.innerHTML = template
            }

            const fetchData = async (page = '', q = '') => {
                fetch(`/admin/user?page=${page}&q=${q}`, {
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

            const ekspor = (data) => {
                event.preventDefault()
                sendData(data).then((response) => {
                    let res = response.data
                    console.log(res)
                    // alertSuccess(res.message)
                    // pindahHalaman(res.url, 2000)
                }).catch((err) => {
                    alertError()
                })
            }
        </script>
    </x-slot>
</x-admin-app-layout>
