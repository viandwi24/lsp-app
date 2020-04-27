<script>
    @if (session('alert'))
        toastr.{{ session("alert")["type"] }}('{{ session("alert")["text"] }}', '{{ session("alert")["title"] }}')
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}', 'Error');
        @endforeach
    @endif
</script>