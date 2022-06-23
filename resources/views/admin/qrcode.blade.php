@extends('layouts.ad')
@section('title')
    Thêm Thợ Mới
@endsection
@section('content')
<div class="container mt-4 row">
    <div class="col-lg-5"> <div class="card">
        <div class="card-header text-center">
            <h4>Android Qrcode</h4>
        </div>
        <div class="card-body text-center">
            {!! QrCode::size(350)->style('square')->eye('circle')->generate('https://play.google.com/store/apps/details?id=com.thoviet.appKH') !!}
        </div>
    </div></div>
    <div class="col-lg-5"> <div class="card">
        <div class="card-header text-center">
                <h4>IOS Qrcode</h4>
        </div>
        <div class="card-body text-center">
            {!! QrCode::size(350)->style('square')->eye('circle')->generate('https://apps.apple.com/app/id1558963915') !!}
        </div>
    </div>
</div>

@endsection


