@section('list-atten', 'active')

<div class="row g-5 gx-xl-10 mb-5 mb-xl-10  justify-content-center align-items-center ">
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
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>List Kehadiran</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <div>
                    <!--begin::Input wrapper-->
                    <div class="w-100">
                        <!--begin::Title-->
                        <h4 class="fs-5 fw-semibold text-gray-800">Filter</h4>
                        <!--end::Title-->

                        <!--begin::Title-->
                        <div class="d-flex">
                            <input type="text" class="form-control form-control-solid me-3 flex-grow-1"
                                name="search" id="kt_daterangepicker_1" />

                            <button class="btn btn-primary fw-bold flex-shrink-0">Tampilkan</button>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Input wrapper-->
                </div>

                <br><br>
                <!--begin::Form-->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th>No</th>
                                <th>Hari/Tgl</th>
                                <th>Type</th>
                                <th>Datang</th>
                                <th>Pulang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($attendances as  $index => $attendance)
                                <tr>

                                    <td>{{ ($attendances->currentPage() - 1) * $attendances->perPage() + $index + 1 }}
                                    </td>
                                    <td>
                                        @php
                                            $date = \Carbon\Carbon::parse($attendance->date);
                                            $date->locale('id');
                                        @endphp
                                        {{ $date->translatedFormat('l, j F Y') }}
                                    </td>
                                    <td>{{ $attendance->type }}</td>
                                    <td>{{ $attendance->check_in ?? '-' }}</td>
                                    <td>{{ $attendance->check_out ?? '-' }}</td>
                                    <td>{{ $attendance->status == 1 ? 'Diterima' : 'Ditolak' }}</td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $attendances->links('vendor.pagination.bootstrap-5') }}

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
        }, function(start, end, label) {
            // Kirim data ke Livewire
            @this.set('startDate', start.format('YYYY-MM-DD'));
            @this.set('endDate', end.format('YYYY-MM-DD'));
        });
    </script>
</div>
