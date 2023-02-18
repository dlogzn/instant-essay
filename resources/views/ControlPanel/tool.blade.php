@extends('layouts.control_panel')

@section('content')
    <div class="mt-4" style="min-height: 500px;">
        <div class="d-flex justify-content-between">
            <div class="h4 fw-bold text_color_7">Tools</div>
            <button type="button" class="btn btn-sm btn_default" id="add_tool">Add</button>
        </div>
        <div class="mt-4" id="tool_content"></div>
    </div>



    <script type="text/javascript">
        $(document).ready(function () {
            getTools();
        });

        function getTools() {
            $.ajax({
                method: 'get',
                url: '{{ url('/control/panel/tool/fetch/records') }}',
                success: function (result) {
                    console.log(result);
                    $('#tool_content').empty();
                    if (result.payload.length > 0) {
                        $.each(result.payload, function (key, value) {
                            $('#tool_content').append(`
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text_color_primary fa-2x me-3">` + value.icon + `</div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text_color_3">` + value.title + `</div>
                                                <div class="text_color_a">` + value.hint + `</div>
                                            </div>
                                        </div>
                                        <div class="mt-4">` + value.prompt + `</div>
                                        <div class="mt-4"><a href="javascript:void(0)" class="text-decoration-none edit_tool" data-id="` + value.id + `">Edit</a> | <a href="javascript:void(0)" class="text-decoration-none text-danger delete_tool" data-id="` + value.id + `">Delete</a></div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#tool_content').append(`
                            <div class="alert alert-warning text-center">No Tool Found!</div>
                        `);
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        }

        $(document).on('click', '#add_tool', function () {
            $('#tool_content').parent().find('#tool_modal').remove();
            $('#tool_content').parent().append(`
                <div class="modal" tabindex="-1" id="tool_modal">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center border-bottom pb-3 border_color_default">
                                    <div class="h4 text_color_7">Prompt Design</div>
                                </div>
                                <form id="tool_form">
                                    <div class="row mb-4">
                                        <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                                <label for="title">Title</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="hint" id="hint" placeholder="Hint">
                                                <label for="hint">Hint</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <textarea class="form-control" name="prompt" id="prompt" placeholder="Prompt" style="min-height: 150px;"></textarea>
                                        <label for="prompt">Prompt</label>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="temperature" id="temperature" placeholder="Temperature">
                                                <label for="temperature">Temperature</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="max_tokens" id="max_tokens" placeholder="Max Tokens">
                                                <label for="max_tokens">Max Tokens</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
                                                <label for="icon">Icon</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6">
                                            <div class="form-floating">
                                                <select class="form-select" name="result_formatting" id="result_formatting">
                                                    <option value="div">In Div</option>
                                                    <option value="table">In Table</option>
                                                </select>
                                                <label for="result_formatting">Result Formatting</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                            <div class="form-floating">
                                                <select class="form-select" name="status" id="status">
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                                <label for="status">status</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" name="narrative" id="narrative" placeholder="Narrative"></textarea>
                                                <label for="narrative">Narrative</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn_default ms-4">Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            `);
            $('#tool_modal').modal('show');
        });

        $(document).on('submit', '#tool_form', function (event) {
            event.preventDefault();
            $('#tool_form_submit').addClass('disabled');
            $('#tool_form_submit_processing').removeClass('sr-only');
            $('#tool_form_submit_text').addClass('sr-only');
            $('#tool_form').find('.is-invalid').removeClass('is-invalid');
            $('#tool_form').find('.invalid-feedback').remove();
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('/control/panel/tool/save/record') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                    $('#tool_form_submit').removeClass('disabled');
                    $('#tool_form_submit_text').removeClass('sr-only');
                    $('#tool_form_submit_processing').addClass('sr-only');
                    $('#tool_modal').modal('hide');
                    getTools();

                    $.toast({
                        heading: 'Success',
                        text : result.payload.message,
                        showHideTransition : 'slide',
                        icon: 'success',
                        hideAfter: 5000,
                        position : 'bottom-right'
                    });
                },
                error: function (xhr) {
                    console.log(xhr);
                    $('#tool_form_submit').removeClass('disabled');
                    $('#tool_form_submit_text').removeClass('sr-only');
                    $('#tool_form_submit_processing').addClass('sr-only');

                    if (xhr.status === 500) {
                        $('#tool_form').prepend('<div class="invalid-feedback d-block mb-4">' + xhr.responseJSON.message + '</div>');
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

        $(document).on('click', '.edit_tool', function () {
            $('#tool_content').parent().find('#tool_modal').remove();
            let toolId = $(this).data('id');
            $.ajax({
                method: 'get',
                url: '{{ url('/control/panel/tool/fetch/record') }}',
                data: {
                    tool_id: toolId
                },
                success: function (result) {
                    console.log(result);
                    $('#tool_content').parent().append(`
                        <div class="modal" tabindex="-1" id="tool_modal">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center border-bottom pb-3 border_color_default">
                                            <div class="h4 text_color_7">Prompt Design</div>
                                        </div>
                                        <form id="tool_form">
                                            <input type="hidden" name="tool_id" value="` + result.payload.id + `">
                                            <div class="row mb-4">
                                                <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                                        <label for="title">Title</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hint" id="hint" placeholder="Hint">
                                                        <label for="hint">Hint</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <textarea class="form-control" name="prompt" id="prompt" placeholder="Prompt" style="min-height: 150px;"></textarea>
                                                <label for="prompt">Prompt</label>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="temperature" id="temperature" placeholder="Temperature">
                                                        <label for="temperature">Temperature</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="max_tokens" id="max_tokens" placeholder="Max Tokens">
                                                        <label for="max_tokens">Max Tokens</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
                                                        <label for="icon">Icon</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="result_formatting" id="result_formatting">
                                                            <option value="div">In Div</option>
                                                            <option value="table">In Table</option>
                                                        </select>
                                                        <label for="result_formatting">Result Formatting</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                                                    <div class="form-floating">
                                                        <select class="form-select" name="status" id="status">
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                        <label for="status">status</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="narrative" id="narrative" placeholder="Narrative"></textarea>
                                                        <label for="narrative">Narrative</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn_default ms-4">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#title').val(result.payload.title);
                    $('#hint').val(result.payload.hint);
                    $('#prompt').val(result.payload.prompt);
                    $('#temperature').val(result.payload.temperature);
                    $('#max_tokens').val(result.payload.max_tokens);
                    $('#icon').val(result.payload.icon);
                    $('#result_formatting').val(result.payload.result_formatting);
                    $('#status').val(result.payload.status);
                    if (result.payload.narrative !== null) {
                        $('#narrative').val(result.payload.narrative);
                    }
                    $('#tool_modal').modal('show');
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        });

        $(document).on('click', '.delete_tool', function () {
            let toolId = $(this).data('id');
            let formData = new FormData();
            formData.append('tool_id', toolId);
            formData.append('_token', '{{ csrf_token() }}');
            $.confirm({
                theme: 'modern',
                title: 'Confirm Delete Item!',
                content: 'Are you sure you want to delete the item?',
                buttons: {
                    cancel: {
                        btnClass: 'btn-green',
                        action: function () {

                        }
                    },
                    yes: {
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                method: 'post',
                                url: '{{ url('/control/panel/tool/delete/record') }}',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (result) {
                                    console.log(result);
                                    $.toast({
                                        heading: 'Success',
                                        text : result.payload.message,
                                        showHideTransition : 'slide',
                                        icon: 'success',
                                        hideAfter: 5000,
                                        position : 'bottom-right'
                                    });
                                    getTools();
                                },
                                error: function (xhr) {
                                    console.log(xhr);
                                }
                            });
                        }
                    },

                }
            });
        });

    </script>

@endsection
