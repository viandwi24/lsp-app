@php
    if (auth()->check()) $menu = \App\Services\Dashboard::getSidebarMenu()[auth()->user()->role];
@endphp
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @foreach ($menu as $item)
                @if ($item['type'] == 'item')
                    @isset($item['match'])    
                        <li class="nav-item {{ request()->is($item['match']) ? 'active' : '' }}">
                    @else
                        <li class="nav-item {{ $item['link'] == url()->current() ? 'active' : '' }}">
                    @endisset
                        <a href="{{ $item['link'] }}">
                            <i class="{{ $item['icon'] }}"></i>
                            <span class="menu-title">{{ $item['text'] }}</span>
                        </a>
                    </li>                    
                @elseif($item['type'] == 'treeview')
                    <li class="nav-item">
                        <a href="#">
                            <i class="{{ $item['icon'] }}"></i>
                            <span class="menu-title">{{ $item['text'] }}</span>
                        </a>
                        <ul class="menu-content">
                            @foreach ($item['items'] as $subitem)
                                @isset($subitem['match'])    
                                    <li class="nav-item {{ request()->is($subitem['match']) ? 'active' : '' }}">
                                @else
                                    <li class="nav-item {{ $subitem['link'] == url()->current() ? 'active' : '' }}">
                                @endisset
                                <a class="menu-item" href="{{ $subitem['link'] }}">
                                    {{ $subitem['text'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                @elseif($item['type'] == 'header')
                    <li class="navigation-header">
                        <span>{{ $item['text'] }}</span>
                        <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"data-placement="right" data-original-title="User Interface"></i>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>