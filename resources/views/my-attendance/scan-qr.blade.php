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

        <div class="col-12 col-md-7">
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

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // QR Scanner
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


        })
    </script>
@endsection
