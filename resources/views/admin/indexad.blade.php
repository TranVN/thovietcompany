@extends('layouts.ad')
@section('title')
    Thêm Thợ Mới
@endsection
@section('content')

{{-- {{ asset('/') }} --}}
<div class="container-fluid mt-2">
    <div class="row">
        {{-- Biểu đồ lịch --}}
        <div class="col-lg-6 col-sm-12 card pt-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <canvas id="myChart" min-height="500" width="600"></canvas>
                </div>
            </div>
        </div>
        {{-- danh sách nhân viên đang văn phòng --}}
        <div class="col-lg-6 col-sm-12 pt-3 hihi">
            <div class="row">
                <div class="col-lg-12 text-center card mb-2"> <h4 class="mt-2">Danh sách nhân viên đang online trên trang </h4></div>
                <div class="col-lg-12 text-center card mb-2"> 
                    {{-- bảng DataTable nhân viên online --}}
                    <table class="table table-bordered mt-3 table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Nhân Viên</th>
                                <th>Email</th>
                                <th>Thời Gian Online</th>
                                <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{ Carbon\Carbon::parse($user->last_activity)->diffForHumans() }}
                                    </td>
                                    <td>
                                        @if(Cache::has('is_online' . $user->id))
                                            <span class="text-success">Online</span>
                                        @else
                                            <span class="text-secondary">Offline</span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

{{-- chart --}}
<script>
     var data = $.ajax({
        type: 'get',
        url: "{{url('admin/js')}}",
        async: false,
        dataType: "json",
        success: function (data) {
            return data;
        },
        error: function (xhr, type, exception) {
            // Do your thing
        }
    });
    if(data.status ==200)
    {
        var elec = data.responseJSON.elec;
        var other = data.responseJSON.other;
        var aircon = data.responseJSON.aircon;
        var wood = data.responseJSON.wood;
        var contruc = data.responseJSON.contruc;
        var  xValues =data.responseJSON.xValues;
    }

     console.log(other);
    // var promise = $.getJSON("{{url('admin/js')}}");

    // console.log(jqxhr);
    // var xValues = ['Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7','Chủ Nhật'];
 
    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{ 
                label: "Điện Nước",
                data: elec,
                borderColor: "red",
                fill: false
            }, 
            { 
                label: "Điện Lạnh",
                data: aircon,
                borderColor: "green",
                fill: false
            },
            { 
                label: "Xây Dựng",
                data: contruc,
                borderColor: "yellow",
                fill: false
                },
            { 
                label: "Khác",
                data: other,
                borderColor: "gray",
                fill: false
            },
            
            { 
                label: "Đồ Gỗ",
                data: wood,
                borderColor: "blue",
                fill: false
            }]
        },
        options: {
            title: {
            display: true,
            text: "Thông số lịch làm việc tuần qua( đang phát triển"
            }
        }
    });
</script>

 
@endsection


