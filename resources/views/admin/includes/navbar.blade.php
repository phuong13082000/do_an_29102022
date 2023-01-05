<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('admin/profile-admin')}}" class="nav-link">Profile</a>
        </li>

    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">
                    @if($count_message == 0 || NULL)
                        0
                    @else
                        {{$count_message}}
                    @endif
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if($messages)
                    @foreach($messages as $message)
                        <a href="{{url('admin/comment')}}" class="dropdown-item">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">{{$message->reCustomer->fullname}}</h3>
                                    <p class="text-sm">{{$message->title}}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{$message->created_at}}</p>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-divider"></div>
                    @endforeach
                @endif
                <a href="{{url('admin/comment')}}" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a>
        </li>

    </ul>
</nav>
