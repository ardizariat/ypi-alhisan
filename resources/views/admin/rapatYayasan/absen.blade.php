<x-admin-app-layout>
    <div class="page-heading">
        <section class="section">
            {{-- <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-6 col-lg-6 col-sm-12">
                    <div class="shadow alert alert-success color-success">
                        <h4 class="alert-heading">Absen berhasil</h4>
                        Terima kasih atas kehadiran anda
                    </div>
                </div>
            </div> --}}
        </section>
    </div>
    <div class="d-none">
        <a href="{{ route('admin.rapat-yayasan.absen', $rapatYayasan->id) }}" id="url-absen"></a>
    </div>
    <x-slot name="js">
        <script>
            const url = document.getElementById('url-absen').href
            window.onload = function() {
                Swal.fire({
                    title: 'Masukkan kode musyawaroh',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off',
                        autocomplete: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post({
                                url: url,
                                data: {
                                    kode: result.value
                                }
                            })
                            .done(res => {
                                alertSuccessModal(res.message)
                                pindahHalaman(res.url, 2000)
                            }).catch((err) => {
                                alertError(err.responseJSON.message)
                                pindahHalaman(reloadHalaman(), 2000)
                            })
                    }
                })
            }

            const alertSuccessModal = (message) => {
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: message,
                    showConfirmButton: false,
                    timer: 2000
                })

            }
        </script>
    </x-slot>
</x-admin-app-layout>
