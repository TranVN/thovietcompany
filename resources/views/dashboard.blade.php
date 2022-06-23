<x-app-layout>
    @section('hihi')
        {{-- <div id="noti_push"></div> --}}
    @endsection
    @section('title')
        Trang Chủ Quản Lí
    @endsection
    <div class="bt-scrollto">
        <button onclick="srolltoDN()" class="btn btn-sm btn-success">Điện Nước</button>
        <button onclick="srolltoDL()" class="btn btn-sm btn-success">Điện Lạnh</button>
        <button onclick="srolltoXD()" class="btn btn-sm btn-success">Xây Dựng</button>
        <button onclick="srolltoDG()" class="btn btn-sm btn-success">Đồ Gỗ</button>
        <button onclick="srolltoKhac()" class="btn btn-sm btn-success">Năng Lượng</button>

    </div>
    @php
        $today = date('d-m-Y');
    @endphp
    <div class="row " >
        <div class="col-lg-8">
        </div>
        <div class="col-lg-4">
            <div class="card-body" style="position: fixed;top: -10px;" >
                <form action="{{ route('homeView') }}" method="GET">

                    {{ csrf_field() }}
                    <div class="form-row" style="display: flex;flex-wrap: nowrap; ">
                        <div class="col-md-8">
                            <div class="position-relative form-group">
                                <input name="date_book" value="{{ $todayView }}" placeholder="Ngày Làm" type="date"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <button class=" btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="view-home">
        @include('work.lichdiennuoc')
    </div>
    <div class="view-home">
        @include('work.lichdienlanh')
    </div>
    <div class="view-home">
        @include('work.lichxaydung')
    </div>
    <div class="view-home">
        @include('work.lichdogo')
    </div>
    <div class="view-home">
        @include('work.lichkhac')
    </div>
    @include('layouts.footer')
    <script type="text/javascript" src="{{ asset('js/count_works/client_count.js') }}"></script>


</x-app-layout>
