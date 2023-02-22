<div class="my-4">
    <div class="px-3 py-3 shadow-sm">
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                @if($activeNav === 'Dashboard')
                    <a class="nav-link background_color_primary text-white" aria-current="page" href="{{ url('/control/panel/dashboard') }}"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a>
                @else
                    <a class="nav-link background_color_secondary text-black" aria-current="page" href="{{ url('/control/panel/dashboard') }}"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a>
                @endif
            </li>
            <li class="nav-item mb-3">
                @if($activeNav === 'Essay Log')
                    <a class="nav-link background_color_primary text-white" aria-current="page" href="{{ url('/control/panel/essay/log') }}"><i class="fa-solid fa-book"></i> Essay Log</a>
                @else
                    <a class="nav-link background_color_secondary text-black" aria-current="page" href="{{ url('/control/panel/essay/log') }}"><i class="fa-solid fa-book"></i> Essay Log</a>
                @endif
            </li>
            <li class="nav-item mb-3">
                @if($activeNav === 'Report')
                    <a class="nav-link background_color_primary text-white" aria-current="page" href="javascript:void(0)"><i class="fa-solid fa-book"></i> Report</a>
                @else
                    <a class="nav-link background_color_secondary text-black" aria-current="page" href="javascript:void(0)"><i class="fa-solid fa-book"></i> Report</a>
                @endif
            </li>
        </ul>
    </div>
</div>

