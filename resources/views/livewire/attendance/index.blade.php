@section('absen-admin', 'active')

<div class=" row g-5 gx-xl-10 mb-5 mb-xl-10  justify-content-center align-items-center ">

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

            <div class="d-flex justify-content-end align-items-center" data-bs-toggle="modal"
                data-bs-target="#kt_modal_kehadiran">
                <button class="btn btn-primary btn-sm ms-auto mt-3 me-3">
                    <i class="fa-solid fa-download"></i>
                    Unduh Kehadiran
                </button>
            </div>

            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>List Kehadiran Pegawai</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                {{-- awal --}}
                <div>
                    <!--begin::Input wrapper-->
                    <div class="w-100">
                        <!--begin::Title-->
                        <h4 class="fs-5 fw-semibold text-gray-800">Filter</h4>
                        <!--end::Title-->

                        <!--begin::Title-->
                        <div class="d-flex">
                            <input type="text" class="form-control form-control-solid me-3 flex-grow-1"
                                id="kt_daterangepicker_1" wire:model="searchTerm" />
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
                                <th>Tanggal</th>
                                <th>Type</th>
                                <th>Nama</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($attendances as  $index => $attendance)
                                <tr>
                                    <td>{{ ($attendances->currentPage() - 1) * $attendances->perPage() + $index + 1 }}
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.attendance.detail', ['user_id' => $attendance->user_id]) }}">{{ $attendance->date }}
                                        </a>
                                    </td>
                                    <td>{{ $attendance->type }}</td>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->check_in ?? '-' }}</td>
                                    <td>{{ $attendance->check_out ?? '-' }}</td>
                                    <td>{{ $attendance->status == 1 ? 'Diterima' : 'Ditolak' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle btn-sm"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ki-solid ki-gear"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        wire:click='statusAttendance({{ $attendance->id }})'>{{ $attendance->status == 1 ? 'Tolak' : 'Terima' }}</a>
                                                </li>
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
                    {{ $attendances->links('vendor.pagination.bootstrap-5') }}

                </div>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->

        <div class="modal fade" tabindex="-1" id="kt_modal_kehadiran">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.download') }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title text-capitalize "> Unduh Kehadiran</h3>
                            @csrf
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <div class="modal-body">
                            <div class="fv-row mb-5 fv-plugins-icon-container">
                                <div class="mb-0">
                                    <label class="form-label">Pilih Bulan</label>
                                    <input class="form-control form-control-solid" placeholder="bulan tahun"
                                        id="kt_daterangepicker_3" name="month" />
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Unduh</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css"
            rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    </div>

    <script>
        $('#kt_daterangepicker_1').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 2024,
            maxDate: moment().format('YYYY-MM-DD'),
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start) {
            @this.set('searchTerm', start.format('YYYY-MM-DD'));
        });

        $('#kt_daterangepicker_3').datepicker({
            format: 'yyyy-mm',
            minViewMode: 1,
            startView: 1,
            maxViewMode: 2,
            autoclose: true
        });
    </script>
</div>
