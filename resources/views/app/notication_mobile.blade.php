<x-app-layout>
    @section('title')
        Thông Báo
    @endsection
    @section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pushWorker-tab" data-toggle="tab" href="#pushWorker" role="tab" aria-controls="pushWorker" aria-selected="true">Thông tin thợ báo lịch</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="notication-tab" data-toggle="tab" href="#notication" role="tab" aria-controls="notication" aria-selected="false">Lịch từ App Khách</a>
            </li>
            
        </ul>
    </div>
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pushWorker" role="tabpanel" aria-labelledby="pushWorker-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-4 card">
                        <div class="card-body ">
                            <div class="row">
                                <table class="table table-hover text-center" id="tbDLC">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nội dung công việc</th>
                                            <th>SĐT</th>
                                            <th>Địa chỉ</th>
                                            <th>Tên Thợ</th>
                                            <th>Ghi chú</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hihi as $item)
                                            <tr>
                                                <td>{{ $item->work_content }}</td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>{{ $item->street }}</td>
                                                <td>{{ $item->sort_name }}--{{ $item->worker_name }}</td>
                                                <td>@switch($item->content_push)
                                                    @case(1)
                                                            <label class="bg-success"> Trả lịch</label>
                                                        @break
                                                    @case(2)
                                                            <label class="bg-info"> Đã Khảo Sát</label>
                                                        @break
                                                    @case(3)
                                                            <label class="bg-danger"> Khách Báo Hủy</label>   
                                                        @break 
                                                    @case(4)
                                                        <label class="bg-warning"> Khách Hẹn Mai</label>
                                                        @break   
                                                    @default
                                                        
                                                @endswitch
                                                   
                                                </td>
                                                <td>
                                                    @if ($item->flag == 1)
                                                    <button type="button" title="Đã đọc">
                                                        <svg class="bi" width="20" height="20"
                                                            fill="currentColor">
                                                            <use
                                                                xlink:href="icon/bootstrap-icons.svg#eye-slash" />
                                                        </svg>
                                                    </button>
                                                    @else
                                                    <form
                                                        action="{{ route('notiWorkerPush/mark-read', ['id' => $item->id]) }}"
                                                        method="get">
                                                        @csrf
                                                        <input type="hidden" name="name" value="{{Auth::user()->id}}">
                                                        <button type="submit" title="Chưa đọc">
                                                            <svg class="bi" width="20" height="20"
                                                                fill="currentColor">
                                                                <use
                                                                    xlink:href="icon/bootstrap-icons.svg#eye" />
                                                            </svg>
                                                        </button>
                                                    </form>   
                                                    @endif
                                                   
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="notication" role="tabpanel" aria-labelledby="notication-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-4 card">
                        <div class="card-body ">
                            <div class="row">
                                <table class="table table-hover text-center" id="tbDLC">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nội dung công việc</th>
                                            <th>Tên KH</th>
                                            <th>SĐT</th>
                                            <th>Địa chỉ</th>
                                            <th>Quận</th>
                                            <th>Ngày</th>
                                            <th>Ghi chú</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($noticationPushMobile as $item)
                                            <tr>
                                                <td>{{ $item->work_content }}</td>
                                                <td>{{ $item->name_cus }}</td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>{{ $item->street }}</td>
                                                <td>{{ $item->district }}</td>
                                                <td>{{ $item->date_book }}</td>
                                                <td>{{ $item->work_note }}</td>
                                                <td>
                                                    @if ($item->flag_status == 1)
                                                        <button type="button" title="Đã đọc">
                                                            <svg class="bi" width="20" height="20"
                                                                fill="currentColor">
                                                                <use
                                                                    xlink:href="icon/bootstrap-icons.svg#eye-slash" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        {{-- <form action="{{ route('upNotiMobile', ['id'=>$item->id])}}" method="get">
                                                        @csrf
                                                        <input type="hidden" name="name" >
                                                        <button type="submit" data-placement="botom" title="Chưa đọc"><i class="fa fa-eye" ></i></button></form> --}}

                                                        <form
                                                            action="{{ route('upNotiMobile', ['id' => $item->id]) }}"
                                                            method="get">
                                                            @csrf
                                                            <input type="hidden" name="name" value="{{Auth::user()->id}}">
                                                            <button type="submit" title="Chưa đọc">
                                                                <svg class="bi" width="20" height="20"
                                                                    fill="currentColor">
                                                                    <use
                                                                        xlink:href="icon/bootstrap-icons.svg#eye" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
                   
          
    @endsection
</x-app-layout>
