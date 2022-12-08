@extends('layouts.front')
<div class="wrapper">
    <div class="inner" style="color:black">
        <div class="image-holder">
            <img src="{{ url('/assets/images/logo.jpg') }}" alt="image" class="image-responsive" width="100" height="100" style="object-fit: cover" >
        </div>
        <form method="POST" action="#" class="needs-validation" novalidate>
            @csrf
            <center>
                <h3>
                    <p>UCSL LOIKAW</p>
                </h3>
            </center>
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-8 my-3" style="margin-right:30px">
                        @if ($errors->any())
                            <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                <p>{{ $errors->first() }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="reg_no">Registration Number :</label>
                            <input type="text" class="form-control" name="reg_no" id="reg_no"
                                placeholder="reg_no" value="Hello" readonly>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="name">Name : </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                value="{{ old('name') }}" required>
                            <div class="invalid-feedback">
                                Please provide a Name.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="name">Email : </label>
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Please provide a Email.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="phone">Phone : </label>
                            <input type="tel"  min="9" maxlength="11" class="form-control" name="phone" id="phone" onkeypress="return isNumber(event);"
                                placeholder="09xxxxxx" value="{{ old('phone') }}" required pattern="/^\d{10}$/[097]{9}|[0-99]{9}|[0-96]{9}|[0-96]{11}|[095]{9}">
                                <div class="invalid-feedback">
                                Please provide a Phone Number(Eg: 09xxxxxx).
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="member_id">Member ID :(optional)</label>
                            <input type="text" class="form-control" name="member_id" placeholder="member_id"
                                value="{{ old('member_id') }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="no_ticket">Number of Ticket</label>
                            <input type="number" class="form-control" name="no_ticket" placeholder="number of ticket"
                                value="{{ old('no_ticket') }}" required>
                            <div class="invalid-feedback">
                                Please provide a Number of Ticket.
                            </div>
                        </div>
                    </div>
                </div>
                <p>Powered By Maung Myint</p>
            </div>
            <br>
            <button>Register
                <i class="zmdi zmdi-long-arrow-right"></i>
            </button>
        </form>

    </div>
</div>

@section('content')
@endsection
<script type="text/javascript">
function isNumber(e){
    e = e || window.event;
    var charCode = e.which ? e.which : e.keyCode;
    return /\d/.test(String.fromCharCode(charCode));
}
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'





        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')


        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
