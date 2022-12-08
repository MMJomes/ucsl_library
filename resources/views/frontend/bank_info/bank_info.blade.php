@extends('layouts.front')
<div class="wrapper">
    <div class="inner">
        {{-- <div class="image-holder">

            <img src="{{ url('/assets/frontend/images/registration-form-6.jpg') }}" alt="image">
    </div> --}}
    @csrf
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                <p>{{ $errors->first() }}</p>
            </div>
            @endif
        </div>
    </div>
    <div class="container">
        <h3><b>Bank Information</b></h3>
        <div class="row mx-4 mt-4">
            <div class="col-md-12">
                <h5>
                    <p style='color:red;'>Your Registration Number : <b>{{$data->reg_no}}</b></p>
                </h5>
            </div>
            <div class="col-md-12 mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Name</th>
                            <th scope="col">Account No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><img src="{{ url('/assets/frontend/images/kbz.png') }}" width="50px" height="50px"
                                    alt="Card image cap"> KPAY</td>
                            <td>Aye Aye Aung</td>
                            <td>09767629043</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td><img src="{{ url('/assets/frontend/images/aya.jpg') }}" width="90px" height="90px"
                                    alt="Card image cap"> AYA PAY</td>
                            <td>Aye Aye Aung</td>
                            <td>20086576568767</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <p class="" style="font-weight:bold">Please enter the registration number in the note or description when
                    you transfer the registration fees. <br> Then, Send your payment screenshot to Viber Phone No
                    <span style="font: 20">09xxxxxxxxx</span>
                </p>
            </div>
        </div>
    </div>
</div>
</div>

@section('content')
@endsection