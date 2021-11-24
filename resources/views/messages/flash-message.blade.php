@section('scripts')
    @if ($message = Session::get('success'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                text: '{{ $message }}',
            })
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                text: '{{ $message }}',
            })
        </script>

    @endif

    @if ($message = Session::get('warning'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'warning',
                text: '{{ $message }}',
            })
        </script>
    @endif

    @if ($message = Session::get('info'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'info',
                text: '{{ $message }}',
            })
        </script>
    @endif

    @if ($errors->any())
        <div class="text-danger">
            Error, check input data and try again.
        </div>
    @endif
@endsection
