@extends('layouts.ad')
@section('title')
    Danh sách bài viết  
@endsection
@section('content')

<div class="app-main__outer">
    <div class="app-main__inner mt-2">
            
        <div class="col-lg-12">
            <div class="main-card mb-2 card">
                <div class="card-body ">
                    <div class="row mb-2">
                        <div class="col text-center"><h5 class="card-title">Tất cả các bài viết</h5></div>
                        <a href=" {{ asset('admin/post/create') }}">    
                            <img src="{{url('icon/plus-circle-fill.svg')}}" alt="" srcset="" width="30px">
                        </a>
                    </div>
                    <table class="mb-0 table table-hover" id="tbDNC" >
                        <thead>
                            <tr class="text-center">
                                <th class="col-1">STT</th>
                                <th class="col-2">Tên bài viết</th>
                                <th class="col-3">Mô tả</th>
                                <th class="col-2">Hình Ảnh</th>
                                <th class="col-2">Tác giả</th>
                                <th class="col-2">Sửa Thông Tin</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($posts as $post)
                                <tr>
                                    <td> {{$post->id}}</td>
                                    <td> {{$post->title}}</td>
                                    <td> {{$post->description}}</td>
                                    <td> <img src="{{asset('').$post->image_post}}" alt="" srcset="" width="50" height="50"></td>
                                    <td> {{$post->name_author}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="post/show/{{$post->id}}">Sửa</a> 
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del{{ $post->id}}">
                                         Xóa
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="del{{ $post->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ action('PostsController@destroy', ['id' => $post->id]) }}" method="POST"> 
                                                        @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                        <button type="submit" class="btn btn-danger">Xóa bài viết</button>
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
</div>

<!-- Button trigger modal -->


{{-- <script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>

<script>
    $(document).ready( function () {
    var table = $('#tbDNC').DataTable({

        "ajaxSource": "{{url('admin/prices/getPriceList')}}",
        "columns": [
            { 'data': 'ID_price_list' },
            { 'data': 'name_price_list' },
            { 'data': 'info_price' },
            { 'data':  'price' },
            { 'data':   null,
                render: function(data, row, type ){
                    if(data.image_price == null || data.image_price == 'null' )
                    {
                        return `Chưa có hình`;
                    }
                    else
                        return data.image_price;
                }
            },
            { 'data':   null,
                render: function(data, row, type ){
                    if(data.note_price == null|| data.note_price == 'null')
                    {
                        return ` `;
                    }
                    else
                        return data.note_price;
                } },
            { 'data':  null,
                render: function(data, row, type ){

                return `
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelId`+data.id+`">
                    Sửa giá
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId`+data.id+`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog text-center" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Chọn thời gian nghỉ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form  action='{{url('admin/prices/updatePrice')}}' method='post' enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body ">
                                    <div class="form-row">
                                        <input type='hidden' value='`+data.id+`' name='id'>
                                        <div class="col-3">
                                            <label>Mã Bảng giá</label>
                                            <input type="text" class="form-control"  value="`+data.ID_price_list+`" name="ID_price_list" readonly> 
                                        </div>
                                        <div class="col-9">
                                            <label>Tên bảng giá</label>
                                            <input type="text" class="form-control"  value="`+data.name_price_list+`" name="name_price_list"> 
                                        </div>
                                    </div>
                                    <div class="form-row mt-2">
                                        <div class="col-4">
                                            <label>Giá</label>
                                            <input type="text" class="form-control"  value="`+data.price+`" name="price"> 
                                        </div>
                                        <div class="col-8">
                                            <label>Thông tin</label>
                                            <input type="text" class="form-control"  value="`+data.info_price+`" name="info_price"> 
                                        </div>
                                    </div>
                                    <div class="form-row mt-2">
                                        <div class="col-12">
                                            <label >Chọn hình ảnh:  </label>
                                            <input type="file" class='form-control' value="`+data.price+`" name="image"> 
                                            <label class="w3-button w3-blue w3-round">
                                            <span><i class="fas fa-image"></i></span>
                                            <input type="file" style="display: none" >
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row mt-2">
                                        <div class="col-12">
                                            <label for ="note_price">Ghi chú giá</label>
                                            <textarea name="note_price"  class="form-control" >`+data.note_price+` </textarea>
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
            }
            ]
        });
   // print(ajax)
});

</script> --}}



@endsection
