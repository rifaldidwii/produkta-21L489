@push('scripts')
    <script src="{{ asset('impact/dashboard/assets/vendor/moment.min.js') }}"></script>
    <script
        src="{{ asset('impact/dashboard/assets/vendor/bootstrap-datetimepicker.js') }}">
    </script>

    {{ $slot }}
@endpush
