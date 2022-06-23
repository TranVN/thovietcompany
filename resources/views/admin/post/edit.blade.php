@extends('layouts.ad')
@section('title')
    Danh sách bài viết  
@endsection
@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        @if (session('status'))
        <h6 class="alert alert-success text-center">{{ session('status') }}</h6>
        @endif
        <div class="col-lg-12">
            <div class="main-card mb-2 card">
                @foreach($post as $item)
                <form action="{{ route('editPost', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header text-center"> <h4>Sửa bài viết</h4></div>
                    <div class="card-body ">
                        <input type="text " class="form-control" name="title" id="title" required placeholder="Tên Bài Viết" value="{{$item->title}}">
                        <hr>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control" placeholder="Mô tả ngắn" >{{$item->description}}</textarea>
                        <hr>
                        <textarea  class="form-control" name="content" cols="50" rows="20" id="content" >{{$item->content}} </textarea>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <label for="image_post"> Chọn hình ảnh:</label> --}}
                                <input id="ckfinder-input-2" type="text" name="image_path" class="form-control" placeholder="Thay đổi ảnh bìa">

                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('').$item->image_post}}" alt=""  height="100" width="150">
                            </div>
                        </div>
                       
                    </div>
                   
                    <div class="card-footer text-end">
                        <button class="btn-sm btn-success" type="submit"> Lưu </button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>

    </div>
</div>
<!-- Button trigger modal -->
<script>
    
     CKEDITOR.replace( 'content', {
       
        filebrowserBrowseUrl     : "{{ route('ckfinder_browser') }}",
        filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
        filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123", 
        filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files", 
        filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
		
        
    });
</script>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
<script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        function openPopup() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById('url').value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById('url').value = evt.data.resizedUrl;
                    });
                }
            });
        }
        var button1 = document.getElementById( 'ckfinder-input-2' );


    button1.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-2' );
    };
 
    function selectFileWithCKFinder( elementId ) {
        CKFinder.popup( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    var output = document.getElementById( elementId );
                    output.value = file.getUrl();
                } );

                finder.on( 'file:choose:resizedImage', function( evt ) {
                    var output = document.getElementById( elementId );
                    output.value = evt.data.resizedUrl;
                } );
            }
        } );
    }
    </script>

@endsection
