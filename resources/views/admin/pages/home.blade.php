@extends('layout.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>

                        <div class="card-body">
                            <section class="content">
                                <div class="container-fluid">
                                    <h5 class="mb-2"></h5>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Message</span>
                                                    <span class="info-box-number">
                                                        @if($count_message_db == 0 || NULL)
                                                            0
                                                        @else
                                                            {{$count_message_db}}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Order</span>
                                                    <span class="info-box-number">
                                                        @if($count_order == 0 || NULL)
                                                            0
                                                        @else
                                                            {{$count_order}}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Customer</span>
                                                    <span class="info-box-number">
                                                        @if($count_customer == 0 || NULL)
                                                            0
                                                        @else
                                                            {{$count_customer}}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Product</span>
                                                    <span class="info-box-number">
                                                        @if($count_product == 0 || NULL)
                                                            0
                                                        @else
                                                            {{$count_product}}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="card-body">
                            <section class="content">
                                <div class="container-fluid">
                                    <h5 class="mb-2"></h5>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">All Price Ship</span>
                                                    <span class="info-box-number">{{ number_format($count_priceShip, 0, '') }} VND</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">All Price Order</span>
                                                    <span class="info-box-number">
                                                        {{ number_format($count_priceOrder, 0, '') }} VND
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script_admin')

@endsection
