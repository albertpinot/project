@if(request()->ajax())
    @yield("content")
    
@else
    @include('layouts.full')
@endif

@if(Session::has('toastr'))
        <script>
            $(document).ready(function(){
                toastr.{{Session::get('toastr')['status']}}('{{Session::get('toastr')['message']}}')
            });
        </script>
@endif