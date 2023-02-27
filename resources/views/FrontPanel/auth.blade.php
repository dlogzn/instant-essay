@extends('layouts.front_panel')
@section('content')
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                <div class="text-center fs-3 fw-bold mt-4">Welcome to Instant Essay</div>
                <div class="fs-4 text_color_7 text-center">Log in to get started</div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                        <div class="px-4" style="background-color: rgba(243,243,243,0.61); border-radius: 10px;">
                            <div id="sign_in_form_message" class="text-center text-danger my-3" style="height: 30px;">
                                @if (Session::has('message'))
                                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                                @endif
                            </div>
                            <form id="sign_in_form">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
                                    <label for="password">Password</label>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="remember_me">
                                            <label class="form-check-label" for="remember_me">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col text-end" style="font-size: 14px;">
                                        <a href="{{ url('/forgot-password') }}" class="text-decoration-none" style="color: #636363;">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn_default" id="sign_in_form_submit">
                                            <span id="sign_in_form_submit_text">Log in</span>
                                            <div id="sign_in_form_submit_processing" class="d-flex align-items-center sr-only">
                                                <span>Processing...</span>
                                                <div class="spinner-border spinner-border-sm ms-auto" role="status" aria-hidden="true"></div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-4"><div class="horizontal_line_with_words">Or</div></div>
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-6 mb-4 mb-md-0">
                                    <div class="d-grid">
                                        <a href="{{ url('/auth/google') }}" class="btn_google text-center">
                                            <img alt="Google" src="{{ asset('/storage/images/default/icons8-google-48.png') }}" style="height: 30px;">
                                            <span class="ms-2">Continue with Google</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="d-grid">
                                        <a href="{{ url('/auth/facebook') }}" class="btn_facebook text-center">
                                            <img alt="Facebook" src="{{ asset('/storage/images/default/icons8-facebook-circled-48.png') }}" style="height: 30px;">
                                            <span class="ms-2">Continue with Facebook</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 50px;"></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col text-center">
                        <span class="me-3">Need an account with Instant Essay?</span>
                        <a class="btn btn-outline-info" href="{{ url('/registration') }}">Register</a>
                    </div>
                </div>

                <div style="height: 50px;"></div>

            </div>
        </div>
    </div>

    <div class="modal" id="usage_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mt-4 text-center fs-1 fw-bold fst-italic" style="color: #00afef;"><div>Welcome to</div><div style="margin-top: -15px;">Instant Essay!</div></div>
                    <div class="mt-4 mb-3 text-center fs-4 fw-bold text_color_default">Capabilities:</div>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Writes complete essay in under 30 seconds</li>
                    </ul>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Never writes the same essay twice</li>
                    </ul>
                    <div class="mt-4 mb-3 text-center fs-4 fw-bold text_color_default">Remember:</div>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Our Technology is still in beta testing</li>
                    </ul>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Load time can be up to 30 seconds</li>
                    </ul>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Max essay length is 500 words</li>
                    </ul>
                    <div class="p-3 mt-4 rounded" style="background-color: #a1c6d5;">
                        <div class="text-center fs-4 fw-bold text_color_default">Instant Essay 2.0 is coming soon!</div>
                        <ul class="text_color_default">
                            <li class="fs-5">Essays with more than 500 words</li>
                            <li class="fs-5">Improved user interface</li>
                        </ul>
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <button type="button" class="btn btn_secondary fst-italic fs-5" data-bs-dismiss="modal">Get Started</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#usage_modal').modal('show');

        });

        $(document).on('submit', '#sign_in_form', function(event) {
            event.preventDefault();
            $('#sign_in_form_submit').addClass('disabled');
            $('#sign_in_form_submit_processing').removeClass('sr-only');
            $('#sign_in_form_submit_text').addClass('sr-only');
            $('#sign_in_form_message').empty();

            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('remember_me', $('#remember_me').prop('checked') ? 1 : 0);

            $.ajax({
                method: 'post',
                url: '{{ url('/login/authenticate') }}',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                global: false,
                success: function (result) {
                    console.log(result);
                    $('#sign_in_form_submit').removeClass('disabled');
                    $('#sign_in_form_submit_text').removeClass('sr-only');
                    $('#sign_in_form_submit_processing').addClass('sr-only');
                    location = '{{ url('/account/panel/essay') }}';
                },
                error: function (xhr) {
                    console.log(xhr);
                    $('#sign_in_form_submit').removeClass('disabled');
                    $('#sign_in_form_submit_text').removeClass('sr-only');
                    $('#sign_in_form_submit_processing').addClass('sr-only');
                    if (xhr.status === 500) {
                        $('#sign_in_form_message').text('Internal Server Error!');
                    }
                    if (xhr.status === 422 || xhr.status === 401) {
                        $('#sign_in_form_message').text('Unauthorized Access!');
                    }

                }
            });
        });
    </script>
@endsection
