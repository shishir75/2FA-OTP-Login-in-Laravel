@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter OTP</div>

                <div class="card-body">
                    <form action="/verifyOTP" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="otp">Your OTP</label>
                            <input type="text" class="form-control" name="otp" id="otp" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

