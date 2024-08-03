<style>
    #surat-tugas{
        display: none;
    }

</style>

<div class=" d-flex flex-column-fluid flex-center">

    <div class="col-xl-8 col-md-10 col-sm-12">

        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>Silahkan Isi Kehadiran Anda</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <form id="kt_ecommerce_settings_general_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    action="#">
                    <!--begin::Input group-->

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
                        <select class="form-select" aria-label="Select example" id="type">
                            <option value="Ditempat">Ditempat</option>
                            <option value="Tugas Luar Kantor">Tugas Luar Kantor</option>
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
                            <span>Upload Surat Tugas</span>
                            <span class="ms-1" data-bs-toggle="tooltip"
                                aria-label="Enter the contact's company name (optional)."
                                data-bs-original-title="Enter the contact's company name (optional)."
                                data-kt-initialized="1">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control" type="file" id="formFile">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Row-->

                    <!--end::Row-->
                    <!--begin::Row-->
                    {{-- PERTIMBANGAN --}}
                    {{-- <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>Surat Tugas</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        aria-label="Enter the contact's city of residence (optional)."
                                        data-bs-original-title="Enter the contact's city of residence (optional)."
                                        data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" type="file" id="formFile">

                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Country</span>
                                </label>
                                <!--end::Label-->
                                <div class="w-100">
                                    <!--begin::Select2-->
                                    <input class="form-control" type="file" id="formFile">

                                    <!--end::Select2-->
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div> --}}
                    <!--end::Row-->

                    <!--begin::Row-->
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
                                {{-- <input type="file" name="avatar" accept=".png, .jpg, .jpeg" /> --}}
                                <input type="hidden" name="avatar_remove" />
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


                    <!--begin::Separator-->
                    <div class="separator mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Action buttons-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Batal</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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
                            <div class="col-md-6">
                                <video id="video" width="450" height="480" autoplay></video>
                            </div>
                            <div class="col-md-6">
                                <canvas id="canvas" width="450" height="350" style="padding-top: 70px"></canvas>
                            </div>
                        </div>


                        {{-- <video id="video" width="450" height="480" autoplay></video> --}}
                        {{-- <button id="snap">Snap Photo</button> --}}
                        {{-- <canvas id="canvas" width="640" height="480"></canvas> --}}
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
                console.log(dataUrl);
                imageWrapper.style.backgroundImage = `url(${dataUrl})`;
            });

            // Matikan kamera saat modal ditutup
            $('#kt_modal_1').on('hide.bs.modal', function() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            });
        });

        $('#type').change(function (e) { 
            var type = $('#type').val();
            if (type == 'Tugas Luar Kantor') {
                $('#surat-tugas').show();
            }else{
                $('#surat-tugas').hide();
            }
            
        });

    </script>
</div>
