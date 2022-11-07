<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent2">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    {{--Search--}}
                    <form class="d-flex" action="{{ route('search') }}" method="POST" autocomplete="off">
                        @csrf
                        <input class="form-control me-2" type="search" id="keywords" name="tukhoa" aria-label="Search" placeholder="Tìm kiếm theo tên">
                        <div id="search_ajax"></div>
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </li>
            </ul>

            @php
                $id = Session::get('id');
                $name = Session::get('name');
            @endphp
            @if (!$id)
                <div class="nav-item justify-content-end">
                    <a class="nav-link text-white" href="{{ url('dang-nhap') }}">Login</a>
                </div>
                <div class="nav-item justify-content-end">
                    <a class="nav-link text-white" href="{{ url('dang-ki') }}">Register</a>
                </div>
            @else
                <div class="nav-item dropdown justify-content-end">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Session::get('name') }}</a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('profile')}}" >Profile</a>
                        <a class="dropdown-item" href="{{ url('dang-xuat') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ url('dang-xuat') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </nav>
</div>
