@extends('index')

@section('scripts')
    <script src="/js/paint.js"></script>
@endsection
@section('styles')
    <link href="/css/paint.css" rel="stylesheet">
@endsection

@section('body')
    <div class="app">
        <div class="toolbar">
            <div class="toolbar_row">Color
                <input type="color" id="color_pick">
            </div>
            <div class="toolbar_row">Size
                <input type="number" id="drawer_size" min="1" max="32">
            </div>
            <div class="toolbar_row">
                <input type="button" value="ERASER" id="toggle_eraser">
            </div>
            <div class="toolbar_row">
                <input type="file" id="image" accept="image/jpeg">
                <input type="button" value="add to canvas" id="add_image">
            </div>
            <div class="toolbar_row">
                <input type="button" id="save_image" value="Сохранить">
            </div>
        </div>
        <div class="canvas_body">
            <canvas width="1024" height="1024" id="paint_canvas"></canvas>
        </div>
        <div class="gallery">
            @foreach($files as $fileUrl)
                <div class="image_icon">
                    <img class="image" src="{{ $fileUrl }}" ></img>
                </div>
            @endforeach
        </div>
    </div>

@endsection