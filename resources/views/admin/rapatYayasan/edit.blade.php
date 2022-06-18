<x-admin-app-layout title="{{ $data['title'] }}">
    <x-slot name="css">
        <style>
            .ck-editor__editable {
                min-height: 200px;
            }
        </style>
        <link href="{{ asset('assets/vendors/date-time-pickers/css/flatpicker-airbnb.css') }}" rel="stylesheet"
            type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.rapat-yayasan.index') }}">Rapat
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
                                <form class="form form-horizontal"
                                    action="{{ route('admin.rapat-yayasan.update', $data['data']->id) }}">
                                    @method('put')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Kode Rapat</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" readonly
                                                            value="{{ $data['data']->kode }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-lock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tanggal Rapat</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control date-time"
                                                            value="{{ $data['data']->tanggal }}" name="tanggal"
                                                            placeholder="Tanggal rapat" autocomplete="off">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>Rencana Bahasan</label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 mt-2">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <textarea id="bahasan" class="form-control" autocomplete="off" name="bahasan" rows="5">{!! $data['data']->bahasan !!}</textarea>
                                                    </div>
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
        <script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/vendors/date-time-pickers/js/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/vendors/date-time-pickers/js/date-time-picker-script.js') }}"></script>
        <script>
            CKEDITOR.replace('bahasan')
            const save = (data) => {
                event.preventDefault()
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement()
                }

                sendData(data).then((response) => {
                    let res = response.data
                    alertSuccess(res.message)
                    pindahHalaman(res.url, 2000)
                }).catch((err) => {
                    alertError()
                })
            }

            $(document).ready(function() {
                $(".max-date").flatpickr({
                    enableTime: true,
                    time_24hr: true,
                })
            })
        </script>
    </x-slot>
</x-admin-app-layout>
