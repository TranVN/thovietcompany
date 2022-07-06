<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{asset('/')}}"><img src="{{asset('siteico.png')}}" alt="" width="50%"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
          <div class="menu-content col-10 d-flex justify-content-start">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{ asset('/') }}">Trang Chủ <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Thông Tin Thợ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{asset('/map-workers')}}">Vị trí</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ asset('/workers') }}">Danh sách Thợ</a>
                  
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ asset('/search') }}">Tìm Thông Tin Khách</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ asset('/tool') }}">Đồ Nghề</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" onclick="showNewWork()">Thêm Khách Hàng</a>
              </li>
            </ul>
          </div>
          
          <div class="menu-noti col-2 justify-content-end d-flex dropleft">
            <div class="row">
              <div class="col-6">
                <button type="button" class="btn btn-outline-success my-2 my-sm-0 pr-3 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell"></i>
                </button>
                <span id="countnoticationMobile" class="badge"></span>
              <div class="dropdown-menu ">
                <!-- Dropdown menu links -->
                  <div id="newWork" >
                    <ul class="box-noti">
                      <li class="header-noti">Thông báo từ ứng dụng</li>
                      <ul class="main-noti" id="menu_notiAppMobile"></ul>
                      <ul class="main-noti" id="menu_notiWorkerPlus"></ul>
                      <li class="footer-noti"><a href="{{ asset('/notification-mobile')}}">Xem tất cả thông báo</a></li>
                    </ul>
                  </div>
              </div>
              </div>
              <div class="col-6">
                <form class="form-inline my-2 my-lg-0 col-6" method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class=" btn btn-outline-danger my-2 my-sm-0" type="submit" data-toggle="collapse" data-target="#showNoti" aria-controls="navbarSupportedContenn" aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fa fa-sign-out"></i>
                  </button> 
                </form>
              </div>
            </div>
               
              
          </div>
      
    </div>
  </nav>
  