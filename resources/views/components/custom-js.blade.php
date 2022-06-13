<script src="{{ asset('application/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        }
    })

    const sendData = (data) => {
        event.preventDefault()
        $(data).find('.form-control').removeClass('error')
        $(data).find('.form-control').removeClass('select2-hidden-accessible')
        $(".invalid").remove()
        return $.post({
                url: $(data).attr('action'),
                data: $(data).serialize(),
                beforeSend: function() {
                    $(data).find('.tombol-simpan').attr('disabled', true)
                    $(data).find('.text-simpan').text('Menyimpan . . .')
                    $(data).find('.loading-simpan').removeClass('d-none')
                },
                complete: function() {
                    $(data).find('.loading-simpan').addClass('d-none')
                    $(data).find('.text-simpan').text('Simpan')
                    $(data).find('.tombol-simpan').attr('disabled', false)
                }
            })
            .done(res => {
                let {
                    data
                } = res

                return data
            })
            .fail(errors => {
                if (errors.status === 422) {
                    loopErrors(errors.responseJSON.errors)
                    return
                }
                alertError()
            })
    }

    const deleteData = (url) => {
        return $.post({
                url: url,
                data: {
                    _method: "DELETE",
                },
            })
            .done(re => {
                let {
                    data
                } = res

                return data
            })
            .fail(errors => {
                alert_error(errors.responseJSON.message);
                return;
            })
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const reloadHalaman = () => window.location.href

    const alertError = (
        title = "Maaf, terjadi kesalahan",
        message = false
    ) => {
        if (!message) {
            Swal.fire(title, "harap hubungi tim developer", "error")
        }
        Swal.fire(title, message, "error")
    }

    const loopErrors = (errors) => {
        $(".invalid").remove()
        $("select").removeClass('select2-hidden-accessible')
        if (errors == undefined) {
            return
        }
        for (error in errors) {
            $(`[name=${error}]`).addClass("error")
            if ($(`[name=${error}]`).attr("type") == "radio") {
                $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next())
            } else if ($(`[name=${error}]`).hasClass("select2")) {
                $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next())
            } else if ($(`[name=${error}]`).attr("type") == "checkbox") {
                $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next().next())
            } else {
                $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`))
            }
        }
    }

    const alertSuccess = (message) => {
        Toast.fire({
            icon: "success",
            title: message,
        })
    }

    const resetForm = (selector) => {
        $(selector)[0].reset()
        $(".choices").trigger("change")
        $(".form-control, .choiches").removeClass("is-invalid")
        $(".select2").trigger("change")
        $(".invalid-feedback").remove()
    }

    function loopForm(originalForm) {
        for (field in originalForm) {
            if ($(`[name=${field}]`).attr('type') != 'file') {
                if ($(`[name=${field}]`).hasClass('summernote')) {
                    $(`[name=${field}]`).summernote('code', originalForm[field]);
                } else if ($(`[name=${field}]`).attr('type') == 'radio') {
                    $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true);
                } else {
                    $(`[name=${field}]`).val(originalForm[field]);
                }

                $('select').trigger('change');
            } else {
                $(`.preview-${field}`)
                    .attr('src', originalForm[field])
                    .show();
            }
        }
    }

    const pindahHalaman = (url, detik = 3000) => {
        setTimeout(function() {
            window.location.href = url
        }, detik)
    }
</script>
