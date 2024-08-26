@section('atten', 'active')
@section('title', 'Kehadiran')

<style>
    #surat-tugas {
        display: none;
    }

    .image-input-wrapper {
        background-position: center;
        /* Centers the image */
        background-size: cover;
        /* Ensures the image covers the entire area */
        background-repeat: no-repeat;
        /* Prevents the image from repeating */
    }
</style>

<div class="row g-5 gx-xl-10 mb-5 mb-xl-10  justify-content-center align-items-center ">

    <div class="col-xl-8 col-md-10 col-sm-12">

        @if (session('error'))
            <!--begin::Alert-->
            <div class="alert alert-danger  d-flex align-items-center p-5">
                <!--begin::Icon-->
                <i class="ki-duotone ki-double-check  fs-2hx text-danger me-4 ">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <span>{{ session('error') }}.</span>
                </div>
                <!--end::Wrapper-->
            </div>
        @endif
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="fa-sharp-duotone fa-solid fa-clipboard fs-1 me-2"></i>
                    <h2>Silahkan Isi Kehadiran Anda</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <form action="{{ route('absen.user.post') }}" enctype="multipart/form-data" method="POST">
                    <!--begin::Input group-->
                    @csrf
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Tipe Kehadiran</span>
                            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Enter the contact's name."
                                data-bs-original-title="Enter the contact's name." data-kt-initialized="1">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" aria-label="type" name="typeAttendance" id="type">
                            <option value="Piket">Piket</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Dik">Dik</option>
                            <option value="Tugas">Tugas</option>
                        </select>
                        <!--end::Input-->
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">

                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7" id="surat-tugas">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span>Upload Surat Tugas Max 10 MB (PDF/JPG)</span>
                            <span class="ms-1" data-bs-toggle="tooltip"
                                aria-label="Enter the contact's company name (optional)."
                                data-bs-original-title="Enter the contact's company name (optional)."
                                data-kt-initialized="1">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control" name="document" type="file" id="formFile">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="mb-7">

                        <!--begin::Col-->
                        <!--begin::Image input placeholder-->
                        <style>
                            .image-input-placeholder {
                                background-image: url('svg/avatars/blank.svg');
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url('svg/avatars/blank-dark.svg');
                            }
                        </style>
                        <!--end::Image input placeholder-->

                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" data-kt-image-input="true"
                            style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                            <!--begin::Image preview wrapper-->
                            <div data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                class="image-input-wrapper w-125px h-125px kt_modal_1 " id="foto-img"
                                style="background-image: url(/assets/media/avatars/300-1.jpg)">
                            </div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow kt_modal_1"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Change avatar">
                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                        class="path2"></span></i>

                                <!--begin::Inputs-->
                                {{-- <button></button> --}}
                                <span></span>
                                <input type="hidden" name="imageSubmit" id="image-submit" />
                                <input type="hidden" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Cancel avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Remove avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                        <!--end::Image input-->
                        <!--end::Col-->

                    </div>
                    <!--end::Row-->
                    <input type="hidden" name="lat" value="" id="lat">
                    <input type="hidden" name="lng" value="" id="lng">


                    <!--begin::Separator-->
                    <div class="separator mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Action buttons-->

                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Batal</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                        <!--end::Button-->
                    </div>
                    <!--end::Action buttons-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ambil Foto</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <video id="video" class="img-fluid w-100" style="height: 300px;"
                                    autoplay></video>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <canvas id="canvas" class="w-100" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary" id="snap">Ambil Gambar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".kt_modal_1").on("click", function() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            const snap = document.getElementById('snap');
            const imageWrapper = document.getElementById('foto-img');
            let stream;
            const imageSubmit = document.getElementById('image-submit');

            // Minta akses ke kamera
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: true
                    })
                    .then(function(mediaStream) {
                        // Akses berhasil, lakukan sesuatu dengan aliran kamera
                        stream = mediaStream;
                        const videoElement = document.getElementById('video');
                        if (videoElement) {
                            videoElement.srcObject = stream;
                        }
                    })
                    .catch(function(error) {
                        console.error('Error accessing the camera:', error);
                    });
            } else {
                console.error('MediaDevices API tidak didukung');
            }

            // Ambil foto saat tombol diklik
            snap.addEventListener('click', () => {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const dataUrl = canvas.toDataURL('image/png');
                imageWrapper.style.backgroundImage = `url(${dataUrl})`;
                imageSubmit.value = dataUrl;
            });

            // Matikan kamera saat modal ditutup
            $('#kt_modal_1').on('hide.bs.modal', function() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            });
        });

        $('#type').change(function(e) {
            var type = $('#type').val();
            if (type == 'Tugas') {
                $('#surat-tugas').show();
            } else {
                $('#surat-tugas').hide();
            }

        });
        //get lokasi
        getLocation()

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                document.getElementById("location").innerText = "Geolocation tidak didukung oleh browser ini.";
            }
        }

        function showPosition(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            $('#lat').val(latitude)
            $('#lng').val(longitude)
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById("location").innerText = "Pengguna menolak permintaan geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById("location").innerText = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    document.getElementById("location").innerText =
                        "Permintaan untuk mendapatkan lokasi melebihi batas waktu.";
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById("location").innerText = "Terjadi kesalahan yang tidak diketahui.";
                    break;
            }
        }
    </script>
</div>
