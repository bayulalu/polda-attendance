@section('absen-admin', 'active')

<div class=" row g-5 gx-xl-10 mb-5 mb-xl-10  justify-content-center align-items-center ">

    <div class="col-xl-8 col-md-10 col-sm-12">

        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>Kehadiran Pegawai {{$attendances->first()->user->name}}</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                {{-- awal --}}
                {{-- <div>
                    <!--begin::Input wrapper-->
                    <div class="w-100">
                        <!--begin::Title-->
                        <h4 class="fs-5 fw-semibold text-gray-800">Filter</h4>
                        <!--end::Title-->

                        <!--begin::Title-->
                      
                        <!--end::Title-->
                    </div>
                    <!--end::Input wrapper-->
                </div>

                <br><br> --}}
                <!--begin::Form-->
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Type</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                                <th>Surat Tugas</th>
                                <th>Foto</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($attendances as  $index => $attendance)
                                <tr>
                                    <td>{{ ($attendances->currentPage() - 1) * $attendances->perPage() + $index + 1 }}
                                    </td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>{{ $attendance->type }}</td>
                                    <td>{{ $attendance->check_in ?? '-' }}</td>
                                    <td>{{ $attendance->check_out ?? '-' }}</td>
                                    <td>{{ $attendance->file_assignment ?? '-' }}</td>
                                    <td><img width="30" src="{{ asset('/assets/media/avatars/300-1.jpg') }}" alt=""></td>
                                    <td>{{ $attendance->status == 1 ? 'Diterima' : 'Ditolak' }}</td>
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

</div>
