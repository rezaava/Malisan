<div class="row">
    <a class="mt-1 mb-1 btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow tooltipped"
        data-position=@php print_r($pos) @endphp ;
         data-tooltip=@php print_r($text) @endphp ; 
         id="new_session"
        onmouseout="handleCloseNewSession()" onmouseover="handleNewSession()" onclick="handleNewSessionClick()">
        @php print_r($icon) @endphp
    </a>
</div>
<script>
    function handleNewSession() {
        $('#new_session').css({ 'width': '120px', 'height': '40px', 'border-radius': '4px', 'text-align': "center", 'padding': '3px 6px', 'line-height': '40px' });
        $('#new_session').html(["{{ $text }}"]);
    }
    function handleCloseNewSession() {
        $('#new_session').css({ 'width': '40px', 'height': '40px', 'border-radius': '50%', 'text-align': "center", 'padding': '0', 'line-height': '0' });
        $('#new_session').html(["@php print_r($icon) @endphp "]);
    }
    function handleNewSessionClick() {
        $('#new_session').css({ 'display': 'none' });
        $('#new_session_loader').css({ 'display': 'block', 'width': 'fit-content' });
        setTimeout(function () {
            window.location.href = ["{{ $url }}"]
            $('#new_session_loader').css({ 'display': 'none' });
            $('#new_session').css({ 'display': 'block' });
        }, 1500);
    }
</script>