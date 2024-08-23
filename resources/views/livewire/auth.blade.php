<div>
    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
        <!--begin::Form-->
        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" wire:submit="store">
            <!--begin::Heading-->
            <div class="text-center mb-11">
                <!--begin::Title-->
                <h1 class="text-gray-900 fw-bolder mb-3">Login</h1>
                <!--end::Title-->
                <!--begin::Subtitle-->
                <div class="text-gray-500 fw-semibold fs-6">Silahkan Masukan Akun Anda Yang Telah Terdaftar</div>
                <!--end::Subtitle=-->
            </div>
            <!--begin::Heading-->

            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input type="text" placeholder="User/NIP" wire:model="nip" autocomplete="off"
                    class="form-control bg-transparent @error('nip')  is-invalid @enderror " />
                @error('nip')
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <b>*{{ $message }}</b>
                    </div>
                @enderror

                <!--end::Email-->
            </div>

            <!--end::Input group=-->
            <div class="fv-row mb-3">
                <!--begin::Password-->
                <input type="password" placeholder="Password" wire:model="password" autocomplete="off"
                    class="form-control bg-transparent  @error('password')  is-invalid @enderror" />
                @error('password')
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <b>*{{ $message }}</b>
                    </div>
                @enderror
                <!--end::Password-->
            </div>
            <!--end::Input group=-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                <div></div>
                <!--begin::Link-->
                {{-- <a href="authentication/layouts/creative/reset-password.html" class="link-primary">Lupa Password ?</a> --}}
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Submit button-->
            <div class="d-grid mb-10">
                <button type="submit" class="btn btn-primary">
                    <!--begin::Indicator label-->
                    <span wire:loading.remove  class="indicator-label">Masuk</span>
                    <span wire:loading>Tunggu Sebentar...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    <!--end::Indicator progress-->
                </button>
            </div>
            <!--end::Submit button-->
        </form>
        <!--end::Form-->
    </div>

    {{-- <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('redirect', function (data) {
                window.location.href = data.url;
            });
        });
    </script> --}}
    
</div>
