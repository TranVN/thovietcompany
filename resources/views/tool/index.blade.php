<x-app-layout>
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
                            <div class="col-md-4"><h5 class="card-title">Thông tin đồ nghề thợ mượn</h5></div>
                            <div class="col-md-5"> </div>
                            <div class="col-3 align-self-end " style="width:100%">
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#toolloan">
                                <img src="{{url('icon/person-plus-fill.svg')}}" alt="" srcset="">
                            </button>
    
                            <!-- Modal -->
                            <div class="modal fade" id="toolloan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Thợ mượn đồ mới</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ action('ToolWorkerLoanController@create') }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="position-relative form-group"><label>Tên đồ nghề</label><input name="content_loan"
                                                        type="text" class="form-control"></div>
                                                <div class="position-relative form-group"><label>Thợ mượn</label><input name="name_worker"
                                                        type="text" class="form-control"></div>
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
    
                        <table class="mb-0 table table-hover" id="allLoan" >
                            <thead>
                            <tr class="text-center">
                                <th>Tên đồ nghề thợ mượn</th>
                                <th>Tên thợ</th>
                                <th>Ngày Mượn</th>
                                <th>Ngày trả</th>
                                <th>Tình trạng</th>
                                <th>Báo trả</th>
                                {{-- <th>Tình Trạng Thợ</th> --}}
                                {{-- <th>Quản Lý Thợ</th> --}}
    
    
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
        var table = $('#allLoan').DataTable({
    
            "ajaxSource": "{{url('tool/getAllLoan')}}",
            "columns":  [
                { 'data': 'content_loan' },
                { 'data': 'name_worker' },
                { 'data': 'date_loan' },
                { 'data': 'date_give_back' },
                { 'data':  null,
                    render: function(data, row, type ){
    
                    switch(data.type_loan) {
                        case 0:
                            return `Chưa Trả`;
                            break;
                        case 1:
                            return `Đã trả`;
                            break;
                        }
                    }
                },
                { 'data': null,
                    render: function(data, row, type ){
                        if(data.type_loan == 0)
                        {
                            return `<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#thieu`+data.id+`">
                        Báo Trả
                        </button>
    
                        <!-- Modal -->
                        <div class="modal fade" id="thieu`+data.id+`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xác nhận trả đồ nghề</h5>
                                    </div>
                                     <form  action='{{url('tool/updateloan')}}' method='post'>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <input type='hidden' value='`+data.id+`' name='id'>
                                            <input type='hidden' value='0' name='sta'>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="submit" class="btn btn-success">Xác Nhận</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div> `;
                        }
                        else
                        {
                            return `<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#thieu`+data.id+`">
                        Mượn lại
                        </button>
    
                        <!-- Modal -->
                        <div class="modal fade" id="thieu`+data.id+`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Báo Thợ mượn lại</h5>
                                    </div>
                                    <form  action='{{url('tool/updateloan')}}' method='post'>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <input type='hidden' value='`+data.id+`' name='id'>
                                            <input type='hidden' value='1' name='sta'>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Xác Nhận</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div> `;
                        }
                    }
                } ,
            ]
            });
       // print(ajax)
    });
    
    </script>
    
    
    
    </x-app-layout>
    