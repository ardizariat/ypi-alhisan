<x-admin-app-layout title="{{ $data['title'] }}">
    <x-slot name="css">
        <style>
            .hasil {
                margin: 0;
                text-align: justify;
            }
        </style>
    </x-slot>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{!! $data['title'] !!}</h3>
                    <p class="text-subtitle text-muted">
                        {!! tanggalJam($data['rapatYayasan']->tanggal) !!}
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.rapat-yayasan.index') }}">Rapat
                                    Yayasan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hasil Rapat Yayasan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="tasks">
            <div class="row">
                <div class="col-lg-7 col-sm-12 col-md-7">
                    <div class="card widget-todo">
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <h4 class="card-title d-flex">
                                <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>Peserta Rapat
                            </h4>
                        </div>
                        <div class="card-body px-0 py-1">
                            <ul class="widget-todo-list-wrapper">
                                @forelse($data['peserta'] as $item)
                                    <li class="widget-todo-item mt-2">
                                        <div
                                            class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                            <div class="widget-todo-title-area d-flex align-items-center">
                                                <span class="widget-todo-title ml-50">{!! $item->nama_peserta !!}</span>
                                            </div>
                                            <div class="widget-todo-item-action d-flex align-items-center">
                                                <div class="badge badge-pill bg-light-success me-1">
                                                    {!! tanggalJam($item->waktu_absen) !!}</div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <p>Belum ada peserta</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12 col-md-5">
                    <div class="card widget-todo">
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <h4 class="card-title d-flex">
                                <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>Bahasan
                            </h4>
                        </div>
                        <div class="card-body px-0 py-1">
                            {!! $data['rapatYayasan']->bahasan !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12">
                    <form action="{{ route('admin.rapat-yayasan.update', $data['rapatYayasan']->id) }}">
                        @csrf
                        @method('put')
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Hasil</h4>
                                    <div class="card-text" id="hasil-text">
                                        {!! $data['rapatYayasan']->hasil !!}
                                    </div>
                                    <div class="row d-none form-update">
                                        <div class="col-md-12 col-sm-12 mt-2">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                    <textarea id="hasil-form" class="form-control" autocomplete="off" name="hasil" rows="5">{!! $data['rapatYayasan']->hasil !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="toggle-ckeditor btn btn-outline-dark">
                                    <i class="bi bi-pen-fill"></i> Ubah
                                </button>
                                <button type="button" onclick="save(this.form)"
                                    class="d-none btn-update btn btn-outline-primary">
                                    <i class="bi bi-check2"></i> Update
                                </button>
                                <a href="{{ route('admin.rapat-yayasan.print', $data['rapatYayasan']->id) }}"
                                    target="_blank" class="btn btn-outline-success">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <x-slot name="js">
        <script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace('hasil-form')
            const toggle = document.querySelector('.card-footer .toggle-ckeditor')
            const btnUpdate = document.querySelector('.card-footer .btn-update')
            const hasil = document.getElementById('hasil-text')
            const formUpdate = document.querySelector('.card-body .form-update')

            toggle.addEventListener('click', (e) => {
                e.preventDefault()
                btnUpdate.classList.toggle('d-none')
                toggle.classList.toggle('d-none')
                formUpdate.classList.toggle('d-none')
                hasil.classList.toggle('d-none')
                let data = CKEDITOR.instances['hasil-form'].getData()
            })

            const save = (data) => {
                event.preventDefault()
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement()
                }
                sendData(data).then((response) => {
                    let res = response.data
                    alertSuccess(res.message)
                    pindahHalaman(reloadHalaman(), 2000)
                }).catch((err) => {
                    alertError()
                })
            }
        </script>
    </x-slot>
</x-admin-app-layout>
