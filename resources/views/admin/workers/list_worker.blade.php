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
                        <div class="col-md-4"><h5 class="card-title">Danh sách thợ công ty</h5></div>
                        <div class="col-md-5"> </div>
                        <div class="col-3  align-self-end">
                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#create_worker">
                            <img src="{{url('icon/person-plus-fill.svg')}}" alt="" srcset="">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="create_worker" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm Thợ Mới</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ action('Workers\WorkerController@create') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="position-relative form-group"><label>Tên Thợ</label><input name="worker_name"
                                                    type="text" class="form-control"></div>
                                            <div class="position-relative form-group"><label>Địa Chỉ</label><input name="add_woker"
                                                    type="text" class="form-control"></div>
                                            <div class="position-relative form-group"><label>Mã Số </label><input name="sort_name"
                                                    type="text" class="form-control"></div>
                                            <div class="position-relative form-group"><label>Số Điện Thoại Công Ty</label><input
                                                    name="phone_ct" type="text" class="form-control"></div>
                                            <div class="position-relative form-group"><label>Số Điện Thoại Cá Nhân</label><input
                                                    name="phone_cn" type="text" class="form-control"></div>
                                            <input type="hidden" name="status_worker" value="0">
                                            <label>Phân Loại Thợ</label>
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input type="radio" name="kind_worker" class="form-check-input" value="0" checked />
                                                        <label class="form-check-label">
                                                            Điện Nước
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input type="radio" name="kind_worker" class="form-check-input" value="1">
                                                        <label class="form-check-label">
                                                            Điện Lạnh
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input type="radio" name="kind_worker" class="form-check-input" value="2">
                                                        <label class="form-check-label">
                                                            Đồ Gỗ
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input type="radio" name="kind_worker" class="form-check-input" value="3" />
                                                        <label class="form-check-label">
                                                            Xây Dựng
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input type="radio" name="kind_worker" class="form-check-input" value="4" />
                                                        <label class="form-check-label">
                                                            Năng Lượng Mặt Trời + Khác
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="mt-2 btn btn-primary" type="submit">Thêm</button>

                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <table class="mb-0 table table-hover" id="tbDNC" >
                        <thead>
                        <tr class="text-center">
                            <th>Tên Thợ</th>
                            <th>Mã thợ</th>
                            <th>Số Điện Thoại Công Ty</th>
                            <th>Số Điện Thoại Cá Nhân</th>
                            <th>Tài Khoản</th>
                            <th>Loại Thợ</th>
                            <th>Tình Trạng Thợ</th>
                            <th>Quản Lý Thợ</th>
                            <th>Sửa Thông Tin</th>

                        </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>

