@section('user', 'active')
@section('title', 'User')

<div class="row g-5 gx-xl-10 mb-5 mb-xl-10  justify-content-center align-items-center ">

    <div class="col-xl-8 col-md-10 col-sm-12">
        <div class="card card-flush h-lg-100" id="kt_contacts_main">

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
                        <h2>Daftarkan User</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-5">
                    <!--begin::Form-->
                    <form id="kt_ecommerce_settings_general_form"
                        class="form fv-plugins-bootstrap5 fv-plugins-framework" wire:submit="store">
                        <!--begin::Input group-->


                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <!--begin::Label-->
                            <div class="">
                                <label for="exampleFormControlInput1" class="required form-label">NIP</label>
                                <input type="number" class="form-control" wire:model="nip" />
                            </div>

                            @error('nip')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <!--begin::Label-->
                            <div class="">
                                <label for="exampleFormControlInput1" class="required form-label">Nama</label>
                                <input type="text" class="form-control" wire:model="name" />
                            </div>

                            <!--end::Input-->
                            @error('name')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <!--begin::Label-->
                            <div class="">
                                <label for="exampleFormControlInput1" class="required form-label">Pangkat</label>
                                <input type="text" class="form-control" wire:model="rank" />
                            </div>

                            <!--end::Input-->
                            @error('position')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <!--begin::Label-->
                            <div class="">
                                <label for="exampleFormControlInput1" class="required form-label">Jabatan</label>
                                <input type="text" class="form-control" wire:model="position" />
                            </div>

                            <!--end::Input-->
                            @error('position')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <!--begin::Separator-->
                        <div class="separator mb-6"></div>
                        <!--end::Separator-->
                        <!--begin::Action buttons-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <button type="reset" data-kt-contacts-type="cancel"
                                class="btn btn-light me-3">Batal</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Simpan</span>
                                <span class="indicator-progress" wire:loading> Menyimpan user...
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



</div>
