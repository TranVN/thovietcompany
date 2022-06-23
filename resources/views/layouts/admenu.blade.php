
<nav class="navbar navbar-expand-lg navbar-light bg-light p-1">
    <a class="navbar-brand" href="{{asset('/')}}"><img src="{{asset('siteico.png')}}" alt="" width="50%"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item mr-2 active">
          <a class="nav-link" href="{{asset('/admin')}}">ADMIN<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mr-2 dropdown">
          <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
           Thợ
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" style="text-transform: capitalize" href="{{asset('admin/workers ')}}">Danh sách thợ</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" style="text-transform: capitalize" href="{{asset('admin/workers/acc-workers')}}">Tài khoản App</a>
          </div>
      </li>
       
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/banner')}}">BANNER <span class="sr-only">(current)</span></a>
            
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/prices')}}">BẢNG GIÁ <span class="sr-only">(current)</span></a>
            
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/post')}}">BÀI VIẾT<span class="sr-only">(current)</span></a>
           
        </li>
        <li class="nav-item mr-2 dropdown">
            <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
             THÊM DỮ LIỆU
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" style="text-transform: capitalize" href="{{asset('admin/import/customer')}}">Dữ liệu khách hàng</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" style="text-transform: capitalize" href="{{asset('admin/import/worker')}}">Dữ liệu thợ</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" style="text-transform: capitalize" href="{{asset('admin/import/price')}}">Thêm bảng giá</a>
            </div>
        </li>
        <li class="nav-item mr-2 dropdown">
          <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
           App
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" style="text-transform: capitalize" href="{{asset('admin/view-app')}}">Popup Chương trình khuyến mãi</a>
            <div class="dropdown-divider"></div>
             <a class="dropdown-item" style="text-transform: capitalize" href="{{asset('admin/generate-qrcode')}}">Qr code</a>
          </div>
        </li>
      </ul>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="nav-item" style="color: green" href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();">
            <img src="{{url('icon/box-arrow-right.svg')}}" alt="" srcset="" width="30px">
        </a>
    </form>
  </nav>
