@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            display: block;
            margin: 0 0 -.25rem -.25rem;
            padding: 0;
        }

        .select2-container--classic .select2-selection--multiple {
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            box-shadow: 0 3px 2px rgb(233 236 239 / 5%);
        }

        .select2-container .select2-selection--multiple {
            min-height: calc(1.5em + 1.25rem + 2px);
        }

    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{ $slot }}
@endpush
