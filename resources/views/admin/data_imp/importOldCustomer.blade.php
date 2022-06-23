@extends('layouts.ad')
@section('title')
    Thêm Dữ Liệu Khách Hàng
@endsection
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="card">
                <div class="container">
                    <div class="card-header ">
                        <h4 >Thêm dữ liệu khách hàng</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('importOldCustomer') }}">
                            @csrf
                            <div class="form-group">
                                <label for="file" > Chọn file: </label>
                                <input type="file" name="file" required>
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


