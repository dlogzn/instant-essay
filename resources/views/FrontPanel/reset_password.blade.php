@extends('layouts.front_panel')
@section('content')

    <div class="container-fluid bg-white">
        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto" id="main_content">
                <div class="text-center mt-5 mb-3">
                    <img src="{{ asset('/storage/images/default/icons8-reset-password-100.png') }}">
                </div>
                <div class="text-center border-bottom pb-3" style="border-color: #e8f3ed !important;">
                    <div class="h4 text_color_5">
                        Almost done. Let's create your new password.
                    </div>

                </div>

                <div class="row">
                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-4 col-xxl-4 mx-auto">
                        <div class="my-4 text-center  text_color_5">
                            We sent a verification code to your email address. Please check your email inbox and enter the code you received, and create new password in the form below to set your new password.
                        </div>
                        <div id="resetting_password_form_message" class="text-center text-danger " style="height: 30px;"></div>
                        <form id="resetting_password_form">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" name="verification_code" id="verification_code" placeholder="Verification Code">
                                <label for="verification_code">Verification Code</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                <label for="password">New Password</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Retype Password">
                                <label for="password_confirmation">Retype Password</label>
                            </div>
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn_default" id="resetting_password_form_submit">
                                    <span id="resetting_password_form_submit_text">Continue</span>
                                    <div id="resetting_password_form_submit_processing" class="d-flex align-items-center sr-only">
                                        <span>Processing...</span>
                                        <div class="spinner-border spinner-border-sm ms-auto" role="status" aria-hidden="true"></div>
                                    </div>
                                </button>
                            </div>
                            <div class="my-5 text-center">
                                <span class="me-3" style="font-size: 14px;">Didn't you get the code?</span>
                                <a class="btn btn-outline-info" href="javascript:void(0)" id="resend_verification_code">Resend</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>






    <script type="text/javascript">



        $(document).on('click', '#resend_verification_code', function () {
            $.ajax({
                method: 'get',
                url: '{{ url('/reset-password/resend/verification/code') }}',
                data: {
                    verification_token: '{{ $verificationToken }}'
                },
                success: function (result) {
                    $.toast({
                        heading: 'Success',
                        text : 'Verification Code has been resent successfully. Please check your email inbox.',
                        showHideTransition : 'slide',
                        icon: 'success',
                        hideAfter: 5000,
                        position : 'bottom-right'
                    });
                },
                error: function (xhr) {
                    if (xhr.status === 500) {
                        $.toast({
                            heading: 'Error',
                            text : 'Internal server error.',
                            showHideTransition : 'slide',
                            icon: 'error',
                            hideAfter: 5000,
                            position : 'bottom-right'
                        });
                    }
                }
            });
        });


        $(document).on('submit', '#resetting_password_form', function(event) {

            event.preventDefault();
            $('#resetting_password_form_submit').addClass('disabled');
            $('#resetting_password_form_submit_text').addClass('sr-only');
            $('#resetting_password_form_submit_processing').removeClass('sr-only');
            $('#resetting_password_form_message').empty();
            $('#resetting_password_form').find('.is-invalid').removeClass('is-invalid');
            $('#resetting_password_form').find('.invalid-feedback').remove();

            let formData = new FormData(this);
            formData.append('verification_token', '{{ $verificationToken }}');
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                method: 'post',
                url: '{{ url('/reset-password/verify') }}',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                global: false,
                success: function (result) {
                    console.log(result);
                    $('#resetting_password_form_submit').removeClass('disabled');
                    $('#resetting_password_form_submit_text').removeClass('sr-only');
                    $('#resetting_password_form_submit_processing').addClass('sr-only');
                    $('#resetting_password_form').trigger('reset');
                    $.toast({
                        heading: 'Success',
                        text : 'Your new password has been set successfully. Redirecting to Sign in shortly...',
                        showHideTransition : 'slide',
                        icon: 'success',
                        hideAfter: 5000,
                        position : 'bottom-right'
                    });
                    setTimeout(function () {
                        location = '{{ url('/login') }}';
                    }, 1000);

                },
                error: function (xhr) {
                    console.log(xhr);
                    $('#resetting_password_form_submit').removeClass('disabled');
                    $('#resetting_password_form_submit_text').removeClass('sr-only');
                    $('#resetting_password_form_submit_processing').addClass('sr-only');
                    if (xhr.status === 500) {
                        $('#resetting_password_form_message').text('Internal server error.');
                    }
                    if (xhr.status === 422) {
                        if (xhr.responseJSON.hasOwnProperty('errors')) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('#' + key).after('<div class="invalid-feedback "></div>');
                                $('#' + key).addClass('is-invalid');
                                $.each(value, function (k, v) {
                                    $('#' + key).parent().find('.invalid-feedback').append('<div>' + v + '</div>');
                                });
                            });
                        }
                    }
                }
            });

        });
    </script>
@endsection
