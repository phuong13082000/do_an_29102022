@extends('layout.user')

@section('index')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @include('frontend.includes.alert')

                    <h2>Cảm ơn bạn đã đặt hàng ở chỗ chúng tôi,chúng tôi sẽ liên hệ với bạn sớm nhất</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

