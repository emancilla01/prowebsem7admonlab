<form class="d-flex my-2 my-lg-0" method="GET" action="{{ $action ?? url()->current() }}">
    <input
        class="form-control me-sm-2"
        type="search"
        name="{{ $name ?? 'q' }}"
        value="{{ request($name ?? 'q') }}"
        placeholder="{{ $placeholder ?? 'Search' }}"
        aria-label="search"
    />
    @if(isset($model))
        <input type="hidden" name="model" value="{{ $model }}" />
    @endif
    <button class="btn btn-outline-success my-2 my-sm-0 ms-2" type="submit">
        {{ $buttonText ?? 'Search' }}
    </button>
</form>
