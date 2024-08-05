<!DOCTYPE html>

<html lang="en">

<head>
    <base href="../../../" />
    <title>Login | Polda NTB</title>
    <meta charset="utf-8" />
    <meta name="description" content="Login | Polda NTB" />
    <meta name="keywords" content="Login | Polda NTB" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }} " rel="stylesheet" type="text/css" />
    <style>
        .text-oren{
            color: #ffd808;
        }
    </style>
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
    
    <div class="d-flex flex-column flex-root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('assets/media/auth/bg4.jpg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('assets/media/auth/bg4-dark.jpg');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="#" class="mb-7">
                        <img alt="Logo" src="assets/media/logos/logo.png" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-oren fw-normal m-0">SISTIM MONITORING KEHADIRAN PERSONIL DITRESKRIMSUS POLDA NTB</h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <!--begin::Wrapper-->
                   {{-- your code --}}
                   {{ $slot }}

                    <!--end::Wrapper-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-stack px-lg-10">
                        <!--begin::Languages-->
                        <!--end::Languages-->
                        <!--begin::Links-->
                        <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a href="#">Terms</a>
                            <a href="#" >Plans</a>
                            <a href="#" >Contact Us</a>
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    {{-- <script src="assets/js/custom/authentication/sign-in/general.js"></script> --}}
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    {{-- @livewireScripts --}}

</body>
<!--end::Body-->

</html>
