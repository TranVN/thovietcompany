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
    <div class="d-flex search-form" style=" bottom: 5px; position: fixed;right: 40%;">
            <form action="{{ route('homeView') }}" method="GET">
                {{ csrf_field() }}
                <div class="form-row just-content-center">
                    <div class="col-8">
                            <input name="date_book" value="{{ $todayView }}" placeholder="Ngày Làm" type="date" class="form-control">
                    </div>
                    <div class="col-3">
                        <button class=" btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
    </div>
    
    @include('layouts.footer')
    <script type="text/javascript" src="{{ asset('js/count_works/client_count.js') }}"></script>
    <script type="text/javascript">
        function copyToClipboard(id) {
            document.getElementById(id).select();
    
            document.execCommand('copy');
        }
    </script>
</x-app-layout>
