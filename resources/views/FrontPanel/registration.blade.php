@extends('layouts.front_panel')
@section('content')
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                <div class="text-center fs-3 fw-bold mt-4">Welcome to Instant Essay</div>
                <div class="fs-4 text_color_7 text-center">Get registered to get started</div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6 mx-auto">
                        <div class="px-4" style="background-color: rgba(243,243,243,0.61); border-radius: 10px;">
                            <div id="registration_form_message" class="text-center text-danger my-3" style="height: 30px;">
                                @if (Session::has('message'))
                                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                                @endif
                            </div>
                            <form id="registration_form">
                                <div class="row mb-4">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-4 mb-xl-0">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" autocomplete="off">
                                            <label for="name">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-4 mb-xl-0">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Retype Password" autocomplete="off">
                                            <label for="password_confirmation">Retype Password</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="school_attended" id="school_attended" placeholder="What school do you attend?" autocomplete="off">
                                    <label for="school_attended">What school do you attend?</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="about_us" id="about_us" placeholder="How did you hear about us?" autocomplete="off">
                                    <label for="about_us">How did you hear about us?</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms_of_service">
                                    <label class="form-check-label" for="terms_of_service">I agree to Instant Essay <a href="{{ url('/terms-of-service') }}" class="text-decoration-none text_color_default">Terms of Service</a></label>
                                </div>
                                <div class="form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="privacy_policy">
                                    <label class="form-check-label" for="privacy_policy">I accept Instant Essay use of my data for the service and everything else described in the <a href="{{ url('/privacy-policy') }}" class="text-decoration-none text_color_default">Privacy Policy</a></label>
                                </div>
                                <div class="row">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn_default" id="registration_form_submit">
                                            <span id="registration_form_submit_text">Register</span>
                                            <div id="registration_form_submit_processing" class="d-flex align-items-center sr-only">
                                                <span>Processing...</span>
                                                <div class="spinner-border spinner-border-sm ms-auto" role="status" aria-hidden="true"></div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div style="height: 50px;"></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col text-center">
                        <span class="me-3">Have an account with Instant Essay?</span>
                        <a class="btn btn-outline-info" href="{{ url('/login') }}">Log in</a>
                    </div>
                </div>

                <div style="height: 50px;"></div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('submit', '#registration_form', function(event) {
            event.preventDefault();
            $('#registration_form_message').empty();
            $('#registration_form_submit').addClass('disabled');
            $('#registration_form_submit_text').addClass('sr-only');
            $('#registration_form_submit_processing').removeClass('sr-only');
            $('#registration_form').find('.is-invalid').removeClass('is-invalid');
            $('#registration_form').find('.invalid-feedback').remove();
            let formData = new FormData(this);
            formData.append('terms_of_service', $('#terms_of_service').prop('checked'));
            formData.append('privacy_policy', $('#privacy_policy').prop('checked'));
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                method: 'post',
                url: '{{ url('/registration/save') }}',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                global: false,
                success: function (result) {
                    console.log(result);
                    $('#registration_form_submit').removeClass('disabled');
                    $('#registration_form_submit_text').removeClass('sr-only');
                    $('#registration_form_submit_processing').addClass('sr-only');
                    location = '{{ url('/account/panel/essay') }}';
                },
                error: function (xhr) {
                    console.log(xhr);
                    $('#registration_form_submit').removeClass('disabled');
                    $('#registration_form_submit_text').removeClass('sr-only');
                    $('#registration_form_submit_processing').addClass('sr-only');
                    if (xhr.status === 500) {
                        $('#registration_form_message_for_personal_account').text('Internal Server Error!');
                    }
                    if (xhr.status === 422) {
                        if (xhr.responseJSON.hasOwnProperty('errors')) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                if (key === 'terms_of_service' || key === 'privacy_policy') {
                                    $('#' + key).parent().append('<div class="invalid-feedback d-block"></div>');
                                    $.each(value, function (k, v) {
                                        $('#' + key).parent().find('.invalid-feedback').append('<div>' + v + '</div>');
                                    });
                                } else {
                                    $('#' + key).after('<div class="invalid-feedback "></div>');
                                    $('#' + key).addClass('is-invalid');
                                    $.each(value, function (k, v) {
                                        $('#' + key).parent().find('.invalid-feedback').append('<div>' + v + '</div>');
                                    });
                                }
                            });
                        }
                    }
                    if (xhr.status === 400) {
                        $('#registration_form_message_for_personal_account').text(xhr.responseJSON.message);
                    }

                }
            });
        });
    </script>
@endsection
