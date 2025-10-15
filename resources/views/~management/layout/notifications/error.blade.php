@if ($errors->any())
    <div class="alert alert-info alert-block">

        {{ implode('', $errors->all(':message')) }}
    </div>
@endif
