<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="{{ $name }}">{{ $label }}</label>
            @if ($type == 'text' || $type == 'number' || $type == 'email' || $type == 'password')
                <input
                    class="form-control @error($name) is-invalid @enderror"
                    type="{{ $type }}"
                    id="{{ $name }}"
                    name="{{ $name }}"
                    autocomplete="{{ $name }}"
                    value="{{ $value ?? old($name) }}"
                >
            @elseif ($type == 'file')
                <input
                    class="form-control"
                    type="{{ $type }}"
                    id="{{ $name }}"
                    name="{{ $name }}"
                    onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"
                >
            @elseif ($type == 'datepicker')
                <input
                    class="form-control datepicker @error($name) is-invalid @enderror"
                    type="text"
                    data-date-format="yyyy-mm-dd"
                    id="{{ $name }}"
                    name="{{ $name }}"
                    value="{{ $value ?? old($name) }}"
                >
            @elseif ($type == 'select-single')
                <select class="form-control" id="{{ substr($name, -2) == '[]' ? substr($name, 0, -2) : $name }}" name="{{ $name }}">
                    {{ $option }}
                </select>
            @elseif ($type == 'select-multiple')
                <select class="form-control" id="{{ $name }}" name="{{ $name }}[]" multiple>
                    {{ $option }}
                </select>
            @elseif ($type == 'checkbox')
                {{ $option }}
            @elseif ($type == 'textarea')
                <textarea class="form-control" id="{{ $name }}" name="{{ $name }}" rows="8">{!! $value !!}</textarea>
            @elseif ($type == 'color')
                <br>
                <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                    <label class="btn bg-info active">
                        <input type="radio" id="{{ $name }}" name="{{ $name }}" value="#11cdef" autocomplete="off" checked="checked">
                    </label>
                    <label class="btn bg-warning">
                        <input type="radio" id="{{ $name }}" name="{{ $name }}" value="#fb6340" autocomplete="off">
                    </label>
                    <label class="btn bg-danger">
                        <input type="radio" id="{{ $name }}" name="{{ $name }}" value="#f5365c"autocomplete="off">
                    </label>
                    <label class="btn bg-success">
                        <input type="radio" id="{{ $name }}" name="{{ $name }}" value="#2dce89" autocomplete="off">
                    </label>
                    <label class="btn bg-default">
                        <input type="radio" id="{{ $name }}" name="{{ $name }}" value="#172b4d"autocomplete="off">
                    </label>
                    <label class="btn bg-primary">
                        <input type="radio" id="{{ $name }}" name="{{ $name }}" value="#0a48b3" autocomplete="off">
                    </label>
                </div>
            @endif
            <x-validation-error field="{{ $name }}"/>
        </div>
    </div>
</div>
