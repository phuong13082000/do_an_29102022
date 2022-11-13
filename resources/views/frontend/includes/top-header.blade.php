<nav class="bg-light border-bottom">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="#" class="nav-link link-dark px-2" style="font-size: 14px"><i class="fa fa-phone mr-3"></i>&nbsp;0123456789</a></li>
            <li class="nav-item"><a href="#" class="nav-link link-dark px-2" style="font-size: 14px"><i class="fa fa-envelope mr-3"></i>&nbsp;hoangphuong0813@gmail.com</a></li>
            <li class="nav-item"><a href="#" class="nav-link link-dark px-2" style="font-size: 14px"><i class="fa fa-home mr-3"></i>&nbsp;Quận 8 - Thành phố Hồ Chí Minh</a></li>
        </ul>

        @if (!Session::get('id'))
        <ul class="nav">
            <li class="nav-item"><a href="{{ url('dang-nhap') }}" class="nav-link link-dark px-2">Đăng nhập</a></li>
            <li class="nav-item"><a href="{{ url('dang-ki') }}" class="nav-link link-dark px-2">Đăng kí</a></li>
        </ul>
        @else
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle pt-2" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Session::get('name') }}
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="{{url('profile')}}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('dang-xuat') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a></li>
            <form id="logout-form" action="{{ url('dang-xuat') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
        @endif
    </div>
</nav>
