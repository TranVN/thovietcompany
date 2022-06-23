@extends('layouts.ad')
@section('title')
    Banner App
@endsection
@section('content')
<div class="row container-fluid " >
    <div class="col-6">
        <div class="mt-2">
            <div class="card">
                <div class="title-lich"><h3>BANNER DƯỚI</h3></div>
            </div>
            <div class="mt-2 container card">
                <table class="table-hover table text-center">
                    <thead>
                        <tr>
                            <th colspan="1">No</th>
                            <th colspan="4">Vị trí</th>
                            <th colspan="3">Hình</th>
                            <th colspan="2">Sửa</th>
                            <th colspan="2">Cập Nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banner1 as $item)
                        <form action="{{ route('updateBanner', ['id' => $item->id]) }}"method="POST">
                                @csrf
                        <tr>
                            <td colspan="1" > {{ $item->id }}</td>
                            <td colspan="4">  <input size="48" name="image" id="urlUpdate{{$item->id}}" value="{{ $item->image_path }}"  readonly class="form-control"/> </td>
                            <td colspan="3">   <img src="{{ asset($item->image_path) }}" height="50" width="50"></td>
                            <td colspan="2">  <button class="btn btn-outline-success my-2 my-sm-0" onclick="openPopupUpdate{{$item->id}}()"
                                type="button">Edit</button></td>
                            <td colspan="2">   <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Cập Nhật Banner</button></td>
                        </tr>
                        </form>
                        @endforeach
                        @foreach ($banner2 as $item)
                        <form action="{{ route('updateBanner', ['id' => $item->id]) }}"method="POST">
                                @csrf
                        <tr>
                            <td colspan="1" > {{ $item->id }}</td>
                            <td colspan="4">  <input size="48" name="image" id="urlUpdate{{$item->id}}" value="{{ $item->image_path }}"  readonly class="form-control"/> </td>
                            <td colspan="3">   <img src="{{ asset($item->image_path) }}" height="50" width="50"></td>
                            <td colspan="2">  <button class="btn btn-outline-success my-2 my-sm-0" onclick="openPopupUpdate{{$item->id}}()"
                                type="button">Edit</button></td>
                            <td colspan="2">   <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Cập Nhật Banner</button></td>
                        </tr>
                        </form>
                        @endforeach
                        @foreach ($banner3 as $item)
                        <form action="{{ route('updateBanner', ['id' => $item->id]) }}"method="POST">
                                @csrf
                        <tr>
                            <td colspan="1" > {{ $item->id }}</td>
                            <td colspan="4">  <input size="48" name="image" id="urlUpdate{{$item->id}}" value="{{ $item->image_path }}"  readonly class="form-control"/> </td>
                            <td colspan="3">   <img src="{{ asset($item->image_path) }}" height="50" width="50"></td>
                            <td colspan="2">  <button class="btn btn-outline-success my-2 my-sm-0" onclick="openPopupUpdate{{$item->id}}()"
                                type="button">Edit</button></td>
                            <td colspan="2">   <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Cập Nhật Banner</button></td>
                        </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="mt-2">
            <div class="card">
                <div class="title-lich"><h3>BANNER TRÊN</h3></div>
            </div>
            <div class="mt-2 container card">
                <table class="table-hover table text-center">
                    <thead>
                        <tr>
                            <th colspan="1">No</th>
                            <th colspan="4">Vị trí</th>
                            <th colspan="3">Hình</th>
                            <th colspan="2">Sửa</th>
                            <th colspan="2">Cập Nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banner4 as $item)
                        <form action="{{ route('updateBanner', ['id' => $item->id]) }}"method="POST">
                                @csrf
                        <tr>
                            <td colspan="1" > {{ $item->id }}</td>
                            <td colspan="4">  <input size="48" name="image" id="urlUpdate{{$item->id}}" value="{{ $item->image_path }}"  readonly class="form-control"/> </td>
                            <td colspan="3">   <img src="{{ asset($item->image_path) }}" height="50" width="50"></td>
                            <td colspan="2">  <button class="btn btn-outline-success my-2 my-sm-0" onclick="openPopupUpdate{{$item->id}}()"
                                type="button">Edit</button></td>
                            <td colspan="2">   <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Cập Nhật Banner</button></td>
                        </tr>
                        </form>
                        @endforeach
                        @foreach ($banner5 as $item)
                        <form action="{{ route('updateBanner', ['id' => $item->id]) }}"method="POST">
                                @csrf
                        <tr>
                            <td colspan="1" > {{ $item->id }}</td>
                            <td colspan="4">  <input size="48" name="image" id="urlUpdate{{$item->id}}" value="{{ $item->image_path }}"  readonly class="form-control"/> </td>
                            <td colspan="3">   <img src="{{ asset($item->image_path) }}" height="50" width="50"></td>
                            <td colspan="2">  <button class="btn btn-outline-success my-2 my-sm-0" onclick="openPopupUpdate{{$item->id}}()"
                                type="button">Edit</button></td>
                            <td colspan="2">   <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Cập Nhật Banner</button></td>
                        </tr>
                        </form>
                        @endforeach
                        @foreach ($banner6 as $item)
                        <form action="{{ route('updateBanner', ['id' => $item->id]) }}"method="POST">
                                @csrf
                        <tr>
                            <td colspan="1" > {{ $item->id }}</td>
                            <td colspan="4">  <input size="48" name="image" id="urlUpdate{{$item->id}}" value="{{ $item->image_path }}"  readonly class="form-control"/> </td>
                            <td colspan="3">  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                              </svg></td>
                            <td colspan="2"> <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#modelId">
                              Chọn
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <h5 class="modal-title">Đường dẫn media</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>

                                                        </button>
                                                </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <input size="48" name="image" id="" placeholder="Nhập đường dẫn" class="form-control" />

                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div></td>
                            <td colspan="2">   <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Cập Nhật Banner</button></td>
                        </tr>
                        </form>
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

        function openPopupUpdate1() {
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

                    // ID 2
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
        function openPopupUpdate3() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {

                    // ID 3
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById('urlUpdate3').value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById('urlUpdate3').value = evt.data.resizedUrl;
                    });
                }
            });
        }
        function openPopupUpdate4() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {

                    // ID 3
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById('urlUpdate4').value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById('urlUpdate4').value = evt.data.resizedUrl;
                    });
                }
            });
        }
        function openPopupUpdate5() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {

                    // ID 3
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById('urlUpdate5').value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById('urlUpdate5').value = evt.data.resizedUrl;
                    });
                }
            });
        }
        function openPopupUpdate6() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {

                    // ID 3
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById('urlUpdate6').value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById('urlUpdate6').value = evt.data.resizedUrl;
                    });
                }
            });
        }
    </script>
@endsection
