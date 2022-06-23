<x-app-layout>
    @section('title')
        Tìm Kiếm Lịch
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
                                    <th class="col-1">Nội dung </th>
                                    <th class="col-1">Thời gian </th>
                                    <th class="col-1">Bảo hành</th>
                                    <th class="col-1">Tên khách</th>
                                    <th class="col-1">Địa chỉ</th>
                                    <th class="col-1">Quận</th>
                                    <th class="col-1">Số điện thoại</th>
                                    <th class="col-1">Ghi chú</th>
                                    <th class="col-1">Thợ làm</th>
                                    <th class="col-1">Tổng chi</th>
                                    <th class="col-1">Tổng thu</th>
                                    <th class="col-1">Số phiếu thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="col-1">{{ $item->work_content }}</td>
                                        <td class="col-1">{{ $item->date_book }}</td>
                                        <td class="col-1">{{ $item->warranty_period }}</td>
                                        <td class="col-1">{{ $item->name_cus }}</td>
                                        <td class="col-1">{{ $item->add_cus }}</td>
                                        <td class="col-1">{{ $item->des_cus }}</td>
                                        <td class="col-1">{{ $item->phone_cus }}</td>
                                        <td class="col-1">{{ $item->note_cus }}</td>
                                        <td class="col-1">{{ $item->worker_name }}</td>
                                        <td class="col-1">{{ $item->spending_total }}</td>
                                        <td class="col-1">{{ $item->income_total }}</td>
                                        <td class="col-1">{{ $item->seri_number }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($search as $item)
                                    <tr>
                                        <td class="col-1">{{ $item->work_content }}</td>
                                        <td class="col-1">@if ( $item->date_book ==  $item->warranty_time)
                                            {{ $item->date_book }}
                                        @else
                                        {{ $item->date_book }} Tới {{ $item->warranty_time }}
                                        @endif</td>
                                        <td class="col-1">{{ $item->warranty_info }}</td>
                                        <td class="col-1">{{ $item->name_cus }}</td>
                                        <td class="col-1">{{ $item->street }}</td>
                                        <td class="col-1">{{ $item->district }}</td>
                                        <td class="col-1">{{ $item->phone_number }}</td>
                                        <td class="col-1">{{ $item->real_note }}</td>
                                        <td class="col-1">{{ $item->worker_name }}</td>
                                        <td class="col-1">{{ $item->spending_total }}</td>
                                        <td class="col-1">{{ $item->income_total }}</td>
                                        <td class="col-1">{{ $item->seri_number }}</td>
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
                url: '{{ URL::to('searchh') }}',
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
