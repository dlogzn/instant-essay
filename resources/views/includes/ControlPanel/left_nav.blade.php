<div class="my-4">
    <div class="px-3 py-3 shadow-sm">
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                @if($activeNav === 'Dashboard')
                    <a class="nav-link background_color_primary text-white" aria-current="page" href="{{ url('/control/panel/dashboard') }}"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a>
                @else
                    <a class="nav-link background_color_secondary text_color_7" aria-current="page" href="{{ url('/control/panel/dashboard') }}"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a>
                @endif
            </li>
        </ul>
    </div>
</div>

