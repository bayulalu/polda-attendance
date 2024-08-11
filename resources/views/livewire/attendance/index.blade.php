@section('absen-admin', 'active')

<div class=" d-flex flex-column-fluid flex-center">

    <div class="col-xl-8 col-md-10 col-sm-12">

        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
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
    </script>
</div>
