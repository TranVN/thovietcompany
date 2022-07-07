<div class="row mb-1" id="lichKhac">
    <div class="col-4 card colo-blue">
        <h5 class="title-lich">LỊCH KHÁC</h5>
    </div>
    <div class="col-2 info-card">
        <div class="card widget-content colo-blue ">
            <div class="widget-content-wrapper ">
                <div class="widget-content-left">
                    <div class="widget-heading">Lịch Nhận</div>
                </div>
                <div class="widget-content-right">
                    <div class="text-danger text-count">
                        <span>
                            <div id="sum_else">0</div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2 info-card">
        <div class="card widget-content colo-blue ">
            <div class="widget-content-wrapper ">
                <div class="widget-content-left">
                    <div class="widget-heading">Lịch Chưa Phân</div>
                </div>
                <div class="widget-content-right">
                    <div class="text-danger text-count">
                        <span>
                            <div id="work_no_else_distribution">0</div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2 info-card">
        <div class="card widget-content colo-blue ">
            <div class="widget-content-wrapper ">
                <div class="widget-content-left">
                    <div class="widget-heading">Lịch Đã Phân</div>
                </div>
                <div class="widget-content-right">
                    <div class="text-danger text-count">
                        <span>
                            <div id="work_else_distribution">0</div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2 info-card">
        <div class="card widget-content colo-blue ">
            <div class="widget-content-wrapper ">
                <div class="widget-content-left">
                    <div class="widget-heading">Lịch Hủy</div>
                </div>
                <div class="widget-content-right">
                    <div class="text-danger text-count">
                        <span>
                            <div id="work_else_cancle">0</div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12 col-lg-5 card r-border">
        <div class="table-responsive-xxl ">
            <table class="table table-hover caption-top">
                <thead>
                    <tr>
                        <th scope="col">Nội dung CV</th>
                        <th scope="col">Tên KH</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số liên hệ</th>
                        <th scope="col">Ghi Chú</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($else as $item)
                        <tr data-toggle="modal" data-target="#LK_{{ $item->id }}" >
                            <td>{{ $item->work_content }}</td>
                            <td>{{ $item->name_cus }}</td>
                            <td>{{ $item->street }}, {{ $item->district }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>{{ $item->work_note }}</td>
                            {{-- SỬA LỊCH --}}
                            <div class="modal fade" id="LK_{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center d-block">
                                            <h5 class="modal-title">Thông Tin Lịch</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form action="{{ route('updateWork', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label
                                                                    for="exampleAddress" class="check-thu-chi">Yêu Cầu
                                                                    Công
                                                                    việc</label><input name="work_content"
                                                                    id="exampleAddress"
                                                                    placeholder="Sửa nhà, điện nước, điện lạnh...."
                                                                    type="text" class="form-control"
                                                                    value="{{ $item->work_content }}" required></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label
                                                                    for="exampleAddress2" class="check-thu-chi">Số liên
                                                                    hệ</label><input name="phone_number"
                                                                    placeholder="0903532938" type="text"
                                                                    class="form-control"
                                                                    value="{{ $item->phone_number }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label
                                                                    for="exampleAddress3" class="check-thu-chi">Địa
                                                                    Chỉ</label><input name="street"
                                                                    placeholder="184 Nguyễn Xí, P.26" type="text"
                                                                    class="form-control"
                                                                    value="{{ $item->street }}"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label
                                                                    for="exampleAddress2">Quận</label><input
                                                                    name="district" placeholder="Bình Thạnh" type="text"
                                                                    class="form-control"
                                                                    value="{{ $item->district }}" required></div>
                                                        </div>

                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label
                                                                    for="exampleEmail11">Tên
                                                                    KH</label><input name="name_cus" placeholder="Tên"
                                                                    type="text" class="form-control"
                                                                    value="{{ $item->name_cus }}"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label
                                                                    for="examplePassword11" class="">Ngày
                                                                    Làm</label><input name="date_book"
                                                                    placeholder="Ngày Làm" type="date"
                                                                    class="form-control"
                                                                    value="{{ $item->date_book }}"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label
                                                                    for="exampleAddress" class="">Ghi
                                                                    chú</label><input name="work_note"
                                                                    placeholder="Thang cao, cần 2 thợ...." type="text"
                                                                    class="form-control"
                                                                    value="{{ $item->work_note }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="form-row">
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input type="radio" name="kind_work" id='1'
                                                                            value="0"
                                                                            @if ($item->kind_work == 0) checked @endif />
                                                                        <label class="form-check-label" for="1">
                                                                            Điện Nước
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input type="radio" name="kind_work" id="2"
                                                                            value="1"
                                                                            @if ($item->kind_work == 1) checked @endif>
                                                                        <label class="form-check-label" for="2">
                                                                            Điện Lạnh
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input type="radio" name="kind_work" id="3"
                                                                            value="2"
                                                                            @if ($item->kind_work == 2) checked @endif>
                                                                        <label class="form-check-label" for="3">
                                                                            Đồ Gỗ
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input type="radio" name="kind_work" id="4"
                                                                            value="3"
                                                                            @if ($item->kind_work == 3) checked @endif />
                                                                        <label class="form-check-label" for="4">
                                                                            Xây Dựng
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input type="radio" name="kind_work" id="5"
                                                                            value="4"
                                                                            @if ($item->kind_work == 4) checked @endif />
                                                                        <label class="form-check-label" for="5">
                                                                            Năng Lượng
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target=".phantho{{ $item->id }}">Phân
                                                Thợ</button>
                                            <button type="submit" class="btn btn-success">Sửa Lịch</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target=".xoalich{{ $item->id }}">Xóa Lịch</button>
                                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                data-target=".nhandoilich{{ $item->id }}">Nhân
                                                Đôi</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- PHÂN THỢ --}}
                            <div class="modal fade phantho{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ action('WorkHasController@working') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Chọn thợ cần phân</h5>
                                            </div>
                                            <div class="modal-body">
                                                {{-- body --}}
                                                <div class="row">
                                                    <input type="hidden" name="id_cus" value="{{ $item->id }}">
                                                    <div class='col-sm-6 text-center'>
                                                        <label class='check-container1'>Thợ Chính :
                                                        </label>
                                                        <select name='id_worker' class='form-control'>
                                                            @foreach ($worker as $itemWK)
                                                                <option value="{{ $itemWK->id }}">
                                                                    {{ $itemWK->worker_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class='col-sm-6 text-center'>
                                                        <label class='check-container1'>Thợ Phụ</label>
                                                        <select name='id_phu' class='form-control'>
                                                            <option value="0">Không</option>
                                                            @foreach ($worker as $itemWK)
                                                                <option value="{{ $itemWK->id }}">
                                                                    {{ $itemWK->worker_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-control"
                                                    id="coppy_{{ $item->id }}"
                                                    value="{{ $item->work_content .'    ' .$item->street .'   ' .$item->district .'  ' .$item->phone_number .'  ' .$item->work_note }}">
                                                {{-- end body --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary"
                                                    onclick="copyToClipboard('coppy_{{ $item->id }}')">Xác
                                                    Nhận</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- XÓA LỊCH --}}
                            <div class="modal fade xoalich{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ action('WorkController@deleteWork', ['id' => $item->id]) }}"
                                        method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-content">
                                            <div class="modal-header text-center d-block">
                                                <h5 class="modal-title">Bạn có chắc chắn xóa lịch??
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                {{-- body --}}
                                                <div class="col-md-6 center d-block">
                                                    <div class="position-relative form-group"><label
                                                            for="exampleAddress" class="">Lý do:
                                                        </label><input name="work_note" placeholder="Nhập lý do hủy.."
                                                            type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                                {{-- end body --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Xác
                                                    Nhận</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- NHÂN ĐÔI LỊCH --}}
                            <div class="modal fade nhandoilich{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('addWork') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-content">
                                            <div class="modal-header text-center d-block">
                                                <h5 class="modal-title">Nhân Đôi Lịch
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <form action="{{ route('updateWork', ['id' => $item->id]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }}
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group"><label
                                                                        for="exampleAddress" class="">Yêu
                                                                        Cầu
                                                                        Công
                                                                        việc</label><input name="work_content"
                                                                        id="exampleAddress"
                                                                        placeholder="Sửa nhà, điện nước, điện lạnh...."
                                                                        type="text" class="form-control"
                                                                        value="{{ $item->work_content }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group"><label
                                                                        for="exampleAddress2" class="">Số
                                                                        liên
                                                                        hệ</label><input name="phone_number"
                                                                        placeholder="0903532938" type="text"
                                                                        class="form-control"
                                                                        value="{{ $item->phone_number }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group"><label
                                                                        for="exampleAddress3"
                                                                        class="">Địa
                                                                        Chỉ</label><input name="street"
                                                                        placeholder="184 Nguyễn Xí, P.26" type="text"
                                                                        class="form-control"
                                                                        value="{{ $item->street }}"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group"><label
                                                                        for="exampleAddress2"
                                                                        class="">Quận</label><input
                                                                        name="district" placeholder="Bình Thạnh"
                                                                        type="text" class="form-control"
                                                                        value="{{ $item->district }}" required></div>
                                                            </div>

                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group"><label
                                                                        for="exampleEmail11" class="">Tên
                                                                        KH</label><input name="name_cus"
                                                                        placeholder="Tên" type="text"
                                                                        class="form-control"
                                                                        value="{{ $item->name_cus }}"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group"><label
                                                                        for="examplePassword11"
                                                                        class="">Ngày
                                                                        Làm</label><input name="date_book"
                                                                        placeholder="Ngày Làm" type="date"
                                                                        class="form-control"
                                                                        value="{{ $item->date_book }}"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group"><label
                                                                        for="exampleAddress" class="">Ghi
                                                                        chú</label><input name="work_note"
                                                                        placeholder="Thang cao, cần 2 thợ...."
                                                                        type="text" class="form-control"
                                                                        value="{{ $item->work_note }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input type="radio" name="kind_work" id='1'
                                                                                value="0"
                                                                                @if ($item->kind_work == 0) checked @endif />
                                                                            <label class="form-check-label" for="1">
                                                                                Điện Nước
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input type="radio" name="kind_work" id="2"
                                                                                value="1"
                                                                                @if ($item->kind_work == 1) checked @endif>
                                                                            <label class="form-check-label" for="2">
                                                                                Điện Lạnh
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input type="radio" name="kind_work" id="3"
                                                                                value="2"
                                                                                @if ($item->kind_work == 2) checked @endif>
                                                                            <label class="form-check-label" for="3">
                                                                                Đồ Gỗ
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input type="radio" name="kind_work" id="4"
                                                                                value="3"
                                                                                @if ($item->kind_work == 3) checked @endif />
                                                                            <label class="form-check-label" for="4">
                                                                                Xây Dựng
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input type="radio" name="kind_work" id="5"
                                                                                value="4"
                                                                                @if ($item->kind_work == 4) checked @endif />
                                                                            <label class="form-check-label" for="5">
                                                                                Năng Lượng
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Xác
                                                    Nhận</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-lg-7 card r-border">
        <div class="table-responsive-xxl ">
            <table class="table table-hover caption-top">
                <thead>
                    <tr>
                        <th scope="col">Nội dung CV</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số liên hệ</th>
                        <th scope="col">Ghi Chú</th>
                        <th scope="col">Thợ Làm</th>
                        <th scope="col">Tổng Chi</th>
                        <th scope="col">Tổng Thu</th>
                        <th scope="col">Sửa </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elseHas as $item)
                    <tr @if ($today != $item->date_book) style="background-color: #fffe0045" @endif>
                        <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }} " data-toggle="tooltip"
                            data-placement="top" title="Nhập Thu Chi">
                            {{ $item->work_content }}
                        </td>
                        <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }}" data-toggle="tooltip"
                            data-placement="top" title="Nhập Thu Chi">{{ $item->street }},
                            {{ $item->district }}</td>
                        <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }}" data-toggle="tooltip"
                            data-placement="top" title="Nhập Thu Chi">
                            {{ $item->phone_number }}
                        </td>
                        <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }}" data-toggle="tooltip"
                            data-placement="top" title="Nhập Thu Chi">{{ $item->real_note }}
                        </td>
                        @if ($item->income_total == 0)
                            <td data-toggle="modal" data-target="#phantholichdp{{ $item->id }}"
                                data-toggle="tooltip" data-placement="top" title="Đổi Thợ">
                                {{ $item->worker_name }}
                            </td>
                        @else
                            <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }}" data-toggle="tooltip"
                                data-placement="top" title="Đổi Thợ">
                                {{ $item->worker_name }}
                            </td>
                        @endif

                        @if ($item->income_total == 0)
                            <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }}" data-toggle="tooltip"
                                data-placement="top" title="Nhập Thu Chi" style="color: red; font-weight:800">
                                {{ $item->spending_total }}
                            </td>
                        @else
                            <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }}" data-toggle="tooltip"
                                data-placement="top" title="Nhập Thu Chi">
                                {{ $item->spending_total }}
                            </td>
                        @endif
                        @if ($item->income_total == 0)
                            <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }} " data-toggle="tooltip"
                                data-placement="top" title="Nhập Thu Chi" style="color: red; font-weight:800">
                                {{ $item->income_total }}
                            </td>
                        @else
                            <td data-toggle="modal" data-target="#ELCDP_{{ $item->id }} " data-toggle="tooltip"
                                data-placement="top" title="Nhập Thu Chi">
                                {{ $item->income_total }}
                            </td>
                        @endif

                        <td data-toggle="modal" data-target="#ELCDPS_{{ $item->id_cus }}" data-toggle="tooltip"
                            data-placement="top" title="Sửa thông tin khách hàng">
                            <svg class="bi" width="20" height="20" fill="currentColor"
                                style="color: red">
                                <use xlink:href="{{ asset('icon/bootstrap-icons.svg#pencil') }}" />
                            </svg>
                        </td>


                        <div class="modal fade" id="ELCDP_{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center d-block">
                                        <h5 class="modal-title">Thông Tin Lịch</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('updateWorkHas', ['id' => $item->id]) }}"
                                        method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-row">
                                                    <div class="col-md-6">

                                                        <input type="hidden" value="{{ $item->id_cus }}"
                                                            name="id_cus">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleAddress" class="check-thu-chi">Yêu Cầu
                                                                Công việc</label>

                                                            <input name="work_content" id="exampleAddress"
                                                                placeholder="Sửa nhà, điện nước, điện lạnh...."
                                                                type="text" class="form-control"
                                                                value="{{ $item->work_content }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                class="check-thu-chi">Số liên hệ</label><input
                                                                name="phone_number" placeholder="0903532938"
                                                                type="text" class="form-control"
                                                                value="{{ $item->phone_number }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label class="check-thu-chi">Địa Chỉ</label>
                                                            <input name="street" placeholder="184 Nguyễn Xí, P.26"
                                                                type="text" class="form-control"
                                                                value="{{ $item->street }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label class="check-thu-chi">Quận</label>
                                                            <input name="district" placeholder="Bình Thạnh"
                                                                type="text" class="form-control"
                                                                value="{{ $item->district }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleEmail11" class="check-thu-chi">Tên
                                                                KH</label><input name="name_cus" placeholder="Tên"
                                                                type="text" class="form-control"
                                                                value="{{ $item->name_cus }}"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="examplePassword11" class="check-thu-chi">Ngày
                                                                Làm</label><input name="date_book"
                                                                placeholder="Ngày Làm" type="date"
                                                                class="form-control"
                                                                value="{{ $item->date_book }}"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleAddress" class="check-thu-chi">Ghi
                                                                chú</label><input name="real_note"
                                                                placeholder="Thang cao, cần 2 thợ...." type="text"
                                                                class="form-control"
                                                                value="{{ $item->real_note }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">

                                                            <div class="form-row" name="done" id="done">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label for="" class="check-thu-chi">Tiền
                                                                            Chi</label><input name="spending_total"
                                                                            placeholder="Tổng chi" type="number"
                                                                            class="form-control"
                                                                            value="{{ $item->spending_total }}">
                                                                    </div>
                                                                </div>
                                                                @if ($item->income_total == 0)
                                                                    <div class="col-md-6">
                                                                        <div class="position-relative form-group">
                                                                            <label for=""
                                                                                class="check-thu-chi">Tiền
                                                                                Thu</label>
                                                                            <input name="income_total"
                                                                                placeholder="Tổng thu" type="number"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-6">
                                                                        <div class="position-relative form-group">
                                                                            <label for=""
                                                                                class="check-thu-chi">Tiền
                                                                                Thu</label>
                                                                            <input name="income_total"
                                                                                placeholder="Tổng thu" type="number"
                                                                                class="form-control"
                                                                                value="{{ $item->income_total }}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="position-relative form-group">
                                                                    <div class="form-row" name="done"
                                                                        id="done">
                                                                        <div class="col-4">
                                                                            <div
                                                                                class="position-relative form-group">
                                                                                <input type="radio"
                                                                                    name="status_work" checked
                                                                                    value="0">
                                                                                <label for="status_work">Đã
                                                                                    Làm</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div
                                                                                class="position-relative form-group">
                                                                                <input type="radio"
                                                                                    name="status_work" value="5">
                                                                                <label for="status_work">Mai làm
                                                                                    tiếp</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div
                                                                                class="position-relative form-group">
                                                                                <input type="radio"
                                                                                    name="status_work" value="3">
                                                                                <label for="status_work">Báo
                                                                                    Giá</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php
                                                            $image = DB::table('spending_total_images')->where('id_work_has' , '=',  $item->id)->get();
                                                            $count = $image->count();
                                                            // echo $images;
                                                            @endphp
                                                            <div class="col-3"></a>
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-primary btn-bg" data-toggle="modal" data-target="#incomeImage-{{$item->id}}  @php
                                                                if($count == 0){echo 'disabled';}  
                                                              @endphp">
                                                                  Vật Tư
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="incomeImage-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                        <h5 class="modal-title">Hình ảnh phiếu chi</h5>

                                                                                    </div>
                                                                            <div class="modal-body">
                                                                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                                                    <div class="carousel-inner">
                                                                                        {{-- @php
                                                                                            $image = DB::table('spending_total_images')->where('id_work_has' , '=',  $item->id)->get();
                                                                                            $count = $image->count();
                                                                                            // echo $images;
                                                                                        @endphp --}}
                                                                                        @foreach ($image as $items)
                                                                                        {{-- nhớ thêm length vào database --}}
                                                                                        @if ($items->length == 0)
                                                                                            <div class="carousel-item active">
                                                                                                <img src="{{asset("$items->path_image")}}" class="d-block w-100" alt="...">
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="carousel-item">
                                                                                                <img src="{{asset("$items->path_image")}}" class="d-block w-100" alt="...">
                                                                                            </div>
                                                                                        @endif
                                                                                        @endforeach


                                                                                    </div>
                                                                                   <button class="carousel-control-prev"  type="button" data-target="#carouselExampleControls" data-slide="prev">
                                                                                      <span class="carousel-control-prev-icon"   aria-hidden="true"></span>

                                                                                    </button>
                                                                                    <button  class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                                                                      <span class="carousel-control-next-icon"  aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                            <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#bill_{{$item->id}}"
                                                                    @php
                                                                        if($item->bill_imag == NULL)
                                                                        {echo 'disabled';}
                                                                    @endphp
                                                                    >
                                                                    Phiếu Thu
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="bill_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            
                                                                            <div class="modal-body">
                                                                                <div class="container-fluid">
                                                                                    <img src="{{asset("$item->bill_imag")}}" class="d-block w-100" alt="...">
                                                                                </div>
                                                                            </div>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- thong tin bảo hành --}}
                                                <label class="check-thu-chi">Thông tin bảo hành</label>
                                                <div class="mb-1">
                                                    <div class="card-body row">
                                                            @if ($item->status_work == 0 )
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div
                                                                        class="position-relative form-group col-3 ">
                                                                        <input type="radio" name="unit"
                                                                            checked value="d">
                                                                        <label>Ngày</label>
                                                                    </div>
                                                                    <div class="position-relative form-group col-3">
                                                                        <input type="radio" name="unit"
                                                                            value="w">
                                                                        <label>Tuần</label>
                                                                    </div>
                                                                    <div class="position-relative form-group col-3">
                                                                        <input type="radio" name="unit"
                                                                            value="m">
                                                                        <label>Tháng</label>
                                                                    </div>
                                                                    <div class="position-relative form-group col-3">
                                                                        <input type="radio" name="unit"
                                                                            value="k">
                                                                        <label>Không bảo hành</label>
                                                                    </div>
                                                                   
                                                                    <div class="col-md-12">
                                                                        <div class="position-relative form-group">
                                                                            <input type="number" name="warranty_day"
                                                                                placeholder="Nhập số ngày, tuần, tháng"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                    <label>Nội dung bảo hành cụ thể:</label>
                                                                    <div class="position-relative form-group">
                                                                        <textarea name="warranty_content" type="text" class="form-control"> </textarea>
                                                                    </div>
                                                            </div>
                                                                
                                                            @else
                                                                @if  ($item->status_work == 5 )
                                                                    
                                                                @else
                                                                <div class="col-md-8">
                                                                    <div class="row" style="width:100% !impotant">
                                                                        <div class="position-relative form-group col-3 ">
                                                                            <input type="radio" name="unit"
                                                                                checked value="d">
                                                                            <label>Ngày</label>
                                                                        </div>
                                                                        <div class="position-relative form-group col-3">
                                                                            <input type="radio" name="unit"
                                                                                value="w">
                                                                            <label>Tuần</label>
                                                                        </div>
                                                                        <div class="position-relative form-group col-3">
                                                                            <input type="radio" name="unit"
                                                                                value="m">
                                                                            <label>Tháng</label>
                                                                        </div>
                                                                        <div class="position-relative form-group col-3">
                                                                            <input type="radio" name="unit"
                                                                                value="k">
                                                                            <label>Không bảo hành</label>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-12">
                                                                            <div class="position-relative form-group">
                                                                                <input type="number" name="warranty_day"
                                                                                    placeholder="Nhập số ngày, tuần, tháng"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label>Nội dung bảo hành cụ thể:</label>
                                                                    <div class="position-relative form-group">
                                                                        <textarea name="warranty_content" type="text" class="form-control"> </textarea>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                             @endif
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                                {{-- xóa lịch đã phân --}}
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target=".xoalichdaphan{{ $item->id }}">Xóa
                                                    Lịch</button>
                                                @if ($item->income_total == 0)
                                                    <button type="button" class="btn btn-primary"
                                                        data-toggle="modal"
                                                        data-target=".tralichdaphan{{ $item->id }}">Trả
                                                        Lịch</button>
                                                @else
                                                @endif
                                                <button type="submit" class="btn btn-success">Cập Nhật</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- XÓA LỊCH ĐÃ PHÂN --}}
                            <div class="modal fade xoalichdaphan{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form
                                        action="{{ action('WorkHasController@deleteWorkHas', ['id' => $item->id]) }}"
                                        method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-content">
                                            <div class="modal-header text-center d-block">
                                                <h5 class="modal-title">Bạn có chắc chắn xóa lịch??
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                {{-- body --}}
                                                <div class="col-md-6 center d-block">
                                                    <div class="position-relative form-group"><label
                                                            class="check-thu-chi">Lý do:
                                                        </label><input name="real_note"
                                                            placeholder="Nhập lý do hủy.." type="text"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                {{-- end body --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Xác
                                                    Nhận</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- TRẢ LỊCH ĐÃ PHÂN --}}
                            <div class="modal fade tralichdaphan{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form
                                        action="{{ action('WorkHasController@reWorkHas', ['id' => $item->id]) }}"
                                        method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-content">
                                            <div class="modal-header text-center d-block">
                                                <h5 class="modal-title">Bạn có chắc chắn trả lịch??
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                {{-- body --}}
                                                <div class="col-md-6 center d-block">
                                                    <div class="position-relative form-group"><label
                                                            class="check-thu-chi">Lý do:
                                                        </label><input name="real_note"
                                                            placeholder="Nhập lý do trả lịch.." type="text"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                {{-- end body --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Xác
                                                    Nhận</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- CẬP NHẬT THỢ ĐÃ PHÂN --}}
                        <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                            aria-hidden="true" id="phantholichdp{{ $item->id }}">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('updateWorker', ['id' => $item->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Chọn thợ cần phân</h5>
                                        </div>
                                        <div class="modal-body">
                                            {{-- body --}}
                                            <div class="row">
                                                <input type="hidden" name="id_worker"
                                                    value="{{ $item->id_worker }}">
                                                    <input type="hidden" name="id_cus"
                                                    value="{{ $item->id_cus }}">
                                                <div class='col-sm-6 text-center'>
                                                    <label class='check-container1'>Thợ Chính :
                                                    </label>
                                                    <select name='id_worker' class='form-control'>
                                                        <option value="{{ $item->id_worker }}">{{ $item->worker_name }}</option>
                                                        @foreach ($worker as $itemWorker)
                                                            @switch($itemWorker->worker_name)
                                                                @case($item->worker_name)
                                                                @break

                                                                @default
                                                                    <option value="{{ $itemWorker->id }}">
                                                                        {{ $itemWorker->worker_name }}
                                                                    </option>
                                                            @endswitch
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class='col-sm-6 text-center'>
                                                    <label class='check-container1'>Thợ Phụ</label>
                                                    <select name='id_phu' class='form-control'>
                                                        <option value="0">Không</option>
                                                        {{-- @foreach ($worker as $itemWorker)
                                                            <option value="{{ $itemWorker->id }}">
                                                                {{ $itemWorker->worker_name }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- end body --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-primary">Xác
                                                Nhận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- SỬA LỊCH ĐÃ PHÂN --}}
                        <div class="modal fade" id="ELCDPS_{{ $item->id_cus }}" tabindex="-1" role="dialog"
                            aria-labelledby="modelTitleId" aria-hidden="true">

                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center d-block">
                                        <h5 class="modal-title">Thông Tin Lịch</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form action="{{ route('updateWork', ['id' => $item->id_cus]) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleAddress" class="check-thu-chi">Yêu Cầu
                                                                Công
                                                                việc</label><input name="work_content"
                                                                id="exampleAddress"
                                                                placeholder="Sửa nhà, điện nước, điện lạnh...."
                                                                type="text" class="form-control"
                                                                value="{{ $item->work_content }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleAddress2" class="check-thu-chi">Số
                                                                liên
                                                                hệ</label><input name="phone_number"
                                                                placeholder="0903532938" type="text"
                                                                class="form-control"
                                                                value="{{ $item->phone_number }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleAddress3" class="check-thu-chi">Địa
                                                                Chỉ</label><input name="street"
                                                                placeholder="184 Nguyễn Xí, P.26" type="text"
                                                                class="form-control"
                                                                value="{{ $item->street }}"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleAddress2">Quận</label><input
                                                                name="district" placeholder="Bình Thạnh" type="text"
                                                                class="form-control"
                                                                value="{{ $item->district }}" required></div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleEmail11">Tên
                                                                KH</label><input name="name_cus" placeholder="Tên"
                                                                type="text" class="form-control"
                                                                value="{{ $item->name_cus }}"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label
                                                                for="examplePassword11" class="">Ngày
                                                                Làm</label><input name="date_book"
                                                                placeholder="Ngày Làm" type="date"
                                                                class="form-control"
                                                                value="{{ $item->date_book }}"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="hidden" value="hihi" name="check_update">
                                                        <input type="hidden" value="{{ $item->id }}"
                                                            name="id_work_has">
                                                        <div class="position-relative form-group"><label
                                                                for="exampleAddress" class="">Ghi
                                                                chú</label><input name="real_note"
                                                                placeholder="Thang cao, cần 2 thợ...." type="text"
                                                                class="form-control"
                                                                value="{{ $item->real_note }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input type="radio" name="kind_work" id='1'
                                                                        value="0"
                                                                        @if ($item->kind_work == 0) checked @endif />
                                                                    <label class="form-check-label" for="1">
                                                                        Điện Nước
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input type="radio" name="kind_work" id="2"
                                                                        value="1"
                                                                        @if ($item->kind_work == 1) checked @endif>
                                                                    <label class="form-check-label" for="2">
                                                                        Điện Lạnh
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input type="radio" name="kind_work" id="3"
                                                                        value="2"
                                                                        @if ($item->kind_work == 2) checked @endif>
                                                                    <label class="form-check-label" for="3">
                                                                        Đồ Gỗ
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input type="radio" name="kind_work" id="4"
                                                                        value="3"
                                                                        @if ($item->kind_work == 3) checked @endif />
                                                                    <label class="form-check-label" for="4">
                                                                        Xây Dựng
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input type="radio" name="kind_work" id="5"
                                                                        value="4"
                                                                        @if ($item->kind_work == 4) checked @endif />
                                                                    <label class="form-check-label" for="5">
                                                                        Năng Lượng
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Sửa Lịch</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

