@extends('layouts.ad')
@section('title')
    Banner App
@endsection
@section('content')
<div class="row container" >
    <div class="col-12">
        <div class="mt-2 card">
            <div class="form-row mt-3">
                @if (session('status'))
                <h6 class="alert alert-success text-center">{{ session('status') }}</h6>
                @endif
                <div class="col-10 text-center">
                    <h5 class="card-title">Tất cả các bài viết</h5></div>
                <div class="col-2 text-center">
                    <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                        <img src="{{url('icon/plus.svg')}}" alt="" srcset="" width="30px">
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ asset('admin/view-app/store') }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                            <h5 class="modal-title">Thêm Thông tin</h5>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="content_view_sale" id="" cols="30" rows="10" class="form-control"></textarea>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <label for="" class="mt-2">Thơi gian bắt đầu </label>
                                                <input type="date" name="time_begin" class="form-control" required>
                                            </div>
                                            <div class="col-6"> 
                                                <label for="" class="mt-2">Thơi gian kế thúc </label>
                                                <input type="date" name="time_end" class="form-control" required>
                                            </div>
                                            <div class="col-4 mt-2"><label for="" >% khuyến mãi </label></div>
                                            <div class="col-8 mt-2"><input type="number" name="sale_percent" class="form-control"></div>
                                            <div class="col-4 mt-2"><label for="imag" >Chon hình ảnh: </label></div>
                                            <div class="col-6 mt-2"><input type="text" class="form-control" name="image_path" id="urlUpdate1" readonly></div>
                                            <div class="col-2 mt-2">
                                                <button class="btn btn-outline-success my-2 my-sm-0" onclick="openPopupUpdate()" type="button">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                     </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="mt-2 container card">
                <table class="table-hover table text-center">
                    <thead>
                        <tr>
                            <th colspan="1">No</th>
                            <th colspan="5">Nội dung</th>
                            <th colspan="1">% Khuyến mãi</th>
                            <th colspan="1">Hình Ảnh</th>
                            <th colspan="1">Bắt đầu</th>
                            <th colspan="1">Kết thúc</th>
                            
                            <th colspan="1">Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewsale as $item)
                        <tr>
                            <td colspan="1" > {{ $item->id }}</td>
                            <td colspan="5"> 
                                @if ($item->content_view_sale )
                                    {{ $item->content_view_sale }}
                                @else
                                    Chương trình là banner
                                @endif 
                            </td>
                            <td colspan="1" > {{ $item->sale_percent }}</td>
                            <td colspan="1" >
                                @if ($item->image_path)
                                    <img src="{{asset('')}}{{$item->image_path}}" alt="" width="50" height="50">
                                @else
                                    Không có hình
                                @endif
                                 
                            
                            </td>
                            <td colspan="1" > {{ $item->time_begin }}</td>
                            <td colspan="1" > {{ $item->time_end }}</td>
                            <td colspan="1">  
                               
                                <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#suanoidung{{$item->id}}">
                                  Sửa nội dung
                                </button>
                                
                                <div class="modal fade" id="suanoidung{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ asset('admin/view-app/update') }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                        <h5 class="modal-title">Sửa Thông tin</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden"  value="{{$item->id}}"  name="id">
                                                    <div class="form-row">
                                                        <div class="col-6">
                                                            <label for="" class="mt-2">Thơi gian bắt đầu </label>
                                                            <input type="date" name="time_begin" class="form-control" value="{{ $item->time_begin }}">
                                                        </div>
                                                        <div class="col-6"> 
                                                            <label for="" class="mt-2">Thơi gian kế thúc </label>
                                                            <input type="date" name="time_end" class="form-control" value="{{ $item->time_end }}">
                                                        </div>
                                                    </div>
                                                    @if ($item->content_view_sale != null)
                                                    <input type="hidden" name='flag' value="0">
                                                        <textarea name="content_view_sale" id="" cols="30" rows="10" class="form-control mt-2">{{ $item->content_view_sale }}</textarea>
                                                    @else
                                                        <div class="form-row">
                                                            <input type="hidden" name='flag' value="1">
                                                            <div class="col-6 mt-2"><input type="text" class="form-control" name="image_path" id="urlUpdate2" readonly></div>
                                                            <div class="col-4 mt-2">
                                                                <button class="btn btn-outline-success " onclick="openPopupUpdate2()" type="button">Chọn hình ảnh</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                                 </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>




    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
    <script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        function openPopupUpdate() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {
                    // ID 1
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById('urlUpdate1').value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById('urlUpdate1').value = evt.data.resizedUrl;
                    });

                }
            });
        }
        function openPopupUpdate2() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {
                    // ID 1
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById('urlUpdate2').value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById('urlUpdate2').value = evt.data.resizedUrl;
                    });

                }
            });
        }

        
    </script>
@endsection
