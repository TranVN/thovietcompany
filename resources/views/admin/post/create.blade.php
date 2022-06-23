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
                <form action="{{asset('admin/post/store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header text-center"> <h4>Thêm bài viết mới</h4></div>
                    <div class="card-body ">
                        <input type="text " class="form-control" name="title" id="title" required placeholder="Tên Bài Viết">
                        <hr>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control" placeholder="Mô tả ngắn"></textarea>
                        <hr>
                        <textarea  class="form-control" name="content" cols="50" rows="20" id="content" > </textarea>
                        <hr>
                        <input id="ckfinder-input-2" type="text" style="width:60%" name="image_path" placeholder="Vui lòng chọn ảnh">
		                {{-- <button id="ckfinder-popup-2" class="btn btn-outline-success my-2 my-sm-0" type="button">Browse Server</button> --}}
                    </div>
                   
                    <div class="card-footer text-end">
                        <button class="btn-sm btn-success" type="submit"> Lưu </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- Button trigger modal -->
<script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>
<script>
    
     CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl     : "{{ route('ckfinder_browser') }}",
        filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
        filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123", 
        filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files", 
        filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
		
        
    });
    // function escapeHtml(unsafe) {
	// 	return unsafe
	// 		.replace(/&/g, "&amp;")
	// 		.replace(/</g, "&lt;")
	// 		.replace(/>/g, "&gt;")
	// 		.replace(/"/g, "&quot;")
	// 		.replace(/'/g, "&#039;");
	// }
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
