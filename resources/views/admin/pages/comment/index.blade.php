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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Answer</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list_Comment as $key => $comment )
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$comment->title}}</td>
                                        <td>
                                            {{$comment->answer}}

                                            @if ($comment->status==0)
                                                <br><textarea class="form-control reply_comment" rows="3"></textarea>
                                                <br>
                                                <button class="btn btn-default">Trả lời</button>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{'/detail/'.$comment->reProduct->id}}" target="_blank">
                                                {{$comment->reProduct->title}}
                                            </a>
                                        </td>
                                        <td>{{$comment->reCustomer->fullname}}</td>
                                        <td>
                                            @if ($comment->status==1)
                                                <input type="button" data-comment_status="0"
                                                       data-comment_id="{{$comment->id}}" id="{{$comment->product_id}}"
                                                       class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt">
                                            @else
                                                <input type="button" data-comment_status="1"
                                                       data-comment_id="{{$comment->id}}" id="{{$comment->product_id}}"
                                                       class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ Duyệt">
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Answer</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
