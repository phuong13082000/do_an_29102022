@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    <div class="mt-3">
        <div class="container">
            <h2 class="text-center mb-4">Profile</h2>
            <form method="POST" id="profile_setup_frm" action="#" >
                @csrf
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="p-3 py-5">
                            <div class="row" id="res"></div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="first name" value="{{ $customer->fullname }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Email</label>
                                    <input type="text" id="email" name="email" disabled class="form-control" value="{{ $customer->email }}" placeholder="Email">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ $customer->phone }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" value="{{ $customer->address }}" placeholder="Address">
                                </div>
                            </div>

                            @if($customer->provider == 'facebook')
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Provider</label>
                                        <input type="text" id="provider" name="provider" disabled class="form-control" placeholder="provider" value="{{ $customer->provider }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">ID Facebook</label>
                                        <input type="text" id="facebook_id" name="facebook_id" disabled class="form-control" value="{{ $customer->facebook_id }}" placeholder="facebook_id">
                                    </div>
                                </div>
                            @endif
                            @if($customer->provider == 'google')
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Provider</label>
                                        <input type="text" id="provider" name="provider" disabled class="form-control" placeholder="provider" value="{{ $customer->provider }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">ID Google</label>
                                        <input type="text" id="google_id" name="google_id" disabled class="form-control" value="{{ $customer->google_id }}" placeholder="google_id">
                                    </div>
                                </div>
                            @endif
                            <div class="mt-5 text-center">
                                <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                                <a href="#" type="button" class="btn btn-success">Change Password</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>

                </div>
            </form>
        </div>
    </div>
@endsection
