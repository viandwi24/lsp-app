@php
    $cols = '';
    $col = explode(',', $col);
    foreach ($col as $item) {
        $cols .= 'col-' . $item . ' ';
    }
@endphp
<div class="{{ $cols }}">
    <div class="card pull-up">
        <div class="card-content">
            <div class="media align-items-stretch">
                <div class="p-2 text-center {{ $bg }} rounded-left">
                    <i class="{{ $icon }} font-large-2 text-white"></i>
                </div>
                <div class="p-2 media-body">
                    <h3 class="{{ $fg }}">{{ $value }}</h3>
                    <span class="text-bold-500 mb-0">{{ $title }}</span>
                </div>
            </div>
        </div>
    </div>
</div>