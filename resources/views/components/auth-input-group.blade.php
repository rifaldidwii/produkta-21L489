<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                {{ $icon }}
            </span>
        </div>
        <input
            class="form-control"
            type="{{ $type == 'email' ? 'text' : $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            autocomplete="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            placeholder="{{ $placeholder }}"
            required
        >
    </div>
    <x-validation-error field="{{ $name }}"/>
</div>
