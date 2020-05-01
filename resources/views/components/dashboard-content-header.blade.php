@php
    if (!isset($type)) $type = 'basic';
    if (!isset($autoBread)) $autoBread = true;
@endphp

@if ($type == 'basic')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-1">
            <h3 class="content-header-title">{{ $title }}</h3>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    @isset($breadcrumb)
                        @foreach ($breadcrumb as $item)
                            @isset($item['link'])
                                <li class="breadcrumb-item">
                                    <a href="{{ $item['link'] }}">{{ $item['text'] }}</a>
                                </li>
                            @else
                            <li class="breadcrumb-item">{{ $item['text'] }}</li>
                            @endisset
                        @endforeach
                    @endisset
                    @if ($autoBread)
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>

@elseif ($type == '2-col')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">{{ $title }}</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        @isset($breadcrumb)
                            @foreach ($breadcrumb as $item)
                                @isset($item['link'])
                                    <li class="breadcrumb-item">
                                        <a href="{{ $item['link'] }}">{{ $item['text'] }}</a>
                                    </li>
                                @else
                                <li class="breadcrumb-item">{{ $item['text'] }}</li>
                                @endisset
                            @endforeach
                        @endisset
                        @if ($autoBread)
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            {!! (isset($slot)) ? $slot : '' !!}
        </div>
    </div>

@elseif($type == 'basic-bottom')
    <div class="content-header row">
        <div class="content-header-left col-12 mb-2">
            <h3 class="content-header-title">{{ $title }}</h3>
            <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    @isset($breadcrumb)
                        @foreach ($breadcrumb as $item)
                            @isset($item['link'])
                                <li class="breadcrumb-item">
                                    <a href="{{ $item['link'] }}">{{ $item['text'] }}</a>
                                </li>
                            @else
                            <li class="breadcrumb-item">{{ $item['text'] }}</li>
                            @endisset
                        @endforeach
                    @endisset
                    @if ($autoBread)
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif
                </ol>
            </div>
            </div>
        </div>
    </div>
@endif