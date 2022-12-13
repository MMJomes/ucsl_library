
<div class="w3-top">
    <div class="w3-bar w3-black w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"
            href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i
                class="fa fa-bars"></i></a>
        <a href="{{ route('users.totalbook') }}" class="w3-bar-item w3-button w3-padding-large">TOTAL BOOKS</a>
        <a href="{{route('users.rents')}}" class="w3-bar-item w3-button w3-padding-large w3-hide-small">RENTED BOOKS</a>
        <a href="{{route('users.prerequest')}}" class="w3-bar-item w3-button w3-padding-large w3-hide-small">PREQUEST BOOKS</a>
        <a href="{{route('member.profile')}}" class="w3-bar-item w3-button w3-padding-large w3-hide-small">PROFILE</a>

        <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i
                class="fa fa-search"></i></a>
    </div>
</div>
