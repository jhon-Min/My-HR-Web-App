@extends('layouts.app')

@section('title')
    My Attendance
@endsection

@section('content')
    <div class="row ">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">My Attendnce</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        Details
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12 col-md-7 mb-5">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-start">Attendance Scan</h5>
                    <img src="{{ asset('images/qr-2.png') }}" alt="" style="width: 270px">
                    <p class="text-muted">Please Scan Attendance QR</p>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal"
                        data-bs-target="#scanBackdrop">
                        <i class="fa-solid fa-qrcode me-2"></i>
                        Scan QR
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="scanBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="scanBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="scanBackdropLabel">Attendance Scanner</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <video id="vd" class="w-100 h-25"></video>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm dt-card mb-3">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">{{ $user->name }}'s Attendances</h5>
                    <table class="table table-hover table-striped w-100 py-3 att-table" id="dataTable">
                        <thead>
                            <th class="no-sort"></th>
                            <th class="">#</th>
                            <th class="">Name</th>
                            <th class="">Employee ID</th>
                            <th class="">Date</th>
                            <th class="">Check-in</th>
                            <th class="">Check-out</th>
                            <th class="text-center hidden">Updated_at</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // ======== QR Scanner =========
            var videoElem = document.getElementById('vd');
            var videoElem = document.getElementById('vd');
            const qrScanner = new QrScanner(videoElem, function(result) {
                console.log(result);
                if (result) {
                    $('#scanBackdrop').modal('hide')
                    qrScanner.stop();
                    $.ajax({
                        url: "{{ route('my-attendance.storeQr') }}",
                        method: "POST",
                        data: {
                            "hash_value": result
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire({
                                    icon: res.status,
                                    title: res.title,
                                    text: res.message,
                                })
                            } else {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top',
                                    showConfirmButton: false,
                                    timer: 2500,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal.stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: res.status,
                                    title: res.title,
                                })
                            }
                        }
                    })

                }
            });

            $('#scanBackdrop').on('shown.bs.modal', function(event) {
                qrScanner.start();
            })

            $('#scanBackdrop').on('hidden.bs.modal', function(event) {
                qrScanner.stop();
            })

            // ======== Data Table From My Attendance Controller =========
            var table = $('#dataTable').DataTable({
                ajax: '{{ route('my-attendance.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    },
                    {
                        data: 'profile',
                        name: 'profile'
                    },
                    {
                        data: 'employee',
                        name: 'employee'
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'date',
                        name: 'date',
                    },
                    {
                        data: 'check_in',
                        name: 'check_in',
                    },
                    {
                        data: 'check_out',
                        name: 'check_out',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                ],
                order: [
                    [4, "desc"]
                ],
            });
        })
    </script>
@endsection
