<div class=" d-flex flex-column-fluid flex-center">

    <div class="col-xl-8 col-md-10 col-sm-12">

        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>Pengatuan Jam Kerja</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th>Hari</th>
                                <th>Datang</th>
                                <th>Pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Senin, Selasa</td>
                                <td>08:00</td>
                                <td>17:00</td>
                            </tr>
                          
                            <tr>
                                <td>Jumat</td>
                                <td>09:00</td>
                                <td>17:00</td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>
    <script>
        $("#kt_daterangepicker_1").daterangepicker({
            startDate: moment().subtract(7, 'days'),
            endDate: moment(),
            maxDate: moment(),
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>
</div>
