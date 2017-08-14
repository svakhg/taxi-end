<?php $__env->startSection('css'); ?>
    <style>
        .view .modal-dialog {
            width: 95%
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div id="display" style="padding:15px; overflow:auto; overflow-x:hidden;">
        </div>
    </div>
    <div class="container">
        <div class="modal fade" id="viewModal" role="dialog">
            <div class="view">
                <div class="modal-dialog">
                    <div id="viewDriverDetails">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script type="text/javascript">
    $(document).ready(function(){
        function loadDisplay(){
            $('#display').load('city-ajax',function () {
            });
        }
        loadDisplay();
    });

    function c_view(id){
        $('#viewDriverDetails').load('driver-ajax/'+id,function () {});
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.display', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>