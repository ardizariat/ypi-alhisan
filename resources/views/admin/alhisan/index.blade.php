<x-admin-app-layout title="{{ $data['title'] }}">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{!! $data['title'] !!}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.alhisan.edit', $data['data']->id) }}">Ubah Data <i
                                        class="bi bi-arrow-right"></i></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row d-flex justify-content-center">
                <div class="col-8 col-md-8 col-lg-8 col-sm-12">
                    <div class="card shadow">
                        <div class="card-content">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/alhisan/' . $data['data']->logo) }}"
                                    class="mt-3 img-fluid" style="max-height: 200px" alt="logo alhisan">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center text-uppercase">{!! $data['data']->nama !!}</h5>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5>Sejarah</h5>
                                <p>{!! $data['data']->sejarah !!}</p>
                            </li>
                            <li class="list-group-item">
                                <h5>Visi</h5>
                                <p>{!! $data['data']->visi !!}</p>
                            </li>
                            <li class="list-group-item">
                                <h5>Misi</h5>
                                <p>{!! $data['data']->misi !!}</p>
                            </li>
                            <li class="list-group-item">
                                <h5>Tujuan</h5>
                                <p>{!! $data['data']->tujuan !!}</p>
                            </li>

                            <li class="list-group-item">
                                <h5>Kontak</h5>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td width="20%">No Telpon</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->no_telpon !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">No Handphone</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->no_hp !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Email</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->email !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Instagram</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->ig !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Facebook</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->fb !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Telegram</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->telegram !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Youtube</td>
                                            <td>:</td>
                                            <td>{!! $data['data']->youtube !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Alamat</td>
                                            <td>:</td>
                                            <td class="pt-4">{!! $data['data']->alamat !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-slot name="js">
        <script></script>
    </x-slot>
</x-admin-app-layout>
