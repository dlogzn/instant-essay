<!doctype html>
<html lang="en">
<head>
    <title>{{ $title }} | {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/images/default/favicon.ico') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/ajax_loading.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/ControlPanel/default.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.1.2/tinymce.min.js"></script>
    <script src="{{ asset('/assets/js/common/ajax_initialization.js') }}"></script>
</head>
<body>

@include('includes.ControlPanel.header')

<div class="container-fluid bg-white">
    <div class="row mb-5">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">

            <div class="row">
                <div class="col-12 col-sm-12 col-md-3">
                    @include('includes.ControlPanel.left_nav')
                </div>

                <div class="col-12 col-sm-12 col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.ControlPanel.footer')

@include('includes.common.ajax_loading')
</body>
</html>



