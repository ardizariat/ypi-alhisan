<x-admin-app-layout title="{{ $data['title'] }}">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/filepond/filepond.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.css') }}">
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.alhisan.index') }}">Alhisan</a></li>
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
                                    action="{{ route('admin.alhisan.update', $data['data']->id) }}">
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
                                                        <input name="nama" autocomplete="off"
                                                            value="{{ $data['data']->nama }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Logo</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="logo" id="logo" type="file"
                                                            class="filepond image-preview-filepond">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>No Telpon</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="no_telpon" autocomplete="off"
                                                            value="{{ $data['data']->no_telpon }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>No Handphone</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="no_hp" autocomplete="off"
                                                            value="{{ $data['data']->no_hp }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Instagram</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="ig" autocomplete="off"
                                                            value="{{ $data['data']->ig }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Facebook</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="fb" autocomplete="off"
                                                            value="{{ $data['data']->fb }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Telegram</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="telegram" autocomplete="off"
                                                            value="{{ $data['data']->telegram }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Youtube</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="youtube" autocomplete="off"
                                                            value="{{ $data['data']->youtube }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input name="email" autocomplete="off"
                                                            value="{{ $data['data']->email }}" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <textarea id="alamat" class="form-control" autocomplete="off" name="alamat" rows="5">{{ $data['data']->alamat }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <label>Visi</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <textarea id="visi" class="form-control" autocomplete="off" name="visi" rows="5">{{ $data['data']->visi }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <label>Misi</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <textarea id="misi" class="form-control" autocomplete="off" name="misi" rows="5">{{ $data['data']->misi }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <label>Tujuan</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <textarea id="tujuan" class="form-control" autocomplete="off" name="tujuan" rows="5">{{ $data['data']->tujuan }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <label>Sejarah</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <textarea id="sejarah" class="form-control" autocomplete="off" name="sejarah" rows="5">{{ $data['data']->sejarah }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3 d-flex justify-content-center">
                                                <button onclick="save(this.form)" type="submit"
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
        <script>
            CKEDITOR.replace('sejarah')
            CKEDITOR.replace('visi')
            CKEDITOR.replace('misi')
            CKEDITOR.replace('tujuan')

            FilePond.registerPlugin(FilePondPluginImagePreview)
            let pond = FilePond.create(
                document.querySelector('#logo'), {
                    instantUpload: false,
                    allowProcess: false
                });

            const save = (originalForm) => {
                event.preventDefault()
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement()
                }
                let data = new FormData(originalForm)
                let pondFiles = pond.getFiles();
                for (let i = 0; i < pondFiles.length; i++) {
                    data.append('logo', pondFiles[i].file);
                }
                $.post({
                        url: $(originalForm).attr('action'),
                        data: data,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false
                    })
                    .done(res => {
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
