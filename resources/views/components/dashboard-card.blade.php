<div class="card">
    <div class="card-header pb-2">
        <h4 class="card-title">{{ $title }}</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                {{ @$heading }}
            </ul>
        </div>
    </div>



    <div class="card-content collapse show">
        {{ @$content }}

        <div class="card-body card-dashboard pt-0 {{ (isset($classBody) ? $classBody : '')}}">
            {{ @$slot }}
        </div>
        @isset($footer)
            <div class="card-footer {{ (isset($classFooter) ? $classFooter : '') }}">
                {{ @$footer }}
            </div>        
        @endisset
    </div>
</div>