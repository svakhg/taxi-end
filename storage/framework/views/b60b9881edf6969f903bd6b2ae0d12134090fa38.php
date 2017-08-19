<?php $__env->startSection('content'); ?>
<ul class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>">Home</a></li>
    <li class="active">SMS</li>
</ul>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Send SMS</h3>
    </div>
    <div class="panel-body">
        <div class="row">            
            <div class="col-md-12">
                <form class="form-horizontal" method="POST">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="senderId">Sender Id</label>
                            <div class="col-md-4">
                                <input id="senderId" maxlength="11" pattern="^(?=.*[a-zA-Z])(?=.*[a-zA-Z0-9])([a-zA-Z0-9 ]{1,11})$" name="senderId" type="text" placeholder="Taviyani" class="form-control input-md" required="" title="Cannot Be Loner than 11 letter. Only letters and numbers allowed">
                                <span class="help-block">Enter a sender Id here. It must be a combination of letters and numbers, It cannot be more than 11 characters.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phoneNumber">Phone Number</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">+960</span>
                                    <input id="phoneNumber" maxlength="7" name="phoneNumber" class="form-control" placeholder="9997777" type="text" required="">
                                </div>
                                <p class="help-block">Enter a dhiraagu or ooredoo number here</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message">Message</label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="4" maxlength="160" id="message" name="message" required></textarea>
                                <p id="remMessage"></p>
                                <script>
                                var area = document.getElementById("message");
                                var message = document.getElementById("remMessage");
                                var maxLength = 160;
                                var checkLength = function() {
                                    if(area.value.length < maxLength) {
                                        message.innerHTML = (maxLength-area.value.length) + " characters remaining";
                                    }
                                }
                                setInterval(checkLength, 300);
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="submit">Submit</label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>    
    </div>        
</div>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>