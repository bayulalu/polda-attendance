<div class=" d-flex flex-column-fluid flex-center">

    <div class="col-xl-8 col-md-10 col-sm-12">
        @if (session('success'))
            <!--begin::Alert-->
            <div class="alert alert-success  d-flex align-items-center p-5">
                <!--begin::Icon-->
                <i class="ki-duotone ki-double-check  fs-2hx text-success me-4 ">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <span>{{ session('success') }}.</span>
                </div>
                <!--end::Wrapper-->
            </div>
        @endif

        <!--end::Alert-->
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>Edit Pengaturan</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <form id="kt_ecommerce_settings_general_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    wire:submit="update">
                    <!--begin::Input group-->
                       <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label">
                            <span class="required">Hari</span>
                            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Enter the contact's name."
                                data-bs-original-title="Enter the contact's name." data-kt-initialized="1">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" aria-label="pria" wire:model="day" disabled>
                            <option value="">Pilih</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>
                        <!--end::Input-->
                        @error('day')
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <div class="row">
                        <div class="col-md-6">

                            <div class="fv-row mb-5 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <div class="">
                                    <label for="exampleFormControlInput1" class="required form-label">Jam
                                        Masuk</label>
                                    <input type="text" class="form-control" wire:model="time_arrival" id="kedatangan" />
                                </div>

                                <!--end::Input-->
                                @error('time_arrival')
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <div class="">
                                    <label for="exampleFormControlInput1" class="required form-label">Jam
                                        Pulang</label>
                                    <input type="text" class="form-control" wire:model="time_gohome" id="pulang" />
                                </div>

                                <!--end::Input-->
                                @error('time_gohome')
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                    </div>



                    

                    <!--begin::Separator-->
                    <div class="separator mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Action buttons-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Batal</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove>Update</span>
                            <span class="indicator-progress" wire:loading> Merubah data...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        

                            
                        </div>
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

    <script>
        flatpickr("#kedatangan", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: "{{$time_arrival}}"
        });


        flatpickr("#pulang", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: "{{$time_gohome}}"
        });
    </script>
</div>
