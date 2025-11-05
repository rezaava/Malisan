@if ($errors->any())
    <div class="alert alert-info alert-block text-danger" style="color:red !important; " >

    *-    {{ implode('', $errors->all(':message')) }}
    </div>
@endif
