<?php $__env->startSection('content'); ?>
    <div class="row">
        <div id="display" style="padding:15px; overflow:auto; overflow-x:hidden;">
        </div>
    </div>
    
<script type="text/javascript">
$(document).ready(function(){
    function loadDisplay(id){
        $('#display').load('city-ajax?id='+id,function () {
        });
    }
    loadDisplay(1);
    setInterval(function(){
        loadDisplay(1) 
    }, 5000);
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.display', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>