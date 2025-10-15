@if ($message = Session::get('success'))
    <div class="card-alert card gradient-45deg-green-teal">
        <div class="card-content white-text">
            <p>
                <i class="material-icons">check</i> موفقیت: {{ $message }}.
            </p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="card-alert card gradient-45deg-red-pink">
        <div class="card-content white-text">
            <p>
                <i class="material-icons dp48">error</i> هشدار: {{ $message }}.
            </p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="card-alert card gradient-45deg-green-teal">
        <div class="card-content white-text">
            <p>
                <i class="material-icons">check</i> موفقیت: {{ $message }}.
            </p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-light-info mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x close" data-dismiss="alert">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <strong>هشدار!</strong>
        {{ $message }}
    </div>
@endif
