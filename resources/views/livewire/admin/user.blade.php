@section('user', 'active')
@section('title', 'User')

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
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-outline ki-badge fs-1 me-2"></i>
                    <h2>Daftar User</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">

                <!--begin::Input wrapper-->
                <div class="w-40">
                    <!--begin::Title-->
                    <h4 class="fs-5 fw-semibold text-gray-800">Filter</h4>
                    <!--end::Title-->
                    <div class="row">
                        <div class="col-md-9 d-flex">
                            <!-- Input dan tombol Tampilkan -->
                            <input type="text" class="form-control form-control-solid me-3 flex-grow-1"
                                placeholder="Nama" wire:model="searchName" />
                            <button class="btn btn-primary fw-bold flex-shrink-0"
                                wire:click="applyFilter">Tampilkan</button>
                        </div>
                        <!-- Tombol tambahan di bawah input dan tombol Tampilkan -->
                        <div class="col-md-3">
                            <button class="btn btn-primary fw-bold flex-shrink-0" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_import" >Import Data User</button>
                        </div>
                    </div>
                </div>
                <!--end::Input wrapper-->


                <br><br>
                <!--begin::Form-->
                <div class="table-responsive">
                    <table id="kt_datatable_horizontal_scroll" class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Pangkat</th>
                                <th>NIP/NRP</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as  $index => $user)
                                <tr>
                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->rank }}</td>
                                    <td>{{ $user->nip }}</td>
                                    <td>{{ $user->position }}</td>
                                    <td>{{ $user->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle btn-sm"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ki-solid ki-gear"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.update.akun', ['id' => $user->id]) }}">Edit</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        wire:click='statusUser({{ $user->id }})'>{{ $user->status ? 'Non Aktif' : 'Aktif' }}</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        wire:click='resetPassword({{ $user->id }})'>Reset
                                                        Password</a></li>
                                                <li><a class="dropdown-item"
                                                        wire:click="selectUser({{ $user->id }})">Ijin / Cuti </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data User belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links('vendor.pagination.bootstrap-5') }}

                </div>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>

    {{-- MODAL iji --}}
    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.leave') }}" method="POST">
                    <div class="modal-header">
                        <h3 class="modal-title text-capitalize ">Permohonan Ijin {{ $selectedUser->name ?? '' }}</h3>
                        @csrf
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <input type="hidden" name="userId" value="{{ $selectedUser->id ?? '' }}">
                    <div class="modal-body">
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Status</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Enter the contact's name."
                                    data-bs-original-title="Enter the contact's name." data-kt-initialized="1">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select" aria-label="pria" name="status">
                                <option selected value="">Pilih</option>
                                <option value="ijin">Ijin</option>
                                <option value="cuti">Cuti</option>
                                {{-- <option value="dik">DIK</option> --}}
                            </select>
                            <!--end::Input-->
                            @error('day')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="kt_td_picker_linked_1_input" class="form-label">Dari</label>
                                <div class="input-group log-event" id="kt_td_picker_linked_1"
                                    data-td-target-input="nearest" data-td-target-toggle="nearest">
                                    <input id="kt_td_picker_linked_1_input" type="text" class="form-control"
                                        data-td-target="#kt_td_picker_linked_1" name="startDate" />
                                    <span class="input-group-text" data-td-target="#kt_td_picker_linked_1"
                                        data-td-toggle="datetimepicker">
                                        <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="kt_td_picker_linked_2_input" class="form-label">Sampai</label>
                                <div class="input-group log-event" id="kt_td_picker_linked_2"
                                    data-td-target-input="nearest" data-td-target-toggle="nearest">
                                    <input id="kt_td_picker_linked_2_input" type="text" class="form-control"
                                        data-td-target="#kt_td_picker_linked_2" name="endDate" />
                                    <span class="input-group-text" data-td-target="#kt_td_picker_linked_2"
                                        data-td-toggle="datetimepicker">
                                        <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- MODAL cuti --}}
    <div class="modal fade" tabindex="-1" id="kt_modal_import">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3 class="modal-title text-capitalize ">Import Data User</h3>
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
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Import File Exsel</label>
                                <input class="form-control" type="file" name="file" id="formFile">
                                <br>
                                <a href="{{ asset('assets/tamplate.xlsx')}}" download>Tamplate Import File User</a>
                              </div>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <!--end::Input-->
                   
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        window.addEventListener('openModal', event => {
            const modal = new bootstrap.Modal(document.getElementById('kt_modal_stacked_1'));
            modal.show();
        });


        const linkedPicker1Element = document.getElementById("kt_td_picker_linked_1");
        const linked1 = new tempusDominus.TempusDominus(linkedPicker1Element, {
            display: {
                components: {
                    clock: false // Hide the clock component
                }
            },
            localization: {
                format: 'yyyy-MM-dd' // Set date format
            }
        });

        const linked2 = new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_linked_2"), {
            useCurrent: false,
            display: {
                components: {
                    clock: false // Hide the clock component
                }
            },
            localization: {
                format: 'yyyy-MM-dd' // Set date format
            }
        });

        // Using event listeners
        linkedPicker1Element.addEventListener(tempusDominus.Namespace.events.change, (e) => {
            console.log('Linked Picker 1 Date:', e.detail.date);
            const selectedDate1 = e.detail.date.toISOString().split('T')[0];
            linked2.updateOptions({
                restrictions: {
                    minDate: e.detail.date,
                },
            });
            $('#kt_td_picker_linked_1_input').val(selectedDate1);

        });

        // Using subscribe method

        const subscription = linked2.subscribe(tempusDominus.Namespace.events.change, (e) => {
            console.log('Linked Picker 2 Date:', e.detail.date);
            const selectedDate2 = e.detail.date.toISOString().split('T')[0];
            linked1.updateOptions({
                restrictions: {
                    maxDate: e.detail.date,
                },
            });
            $('#kt_td_picker_linked_2_input').val(selectedDate2);
        });
    </script>
</div>
