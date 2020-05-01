<div class="{{ $type == 'left' ? 'sidebar-left' : 'sidebar-right' }} {{ $sticky ? 'sidebar-sticky' : '' }}">
    <div class="sidebar">
        <div class="sidebar-content card d-none d-lg-block">
            <div class="d-block shadow p-2" style="height: calc(100vh - 7rem);">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>