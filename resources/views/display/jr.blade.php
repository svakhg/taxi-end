@extends('layouts.display')

@section('content')
    <div class="row">
        <div id="display" style="padding:15px; overflow:auto; overflow-x:hidden;">
        </div>
    </div>
    
<script type="text/javascript">
$(document).ready(function(){
    function loadDisplay(){
        $('#display').load('jr-ajax',function () {
        });
    }
    loadDisplay();
    setInterval(function(){
        loadDisplay() 
    }, 5000);
});
</script>
@endsection