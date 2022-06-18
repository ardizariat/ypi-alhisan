<div class="col-md-4">
    <label>{{ $label }}</label>
</div>
<div class="col-md-8">
    <div class="form-group">
        <div class="position-relative">
            <input value="{{ $value ?? '' }}" name="{{ $name ?? '' }}" autocomplete="off" type="{{ $type ?? '' }}"
                class="form-control">
        </div>
    </div>
</div>
