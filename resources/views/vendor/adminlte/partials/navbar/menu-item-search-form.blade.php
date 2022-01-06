<form action="{{ $item['href'] }} " method="POST" class="form-inline mx-2">
    {{ csrf_field() }}
    <div class="input-group">
        <input class="form-control form-control-navbar" type="search" name="{{ $item['input_name'] }}"
               placeholder="{{ $item['text'] }} " aria-label="{{ $item['aria-label'] ?? $item['text'] }}" value="{{ old('q') }}">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

