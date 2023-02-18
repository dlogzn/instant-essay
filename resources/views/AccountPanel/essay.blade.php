@extends('layouts.account_panel')

@section('content')

    <div class="row my-4">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
            <div class="fs-3 border-bottom pb-2 border_color_default fw-bold text-center text_color_default">
                Never write an essay again.
            </div>
            <div class="row mt-4">
                <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-6 col-xxl-5 mx-auto">
                    <form id="essay_form">
                        <div class="mb-4">
                            <label for="topic" class="form-label">
                                <div class="text_color_default fw-bold fs-4">Essay Topic</div>
                                <div class="text_color_default">Make it as detailed as you want.</div>
                            </label>
                            <textarea class="form-control border_color_primary" id="topic" name="topic" rows="5" placeholder="Summary of The Great Gatspy"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="length" class="form-label">
                                <div class="text_color_default fw-bold fs-4">Essay Length</div>
                                <div class="text_color_default">How many words?</div>
                            </label>
                            <input type="text" class="form-control border_color_primary" id="length" name="length" placeholder="500">
                        </div>
                        <div class="text-end">
                            <button type="submit" id="essay_form_submit" class="btn btn_default fs-5">
                                <span id="essay_form_submit_text">Write My Essay</span>
                                <div id="essay_form_submit_processing" class="d-flex align-items-center sr-only">
                                    <span>Please wait...</span>
                                    <div class="spinner-border spinner-border-sm ms-auto" role="status" aria-hidden="true"></div>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-5 p-3" id="api_response" style="min-height: 100px;">

            </div>
        </div>
    </div>

    <div class="modal" id="usage_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mt-4 text-center fs-1 fw-bold fst-italic" style="color: #00afef;"><div>Welcome to</div><div style="margin-top: -15px;">Instant Essay!</div></div>
                    <div class="mt-4 mb-3 text-center fs-4 fw-bold text_color_default">To get your essay, simply:</div>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Answer 2 questions on the form</li>
                    </ul>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Click "Write My Essay"</li>
                    </ul>
                    <div class="mt-4 mb-3 text-center fs-4 fw-bold text_color_default">Remember:</div>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Our Technology is still in beta testing</li>
                    </ul>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">Load time can be up to 30 seconds</li>
                    </ul>
                    <ul class="background_color_primary text_color_default">
                        <li class="fs-5">The max length is 500 words. If you need longer than that, you will have to break it up. (i.e. Intro about To Kill a Mockingbird, conclusion about To Kill a Mockingbird, etc.)</li>
                    </ul>
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

        function copyToClipboard(element) {
            let $temp = $('<input>');
            $('body').append($temp);
            $temp.val($(element).text()).select();
            document.execCommand('copy');
            $temp.remove();

        }

        $(document).on('submit', '#essay_form', function (event) {
            event.preventDefault();
            $('#essay_form_submit').addClass('disabled');
            $('#essay_form_submit_processing').removeClass('sr-only');
            $('#essay_form_submit_text').addClass('sr-only');
            $('#essay_form').find('.is-invalid').removeClass('is-invalid');
            $('#essay_form').find('.invalid-feedback').remove();
            $('#api_response').removeClass('background_color_secondary').empty();
            $('#api_response').addClass('background_color_secondary').append(`
                <div class="text-center">Please wait while we are writing your awesome essay.</div>
                <div class="text-center">Thank you for your patience.</div>
            `);
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('/account/panel/essay/write') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                    $('#essay_form_submit').removeClass('disabled');
                    $('#essay_form_submit_text').removeClass('sr-only');
                    $('#essay_form_submit_processing').addClass('sr-only');
                    if (result.payload.response.hasOwnProperty('choices')) {
                        let apiResponse = result.payload.response.choices[0].text.split('\n');
                        $('#api_response').empty().append(`
                            <div class="d-flex justify-content-between mb-4">
                                <div><i class="fa-regular fa-copy fa-2x text_color_default" id="copy_to_clipboard" data-clipboard-target="#response_text" style="cursor: pointer;"></i></div>
                                <div>
                                    <i class="fa-regular fa-star fa-2x text_color_default"></i>
                                    <i class="fa-regular fa-star fa-2x text_color_default"></i>
                                    <i class="fa-regular fa-star fa-2x text_color_default"></i>
                                    <i class="fa-regular fa-star fa-2x text_color_default"></i>
                                    <i class="fa-regular fa-star fa-2x text_color_default"></i>
                                </div>
                            </div>
                            <div class="mt-4 fs-5" id="response_text"></div>
                        `);
                        $.each(apiResponse, function (key, row) {
                            if (row === '') {
                                $('#response_text').append('<div class="mb-3"></div>');
                            } else {
                                if (row !== '' && row !== undefined) {
                                    $('#response_text').append('<div class="mb-1">' + row + '</div>');
                                }
                            }
                        });
                        $('#copy_to_clipboard').tooltip();
                    }
                    if (result.payload.response.hasOwnProperty('error')) {
                        $('#api_response').empty().append(`
                            <div class="text-center text-danger fs-5">
                                ` + result.payload.response.error.message + `
                            </div>
                        `);
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    $('#essay_form_submit').removeClass('disabled');
                    $('#essay_form_submit_text').removeClass('sr-only');
                    $('#essay_form_submit_processing').addClass('sr-only');
                    $('#api_response').empty().removeClass('background_color_secondary');
                    if (xhr.status === 524) {
                        $('#essay_form').prepend('<div class="invalid-feedback d-block mb-4">Request not completed</div>');
                    }
                    if (xhr.status === 500) {
                        $('#essay_form').prepend('<div class="invalid-feedback d-block mb-4">' + xhr.responseJSON.message + '</div>');
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

        let clipboard = new ClipboardJS('#copy_to_clipboard');

        clipboard.on('success', function(e) {
            $.toast({
                heading: 'Success',
                text : 'Copied to Clipboard Successfully',
                showHideTransition : 'slide',
                icon: 'success',
                hideAfter: 5000,
                position : 'bottom-right'
            });
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            $.toast({
                heading: 'Error',
                text : 'Copying to Clipboard Failed',
                showHideTransition : 'slide',
                icon: 'error',
                hideAfter: 5000,
                position : 'bottom-right'
            });
        });


    </script>

@endsection
