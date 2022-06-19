<x-admin-app-layout title="{{ $data['title'] }}">

    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/filepond/filepond.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.css') }}">
    </x-slot>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $data['title'] }}</h3>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="form-group position-relative has-icon-right">
                    <button type="button" onclick="showModal(`{{ route('admin.galeri.create') }}`)"
                        class="btn icon icon-left btn-outline-dark">Tambah</button>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="form-group position-relative has-icon-right">
                    <input onkeyup="cari(this)" type="text" class="form-control" placeholder="Search"
                        autocomplete="off">
                    <div class="form-control-icon">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" id="data">
                            @include('admin.galeri.galeri.fetch')
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
        <script src="{{ asset('assets/vendors/filepond/filepond.js') }}"></script>
        <script src="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.js') }}"></script>
        <script>
            const modal = document.getElementById('modal-all-in-one')

            FilePond.registerPlugin(FilePondPluginImagePreview)
            let pond = FilePond.create(
                document.querySelector('#filename'), {
                    instantUpload: false,
                    allowProcess: false
                });

            const save = (originalForm) => {
                event.preventDefault()
                let data = new FormData(originalForm)
                let pondFiles = pond.getFiles();
                for (let i = 0; i < pondFiles.length; i++) {
                    data.append('filename', pondFiles[i].file);
                }
                $.post({
                        url: $(originalForm).attr('action'),
                        data: data,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false
                    })
                    .done(response => {
                        let res = response.data
                        alertSuccess(res.message)
                        pindahHalaman(res.url, 2000)
                    })
                    .fail(errors => {
                        if (errors.status === 422) {
                            loopErrors(errors.responseJSON.errors);
                            return;
                        }
                        alertError()
                    })
            }

            const renderHtml = (template, node) => {
                if (!node) return
                node.innerHTML = template
            }

            const fetchData = async (page = '', q = '') => {
                fetch(`/admin/galeri?page=${page}&q=${q}`, {
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
                        alertError(err)
                    })
                $(modal).modal('show')
            }
        </script>
    </x-slot>
</x-admin-app-layout>
