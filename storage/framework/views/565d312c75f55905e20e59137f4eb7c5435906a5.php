<?php $__env->startSection('css'); ?>
    <style>
        .view .modal-dialog {
            width: 95%
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<script>
    $(document).ready(function() {
            var dataSrc = [];

            $.fn.dataTable.ext.buttons.add = {
                text: 'Add',
                action: function () {
                    $('#addModal').modal({ show: false})
                    $('#addModal').modal('show');
                }
            };
            $('#driver').DataTable({
                'initComplete': function(){
                    var api = this.api();
                    api.cells('tr', [0, 1, 2, 3, 4, 5, 6, 7, 8 ,9]).every(function(){
                        var data = this.data();
                        if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
                });
                $('.dataTables_filter input[type="search"]', api.table().container())
                    .typeahead({
                        source: dataSrc,
                        afterSelect: function(value){
                            api.search(value).draw();
                        }
                    }
                    );
                },


                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                        {
                        extend: 'add',
                        className: 'btn btn-success',
                    },
                        {
                        extend: 'print',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                        {
                        extend: 'csv',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                        {
                        extend: 'excel',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                        {
                        extend: 'pdf',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                        {
                        extend: 'colvis',
                        className: 'btn btn-success',
                    },
                ],
                columnDefs: [ {
                    targets: false,
                    visible: false
                } ]
            });


    });
</script>
<ul class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li class="active">Driver</li>
</ul>    

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Drivers</h3>
    </div>
    <div class="panel-body">
        <div class="row">                
            <div class="col-md-12">
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo e($message); ?></strong>
                    </div>
                <?php endif; ?>
                <table id="driver" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Taxi No</th>
                            <th>Driver Name</th>
                            <th>Driver Licence No.</th>
                            <th>Driver Licence Expiry</th>
                            <th>Driver Permit No.</th>
                            <th>Driver Permit Expiry</th>
                            <th>Driver Mobile</th>
                            <th>Driver Id Card</th>
                            <th>Driver Perm Address</th>
                            <th>Driver Temp Address</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>                            
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($driver->taxi->taxiNo); ?></td>
                            <td><?php echo e($driver->driverName); ?></td>
                            <td><?php echo e($driver->driverLicenceNo); ?></td>
                            <td><?php echo e($driver->driverLicenceExp); ?></td>
                            <td><?php echo e($driver->driverPermitNo); ?></td>
                            <td><?php echo e($driver->driverPermitExp); ?></td>
                            <td><?php echo e($driver->driverMobile); ?></td>
                            <td><?php echo e($driver->driverIdNo); ?></td>
                            <td><?php echo e($driver->driverPermAdd); ?></td>
                            <td><?php echo e($driver->driverTempAdd); ?></td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="c_view('<?php echo e($driver->id); ?>')">View</button>
                            </td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="c_edit('<?php echo e($driver->id); ?>')">Edit</button>
                            </td>                                
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-danger" onclick="c_delete('<?php echo e($driver->id); ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>        
</div>                               

<div class="modal fade" id="viewModal" role="dialog">
    <div class="view">
        <div class="modal-dialog">
            <div id="viewDriverDetails">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Record</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="form-group">
                    <label class="control-label" for="driverPhoto">Add Driver Photo</label>
                    <input type='file' name="photoUrl" id="imgInp" />
                    <img id="imgOut" src="#" class="img-responsive" alt="your image" />
                </div>                    
                <script>
                    function readURL(input) {

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#imgOut').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#imgInp").change(function(){
                        readURL(this);
                    });
                </script>
                <div class="form-group">
                    <label class="control-label" for="name">Taxi No</label>
                    <select class="form-control" name="taxi_id">
                        <?php $__currentLoopData = $taxis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($taxi->id); ?>">Taxi No - ( <?php echo e($taxi->taxiNo); ?> ) Callcode - ( <?php echo e($taxi->callcode->callCode); ?> ) </option>    
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverName">Driver Name</label>
                    <input type="text" name="driverName" id="driverName" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverIdNo">Driver Id Card No</label>
                    <input type="text" name="driverIdNo" id="driverIdNo" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverPermAdd">Driver Perm Address</label>
                    <input type="text" name="driverPermAdd" id="driverPermAdd" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverTempAdd">Driver Temp Address</label>
                    <input type="text" name="driverTempAdd" id="driverTempAdd" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="driverMobile">Driver Mobile</label>
                    <input type="text" name="driverMobile" id="driverMobile" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverEmail">DriverEmail</label>
                    <input type="text" name="driverEmail" id="driverEmail" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverLicenceNo">Driver Licence No</label>
                    <input type="text" name="driverLicenceNo" id="driverLicenceNo" class="form-control">
                </div>

                <div class="form-group" style="z-index:2151 !important;">
                    <label class="control-label" for="driverLicenceExp">Driver Licence Exp </label>
                    <div class="input-group date">
                        <input name="driverLicenceExp" id="driverLicenceExp" class="datepicker form-control" data-date-format="yyyy/mm/dd" type="text" value="<?php echo date('Y/m/d') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverPermitNo">Driver Permit No</label>
                    <input type="text" name="driverPermitNo" id="driverPermitNo" class="form-control">
                </div>
                
                <div class="form-group" style="z-index:2151 !important;">
                    <label class="control-label" for="driverPermitExp">Driver Permit Exp </label>
                    <div class="input-group date">
                        <input name="driverPermitExp" id="driverPermitExp" class="datepicker form-control" data-date-format="yyyy/mm/dd" type="text" value="<?php echo date('Y/m/d') ?>">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#driverLicenceExp').datepicker();
        $('#driverPermitExp').datepicker();
    });

    function c_view(id){
        $('#viewDriverDetails').load('driver/ajax/'+id,function () {});
        setInterval(function(){
            $('#viewDriverDetails').load('driver/ajax/'+id,function () {});
        }, 10000);
    };

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>