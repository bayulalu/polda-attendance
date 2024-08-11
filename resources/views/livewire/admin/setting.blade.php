@section('setting', 'active')

<div class="row g-5 gx-xl-10 mb-5 mb-xl-10  justify-content-center align-items-center ">
    <div class="col-xl-8 col-md-10 col-sm-12">

        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>Pengaturan Jam Kerja</h2>
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
                                <th>No</th>
                                <th>Hari</th>
                                <th>Datang</th>
                                <th>Pulang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($settings as  $index => $setting)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{ucwords($setting->day)}}</td>
                                    <td>{{$setting->time_arrival}}</td>
                                    <td>{{$setting->time_gohome}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle btn-sm"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ki-solid ki-gear"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('admin.setting.edit', ['id'=> $setting->id]) }}">Edit</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data belum Tersedia.
                                </div>
                            @endforelse
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
