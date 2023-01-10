<script type="text/javascript">

    function showAjaxModal(url)
    {
        $('.customized-modal').css('margin-top', window.scrollY);
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" style="height:25px;" /></div>');

        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
            }
        });
    }

</script>

<!-- (Ajax Modal)-->
<div class="modal fade customized-modal" id="modal_ajax">
    <div class="modal-dialog" >
        <div class="modal-content" style="">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">System</h4>
            </div>

            <div class="modal-body" style="height:500px; overflow:auto;">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    function showUpdateModal(url, id)
    {
        $('.customized-modal').css('margin-top', window.scrollY);
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" style="height:25px;" /></div>');

        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            type: "POST",
            url: url,
            data: {"id": id},
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
            }
        });
    }

</script>

<!-- (Update Modal)-->
<div class="modal fade customized-modal" id="modal_ajax">
    <div class="modal-dialog" >
        <div class="modal-content" style="">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">System</h4>
            </div>

            <div class="modal-body" style="height:500px; overflow:auto;">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
function confirm_modal(delete_url)
{
jQuery('#modal-4').modal('show', {backdrop: 'static'});
document.getElementById('delete_link').setAttribute('href' , delete_url);
}
</script>

<!-- (Normal Modal)-->
<div class="modal fade" id="modal-4">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">هل تود مسح الحقل ؟</h4>
            </div>


            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <a href="#" class="btn btn-danger" id="delete_link"><?php echo get_phrase('delete');?></a>
                <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
            </div>
        </div>
    </div>
</div>

<!--    custom width modal -->

<script type="text/javascript">
    function showCustomWidthModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal-2 .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" style="height:25px;" /></div>');

        // LOADING THE AJAX MODAL
        jQuery('#modal-2').modal('show', {backdrop: 'true'});

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal-2 .modal-body').html(response);
            }
        });
    }
</script>

<div class="modal fade custom-width" id="modal-2">
    <div class="modal-dialog" style="width: 75%;">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $system_name;?></h4>
            </div>

            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showChangeStatusModal(id, source, status)
    {
        $('.customized-modal').css('margin-top', window.scrollY);
        jQuery("#modal-confirm").modal('show', {backdrop: 'true'});
    }

    function updateStatus() {
        $.ajax({
        url: "editStatus",
        data: {"id":<?php echo $info[0]['id']; ?>, "source" : '<?php echo $source; ?>', "status":$("#statusNew").val()},
        type: "POST",
        success: function (result) {
            toastr.info(result);
        }
        });
    }

</script>

<!-- (Confirm Modal)-->
<div class="modal fade customized-modal" id="modal-confirm">
    <div class="modal-dialog" >
        <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Confirm</h4>
            </div>

            <div class="modal-body" style="height:5vh;">
              <p>Do you change status?</p>
              
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onClick="updateStatus()">Confirm</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>