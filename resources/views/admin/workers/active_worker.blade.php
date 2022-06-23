@extends('layouts.ad')
@section('title')
    Quản Lý Thợ
@endsection
@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">

        @if (session('status'))
        <h6 class="alert alert-success text-center">{{ session('status') }}</h6>
        @endif
          <div class="col-lg-12">
            <div class="main-card mb-2 card">
                <div class="card-body ">

                    <div class="row mb-2">
                        <div class="col-md-4"><h5 class="card-title" style="background-color: aqua">Danh Sách Tài Khoản Thợ</h5></div>
                        <div class="col-md-5"> </div>
                    </div>

                    <table class="mb-0 table table-hover" id="accWork" >
                        <thead>
                        <tr class="text-center">
                            <th>Tên Thợ</th>
                            <th>Tài Khoản</th>
                            <th>Lần cuối đăng nhập</th>
                            <th>ID Điện thoại</th>
                            <th>số lần đăng nhập sai</th>
                            <th>Trạng Thái</th>
                            <th>Sửa Tài Khoản</th>
                            <th>Đổi mật khẩu</th>
                        </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>

<script>
    $(document).ready( function () {
    var table = $('#accWork').DataTable({

        "ajaxSource": "{{url('admin/workers/acc-workers/allAcc')}}",
        "columns": [
            { 'data': 'id_worker' },
            { 'data': 'acc_worker' },
            { 'data': 'last_active' },
            { 'data':  'device_key' },
            { 'data':  'time_log' },
            { 'data':   null,
                render: function(data, row, type ){

                switch(data.active) {
                    case 0:
                        return `<div class='tooltip1 '><a class="btn btn-sm btn-outline-success" href="{{url('admin/workers/acc-workers/updateActive?id=`+data.id+`&action=1')}}">Kích Hoạt</a>
                                <span class='tooltiptext1'>Bấm để khóa kích hoạt tài khoản cho thợ</span>
                                </div>`;
                        break;
                    case 1:
                        return `<div class='tooltip1'><a class="btn btn-sm btn-outline-warning" href="{{url('admin/workers/acc-workers/updateActive?id=`+data.id+`&action=2')}}">Đang mở</a>
                                <span class='tooltiptext1'>Bấm để khóa tài khoản lại</span>
                                </div>`;
                        break;
                    case 2:
                        return `<div class='tooltip1 '><a class="btn btn-sm btn-outline-primary" href="{{url('admin/workers/acc-workers/updateActive?id=`+data.id+`&action=1')}}">Đang Khóa</a>
                                <span class='tooltiptext1'>Bấm để mở Khóa Tài Khoản</span>
                                </div>`;
                        break;
                    case 3:
                        return `<div class='tooltip1 bg-danger'> Đã Xóa
                                <span class='tooltiptext1'>Tài Khoản Này Đã Bị Vô Hiệu, Vui lòng liên hệ Admin</span>
                                </div>`;
                        break;
                    }
                } 
            },
            { 
                'data': null,
                    render: function(data, row,type){
                        return `<div class='tooltip1'> <button class="btn btn-sm btn-outline-primary"  data-toggle="modal" data-target="#hi`+ data.id +`">Đổi Tài Khoản</button>
                                <span class='tooltiptext1'>Đổi Thông Tin Tài Khoản</span>
                                </div>
                                <div class="modal fade" id="hi`+ data.id +`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{action('Workers\AccountWorkersController@changeSetting')}}" method="post">
                                            @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cập Nhật Thông tin</h5>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="ac" value='2'>
                                                <input type="hidden" name="id" value='`+ data.id +`'>
                                                <input value='`+data.acc_worker+`' name="acc_worker" class="form-control" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                `;
                    }
            },
            {
                'data': null,
                    render: function(data, row,type){
                        return `<div class='tooltip1'> <button class="btn btn-sm btn-outline-primary"  data-toggle="modal" data-target="#hi2`+ data.id +`">Đổi mật 1</button>
                                <span class='tooltiptext1'>Đổi mật khẩu hoặc xác nhận mật khẩu</span>
                                </div>
                                <div class="modal fade" id="hi2`+ data.id +`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{action('Workers\AccountWorkersController@changeSetting')}}" method="post">
                                            @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cập Nhật Thông tin</h5>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="ac" value='1'>
                                                <input type="hidden" name="ac" value='`+ data.id +`'>
                                                <input value='`+data.acc_worker+`'  class="form-control" readonly>
                                                <input  name="pass_worker" class="form-control mt-2" placeholder=" Mật Khẩu Mới" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                `;
                }
            }
           
            ]
        });
   // print(ajax)
    });
    

</script>



@endsection
