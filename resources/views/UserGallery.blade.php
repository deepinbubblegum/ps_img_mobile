<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @include('templates.tag_header')

    <link href="{{ asset('css/mobile.css') }}" rel="stylesheet">

</head>

<body>
    {{-- {{dd($folders)}} --}}
    <div>
        <div class="p-4 text-center div_top">
            <img src="{{ asset('images/logo_bran-removebg-preview.png') }}" class="img-fluid img_logo">
        </div>
        @php
            $counting = 0;
            // get domanname url
        @endphp
        
        @foreach ($folders as $key => $value)
            @if ($key % 2 == 0)
                <div class="py-2 px-4 div_preview_video">
                    <a class="card-a" href="view/{{$value->user_id}}/{{$value->path_dir}}">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-end text-black">
                                {{ date('d/M/Y h:i:s', strtotime($value->created_at)) }}
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <div class="py-2 px-4 div_preview_img">
                    <a class="card-a" href="view/{{$value->user_id}}/{{$value->path_dir}}">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-end text-black">
                                {{ date('d/M/Y h:i:s', strtotime($value->created_at)) }}
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
        <div class="footer_text py-4">
            <div class="text-center div_icon_bottom" hidden>
                <span class="me-3" id="btn_icon_dowload">
                    @include('component.icon_dowload')
                </span>
                <span class="ms-3">
                    @include('component.icon_mail')
                </span>

            </div>

            <div class="text-center div_text_bottom">
                <b>WOW photo created by PRO-toys</b>
                <br>
                www.protoys.online &ensp;|&ensp; LINE : @protoys &ensp;|&ensp; +66616169959
            </div>
        </div>
    </div>

</body>

</html>

<script></script>
