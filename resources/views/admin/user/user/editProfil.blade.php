<x-admin-app-layout title="{{ $data['title'] }}">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/pages/form-element-select.css') }}">
        <link href="{{ asset('assets/vendors/date-time-pickers/css/flatpicker-airbnb.css') }}" rel="stylesheet"
            type="text/css" />
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

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form {{ $data['title'] }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal"
                                    action="{{ route('admin.update-profil', $data['data']->id) }}">
                                    @method('put')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <x-form-input>
                                                <x-slot name="label">Nama</x-slot>
                                                <x-slot name="value">{!! $data['data']->name !!}</x-slot>
                                                <x-slot name="name">name</x-slot>
                                                <x-slot name="type">text</x-slot>
                                            </x-form-input>
                                            <x-form-input>
                                                <x-slot name="label">Username</x-slot>
                                                <x-slot name="value">{!! $data['data']->username !!}</x-slot>
                                                <x-slot name="name">username</x-slot>
                                                <x-slot name="type">text</x-slot>
                                            </x-form-input>
                                            <x-form-input>
                                                <x-slot name="label">Email</x-slot>
                                                <x-slot name="value">{!! $data['data']->email !!}</x-slot>
                                                <x-slot name="name">email</x-slot>
                                                <x-slot name="type">email</x-slot>
                                            </x-form-input>
                                            <x-form-input>
                                                <x-slot name="label">NIK</x-slot>
                                                <x-slot name="value">{!! $data['data']->nik !!}</x-slot>
                                                <x-slot name="name">nik</x-slot>
                                                <x-slot name="type">text</x-slot>
                                            </x-form-input>
                                            <x-form-input>
                                                <x-slot name="label">No Handphone / Whatsapp</x-slot>
                                                <x-slot name="value">{!! $data['data']->no_hp !!}</x-slot>
                                                <x-slot name="name">no_hp</x-slot>
                                                <x-slot name="type">text</x-slot>
                                            </x-form-input>
                                            <x-form-input>
                                                <x-slot name="label">Tempat Lahir</x-slot>
                                                <x-slot name="value">{!! $data['data']->tempat_lahir !!}</x-slot>
                                                <x-slot name="name">tempat_lahir</x-slot>
                                                <x-slot name="type">text</x-slot>
                                            </x-form-input>
                                            <div class="col-md-4">
                                                <label>Tanggal Lahir</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" value="{!! $data['data']->tanggal_lahir !!}"
                                                            class="form-control max-date" name="tanggal_lahir"
                                                            placeholder="Tanggal lahir" autocomplete="off">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jenis Kelamin</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select name="jenis_kelamin" class="choices form-select">
                                                        <option disabled selected>Pilih jenis kelamin</option>
                                                        <option
                                                            {{ $data['data']->jenis_kelamin === 'laki-laki' ? 'selected' : '' }}
                                                            value="{{ $data['data']->jenis_kelamin }}">Laki-Laki
                                                        </option>
                                                        <option
                                                            {{ $data['data']->jenis_kelamin === 'perempuan' ? 'selected' : '' }}
                                                            value="{{ $data['data']->jenis_kelamin }}">Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Foto Profil</label>
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
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <textarea name="alamat" class="form-control" cols="30" rows="5">{!! $data['data']->alamat !!}</textarea>
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
        <script src="{{ asset('assets/vendors/date-time-pickers/js/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/vendors/date-time-pickers/js/date-time-picker-script.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/form-element-select.js') }}"></script>
        <script src="{{ asset('assets/vendors/filepond/filepond.js') }}"></script>
        <script src="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.js') }}"></script>
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
