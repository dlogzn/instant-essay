@extends('layouts.front_panel')
@section('content')

    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                <div class="text-center mt-5 mb-3">
                    <img src="{{ asset('/storage/images/default/icons8-forgot-password-100.png') }}">
                </div>

                <div class="text-center border-bottom pb-3" style="border-color: #e8f3ed !important;">
                    <div class="h4 text_color_5">
                        Let's reset your password.
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                        <div class="my-4 text-center  text_color_5">
                            Please enter your email address in the form below to start resetting process.
                        </div>
                        <div id="forgot_password_form_message" class="text-center text-danger " style="height: 30px;"></div>
                        <form id="forgot_password_form">
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                <label for="email">Email</label>
                            </div>
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn_default" id="forgot_password_form_submit">
                                    <span id="forgot_password_form_submit_text">Continue</span>
                                    <div id="forgot_password_form_submit_processing" class="d-flex align-items-center sr-only">
                                        <span>Processing...</span>
                                        <div class="spinner-border spinner-border-sm ms-auto" role="status" aria-hidden="true"></div>
                                    </div>
                                </button>
                            </div>
                            <div class="my-5 text-center">
                                <span class="me-3">I have my sign in credentials.</span>
                                <a class="btn btn-outline-info" href="{{ url('/login') }}">Log in</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).on('submit', '#forgot_password_form', function(event) {

            event.preventDefault();
            $('#forgot_password_form_submit').addClass('disabled');
            $('#forgot_password_form_submit_text').addClass('sr-only');
            $('#forgot_password_form_submit_processing').removeClass('sr-only');
            $('#forgot_password_form_message').empty();

            let formData = new FormData(this);

            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                method: 'post',
                url: '{{ url('/forgot-password/verify') }}',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                global: false,
                success: function (result) {
                    console.log(result);
                    $('#forgot_password_form_submit').removeClass('disabled');
                    $('#forgot_password_form_submit_text').removeClass('sr-only');
                    $('#forgot_password_form_submit_processing').addClass('sr-only');
                    location = '{{ url('/reset-password') }}/' + result.payload.verification_token;
                },
                error: function (xhr) {
                    console.log(xhr);
                    $('#forgot_password_form_submit').removeClass('disabled');
                    $('#forgot_password_form_submit_text').removeClass('sr-only');
                    $('#forgot_password_form_submit_processing').addClass('sr-only');
                    if (xhr.status === 500) {
                        $('#forgot_password_form_message').text('Internal server error.');
                    }
                    if (xhr.status === 422) {
                        $('#forgot_password_form_message').text('No account found associated with your provided email address!');
                    }
                }
            });

        });
    </script>
@endsection
