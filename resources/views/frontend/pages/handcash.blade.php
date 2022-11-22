@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h2>Cảm ơn bạn đã đặt hàng ở chỗ chúng tôi,chúng tôi sẽ liên hệ với bạn sớm nhất</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

