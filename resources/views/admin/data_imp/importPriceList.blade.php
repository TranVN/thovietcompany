@extends('layouts.ad')
@section('title')
    Thêm Dữ Liệu Thợ
@endsection
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="card">
                <div class="container">
                    <div class="card-header ">
                        <h4 >Thêm danh sách thợ</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('importPriceList') }}">
                            @csrf
                            <div class="form-group">
                                <label for="file" > Chọn file: </label>
                                <input type="file" name="file" required >
                            </div>
                            <button type="submit" class="btn btn-sm btn-success"> Lưu </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
