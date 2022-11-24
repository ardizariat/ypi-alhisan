<x-admin-app-layout title="{{ $data['title'] }}">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/filepond/filepond.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/pages/form-element-select.css') }}">
        <style>
            .ck-editor__editable {
                min-height: 500px;
            }
        </style>
    </x-slot>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $data['title'] }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.pengurus-yayasan.index') }}">Pengurus
                                    Yayasan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data['title'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form {{ $data['title'] }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" enctype="multipart/form-data"
                                    action="{{ route('admin.pengurus-yayasan.update', $data['data']->id) }}">
                                    @method('put')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="nama" value="{{ $data['data']->nama }}"
                                                            autocomplete="off" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Foto</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input name="foto" id="foto" type="file"
                                                                class="filepond image-preview-filepond">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Bagian</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <select name="bagian_id" class="choices form-select">
                                                            @foreach ($data['bagian'] as $item)
                                                                <option
                                                                    {{ $data['data']->bagian_id == $item->id ? 'selected' : '' }}
                                                                    value="{{ $item->id }}">
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3 d-flex justify-content-center">
                                                    <button onclick="save(this.form, 'post')" type="submit"
                                                        class="btn btn-success me-1 mb-1 rounded-pill">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-slot name="js">
        <script src="{{ asset('assets/vendors/filepond/filepond.js') }}"></script>
        <script src="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.js') }}"></script>
        <script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/form-element-select.js') }}"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview)
            let pond = FilePond.create(
                document.querySelector('#foto'), {
                    instantUpload: false,
                    allowProcess: false
                });

            const save = (originalForm) => {
                event.preventDefault()
                let data = new FormData(originalForm)
                let pondFiles = pond.getFiles();
                for (let i = 0; i < pondFiles.length; i++) {
                    data.append('foto', pondFiles[i].file);
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
        </script>
    </x-slot>
</x-admin-app-layout>
