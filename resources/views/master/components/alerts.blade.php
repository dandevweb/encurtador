@if (session('success'))
    {{ alert('success', session('success')) }}
@endif

@if (session('error'))
    {{ alert('error', session('error')) }}
@endif

@if (session('warning'))
    {{ alert('warning', session('warning')) }}
@endif
