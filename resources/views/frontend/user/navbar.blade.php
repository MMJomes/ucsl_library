@inject('request', 'Illuminate\Http\Request')
<div class="w3-top">
    <div class="w3-bar w3-black w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)"
            onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>

        @if ($request->segment(1) == 'totalbooks')
            <a href="{{ route('users.totalbook') }}" class="w3-bar-item w3-button w3-padding-large" style="background-color: #c0c0c0 !important;color: #00bcd4 !important">TOTAL BOOKS</a>
        @else
            <a href="{{ route('users.totalbook') }}" class="w3-bar-item w3-button w3-padding-large">TOTAL BOOKS</a>
        @endif

        @if ($request->segment(1) == 'totalrent')
            <a href="{{ route('users.rents') }}" class="w3-bar-item w3-button w3-padding-large w3-hide-small" style="background-color: #c0c0c0 !important;color: #00bcd4 !important">RENTED
                BOOKS</a>
        @else
            <a href="{{ route('users.rents') }}" class="w3-bar-item w3-button w3-padding-large w3-hide-small">RENTED
                BOOKS</a>
        @endif
        @if ($request->segment(1) == 'totalreq')
            <a href="{{ route('users.prerequest') }}"
                class="w3-bar-item w3-button w3-padding-large w3-hide-small" style="background-color: #c0c0c0 !important;color: #00bcd4 !important">PREQUEST BOOKS</a>
        @else
            <a href="{{ route('users.prerequest') }}"
                class="w3-bar-item w3-button w3-padding-large w3-hide-small">PREQUEST BOOKS</a>
        @endif
        @if ($request->segment(1) == 'profile')
            <a href="{{ route('member.profile') }}"
                class="w3-bar-item w3-button w3-padding-large w3-hide-small" style="background-color: #c0c0c0 !important;color: #00bcd4 !important">PROFILE</a>
        @else
            <a href="{{ route('member.profile') }}"
                class="w3-bar-item w3-button w3-padding-large w3-hide-small">PROFILE</a>
        @endif
        <a href="https://www.linkedin.com/in/maungmyint/" target="_blank" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i
                class="fa fa-info"></i></a>
    </div>
</div>
