<x-app-layout>
    @section('title')
        Lịch khảo sát, lịch hủy
    @endsection
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="card">
                    <div class="card-header">
                        <input type="text" placeholder="Tìm kiếm" id="search" class="form-control">
                    </div>
                    <div class="card-body search ">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-1">Nội dung sửa chữa</th>
                                    <th class="col-1">Thời gian đặt hẹn</th>
                                    <th class="col-1">Tên khách</th>
                                    <th class="col-1">Địa chỉ</th>
                                    <th class="col-1">Quận</th>
                                    <th class="col-1">Số điện thoại</th>
                                    <th class="col-1">Thợ làm</th>
                                    <th class="col-1">Nguyên nhân</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($search as $item)
                                    <tr>
                                        <td class="col-1">{{ $item->work_content }}</td>
                                        <td class="col-1">{{ $item->date_book }}</td>
                                        <td class="col-1">{{ $item->name_cus }}</td>
                                        <td class="col-1">{{ $item->street }}</td>
                                        <td class="col-1">{{ $item->district }}</td>
                                        <td class="col-1">{{ $item->phone_number }}</td>
                                        <td class="col-1">{{ $item->worker_name }}</td>
                                        <td class="col-1">{{ $item->real_note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('work/searchsurvey_cancle') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
</x-app-layout>
