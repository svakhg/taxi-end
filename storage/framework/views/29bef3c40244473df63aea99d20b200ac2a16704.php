<?php $__currentLoopData = $taxis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$taxi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-2">
        <div class="box" style="
                <?php
                if($taxi->state == '0') {
                    echo 'background-color: #e74c3c';
                } elseif ($taxi->state == '1' && strtotime($taxi->anualFeeExpiry) > time() && strtotime($taxi->roadWorthinessExpiry) > time() && strtotime($taxi->insuranceExpiry) > time() ){
                    echo 'background-color: #1abc9c';
                } elseif (strtotime($taxi->anualFeeExpiry) < time() || strtotime($taxi->roadWorthinessExpiry) < time() || strtotime($taxi->insuranceExpiry) < time()) {
                    echo 'background-color: #9b59b6';
                }
                ?>
            ">
            <center>
            <h4>Taxi No: <?php echo e($taxi->taxiNo); ?></h4>
            <h3><?php echo e($taxi->callcode->callCode); ?></h3>
            <h4><?php echo e($taxi->driver->driverName); ?></h4>
            </center>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

