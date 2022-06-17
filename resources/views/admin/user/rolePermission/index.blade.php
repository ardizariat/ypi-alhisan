<x-admin-app-layout title="{{ $data['title'] }}">
    <div class="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Role</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <h3>Permission</h3>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <!-- Role -->
                <div class="col-12 col-md-6 col-lg-6 col-sm-12">
                    <div class="shadow card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group position-relative has-icon-right">
                                            <button type="button"
                                                onclick="showModal(`{{ route('admin.role-permission.create-role') }}`)"
                                                class="btn icon icon-left btn-outline-dark">Tambah</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div class="form-group position-relative has-icon-right">
                                            <input onkeyup="cariRole(this)" type="text" class="form-control"
                                                placeholder="Search" autocomplete="off">
                                            <div class="form-control-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" id="data-role">
                                    @include('admin.user.rolePermission.fetchRole')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permission -->
                <div class="col-12 col-md-6 col-lg-6 col-sm-12">
                    <div class="shadow card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group position-relative has-icon-right">
                                            <button type="button"
                                                onclick="showModal(`{{ route('admin.role-permission.create-permission') }}`)"
                                                class="btn icon icon-left btn-outline-dark">Tambah</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div class="form-group position-relative has-icon-right">
                                            <input onkeyup="cariPermission(this)" type="text" class="form-control"
                                                placeholder="Search" autocomplete="off">
                                            <div class="form-control-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" id="data-permission">
                                    @include('admin.user.rolePermission.fetchPermission')
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
            <x-slot name="size">md</x-slot>
        </x-modal>
        <script>
            const modal = document.getElementById('modal-all-in-one')

            const renderHtml = (template, node) => {
                if (!node) return
                node.innerHTML = template
            }

            const fetchData = (url, dataId) => {
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                    .then(function(res) {
                        return res.text()
                    }).then(function(html) {
                        let data = document.getElementById(dataId)
                        renderHtml(html, data)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }

            const cariRole = (attr) => {
                let q = attr.value,
                    url = `/admin/role-permission?role=${q}`
                fetchData(url, 'data-role')
            }

            const cariPermission = (attr) => {
                let q = attr.value,
                    url = `/admin/role-permission?permission=${q}`
                fetchData(url, 'data-permission')
            }

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
