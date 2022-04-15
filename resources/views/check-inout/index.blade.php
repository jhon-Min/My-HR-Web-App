@extends('layouts.app-plain')

@section('title')
    Check-in & Check-out
@endsection

@section('head')
    <style>
        .qr-img {
            width: 200px;
        }

    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-8">
            <div class="card mb-3 shadow-sm">
                <div class="card-body text-center">
                    <img src="data:image/png;base64, {!! base64_encode(
    QrCode::format('png')->size(100)->generate($hash_value),
) !!} " class="qr-img">
                    <p class="text-secondary">Please scan QR to check-in and check-out</p>
                </div>
            </div>

            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <h5 class="text-secondary mb-3">Pin Code</h5>
                    <input type="text" name="mycode" id="pincode-input1">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Csrf token
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": token.content,
                },
            });
        } else {
            console.log("csrf token not found");
        }

        $('#pincode-input1').pincodeInput({
            inputs: 6,
            complete: function(value, e, errorElement) {

                $.ajax({
                    url: "{{ route('check.store') }}",
                    method: "POST",
                    data: {
                        "pin_code": value
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

                        $('.pincode-input-container .pincode-input-text').val("");
                        $('.pincode-input-text').first().select().focus();
                    }
                })

                $('.pincode-input-text').first().select().focus();
            }
        });
    </script>
@endsection
