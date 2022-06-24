<button class= "btn btn-danger btn-new-work" id="btn-new-work" onclick="showNewWork()"><i class="fa fa-plus"></i></button>
<div class="new-work" id="new-work" style="display: none;">
   <div class="new-work-title">Thêm khách hàng mới</div> 
   <div class="p-3">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('addWork')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="position-relative form-group"><label for="exampleAddress" class="">Yêu Cầu Công việc</label><input  name="work_content" id="exampleAddress" placeholder="Vui lòng nhập nội dung công việc" type="text" class="form-control" required></div>
                        <div class="position-relative form-group"><label for="exampleAddress3" class="">Địa Chỉ</label><input name="street" placeholder="Vui lòng nhập địa chỉ" type="text" class="form-control" ></div>
                        <div class="position-relative form-group"><label for="exampleAddress2" class="">Quận</label><input name="district"  placeholder="Vui lòng nhập quận" type="text" class="form-control" required></div>
                        <div class="position-relative form-group"><label for="exampleAddress" class="">Ghi chú</label><input name="work_note"  placeholder="Vui lòng nhập ghi chú" type="text" class="form-control"></div>
                        <div class="position-relative form-group"><label for="exampleAddress2" class="">Số liên hệ</label><input name="phone_number"  placeholder="Vui lòng nhập số điện thoại" type="text" class="form-control" required>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="exampleEmail11" class="">Tên KH</label><input name="name_cus"  placeholder="Vui lòng nhập tên" type="text" class="form-control"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="examplePassword11" class="">Ngày Làm</label><input name="date_book" placeholder="Ngày Làm" type="date" class="form-control" value="{{ date('d-m-Y') }}"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" name="kind_work" id='1' value="0" checked/>
                                            <label class="form-check-label" for="1">
                                                Điện Nước
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" name="kind_work" id="2"  value="1"  >
                                            <label class="form-check-label" for="2">
                                                Điện Lạnh
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" name="kind_work" id="3" value="2"  >
                                            <label class="form-check-label" for="3">
                                                Đồ Gỗ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" name="kind_work" id="4"  value="3"  />
                                            <label class="form-check-label" for="4">
                                                Xây Dựng
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <input type="radio" name="kind_work"  id="5" value="4"  />
                                            <label class="form-check-label" for="5">
                                                Năng Lượng Và Khác
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="mt-2 btn btn-primary btn-block" type="submit" >Thêm</button>
                    </form>
                </div>
            </div>
    </div>
</div>

<script>
function showNewWork() {
  var x = document.getElementById("new-work");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
