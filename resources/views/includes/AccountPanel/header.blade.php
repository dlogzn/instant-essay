<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
            <div class="d-flex justify-content-between py-2">
                <a href="{{ url('/') }}"><span style="cursor: pointer; height: 30px;"><img src="{{ asset('/storage/images/default/logo.png') }}" height="100"></span></a>
                <div class="dropdown d-flex align-items-center">
                    <button class="dropdown-toggle user_dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: transparent; border: 0;">
                        <div class="d-flex align-items-center" style="padding-right: 5px; border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-top-left-radius: 15px; border-bottom-left-radius: 15px; box-shadow: 0px 0px 5px 0px rgba(192,201,197,0.58);">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('/storage/images/default/icons8-user-30.png') }}" style="height: 30px; width: 30px;">
                            </div>
                            <div class="flex-grow-1 text_color_default text-uppercase ms-1" style="font-size: 10px;">
                                {{ auth()->user()->name }}
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu">
                        <li><h6 class="dropdown-header billing">My Account</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item billing text_color_default" href="{{ url('/account/panel/logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