<script>
    $(document).ready( function () {
    var table = $('#tbDNC').DataTable({

        "ajaxSource": "{{url('admin/workers/getWorker')}}",
        "columns": [
            { 'data': 'worker_name' },
            { 'data': 'sort_name' },
            { 'data': 'phone_ct' },
            { 'data':  'phone_cn' },
            { 'data':  null,
                render: function(data,row,type){
                    switch(data.check_acc)
                    {
                        //chưa kích hoạt
                        case 0:
                        return `<button type="button" class="btn btn-sm tooltip1" data-toggle="modal" data-target="#thieu`+data.id+`">
                            <img src="{{url('icon/person-plus.svg')}}" alt="" srcset="" width="20px" fill="currentColor">
                            <span class='tooltiptext1'>Tạo tài Khoản</span>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="thieu`+data.id+`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm tài khoản App</h5>
                                    </div>
                                    <form  action='{{action('Workers\AccountWorkersController@create')}}' method='post'>
                                    @csrf
                                    <div class="modal-body">
                                            <input type='hidden' value='`+data.id+`' name='id'>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="accID" class="form-control" id="accID" aria-describedby="emailHelp" value="0`+ data.phone_ct+data.sort_name+`" readonly>
                                            <small id="accID" class="form-text text-muted">Tài khoản : Số liên hệ + tên nhóm thợ </small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" name="passID">
                                            </div>
                                           
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tạo Tài Khoản Thợ</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div> `;
                            break;
                        //đã kích hoạt
                        case 1:
                            return  'Có '+data.check_acc+' Tài Khoản';
                            break;
                        //tạm giữ
                        case 2:
                            return  `
                                <div class='tooltip1 bg-warning'>Tạm Khóa
                                <span class='tooltiptext1'>Đã có tài khoản chờ kích hoạt</span>
                                </div>
                               
                                `;
                            break;
                        //Đã xóa tài khoản
                        case 3:
                            return  `
                                <div class='tooltip1 bg-danger'>Đã Khóa
                                <span class='tooltiptext1'>Tài khoản vi phạm khóa app</span>
                                </div>
                                `;
                            break;
                    }

                }
             },
            { 'data':  null,
                render: function(data, row, type ){

                switch(data.kind_worker) {
                    case 0:
                        return `Điện Lạnh`;
                        break;
                    case 1:
                        return `Điện Nước`;
                        break;
                    case 2:
                        return `Đồ Gỗ`;
                        break;
                    case 3:
                        return `Xây Dựng`;
                        break;
                    case 4:
                        return `Năng Lượng + Khác`;
                        break;
                    default:
                        return `Hihi Chưa Phân Loại`;
                        console.log(data.kind_worker);
                    }
                }
            },
           
            { 'data': null,
                render: function(data, row, type ){
                    if(data.status_worker == 0)
                    {
                        return `Thợ Làm Bình thường `;
                    }
                    else
                    {
                        return `Hôm Nay Nghỉ.`;
                    }
                }
            } ,
            { 'data':  null,
                render: function(data, row, type ){

                return `
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelId`+data.id+`">
                    Báo Nghỉ
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId`+data.id+`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Chọn thời gian nghỉ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form  action='{{url('admin/workers/updatenghi')}}' method='post'>
                                @csrf
                                <div class="modal-body">
                                    <div class="form-row">
                                        <input type='hidden' value='`+data.id+`' name='id'>
                                        <div class="col">
                                            <input type="radio" class="form-control"  value="1" name="status_worker"> Nay nghỉ
                                        </div>
                                        <div class="col">
                                            <input type="radio" class="form-control" value="2" name="status_worker"> Nghỉ phép
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    `;
                }
            },
            {
                'data': null,
                render: function(data, row, type ){
                        return `<button type="button" data-id="${row.id}" class="btn btn-sm btn-primary btn-lg" data-toggle="modal" data-target="#updateId`+ data.id+`">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Sửa Thông Tin
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="updateId`+ data.id+`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title">Sửa thông tin thợ</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>

                                                    </button>
                                            </div>
                                            <form action='{{url('admin/workers/updateWorker')}}' method='post'>
                                            @csrf
                                            <div class="modal-body">
                                                <input type='hidden' value='`+data.id+`' name='id'>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="exampleAddress" class="check-thu-chi">Tên Thợ</label>
                                                        <input type="text" class="form-control"  value="`+data.worker_name+`" name="worker_name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleAddress" class="check-thu-chi">Mã Thợ</label>
                                                        <input type="text" class="form-control" value="`+data.sort_name+`" name="sort_name">
                                                    </div>
                                                </div><br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="exampleAddress" class="check-thu-chi">SĐT Công Ty</label>
                                                        <input type="text" class="form-control"  value="`+data.phone_ct+`" name="phone_ct">
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleAddress" class="check-thu-chi">SĐT Cá Nhân</label>
                                                        <input type="text" class="form-control" value="`+data.phone_cn+`" name="phone_cn">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            </form>
                                </div>
                            </div>
                        </div>`;
                }

            }


            ]
        });
   // print(ajax)
   
});


</script>



@endsection
