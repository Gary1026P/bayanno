<div class="row">
    <div class="col-md-8">
        <button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_patient');?>');" 
            class="btn btn-primary pull-right" style="font-size : 16px; width: 100%; height: 100px; font-family :Calibri">
                <i class="fa fa-plus"></i>&nbsp; work injury
        </button>
    </div>

    <div class="col-md-4">
        
        <button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_work_suitability');?>');" 
            class="btn btn-primary pull-right" style="font-size : 16px; width: 100%; height: 100px;font-family :Calibri">
                <i class="fa fa-plus"></i>&nbsp; work suitability
        </button>
    
    </div>
</div>


<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th></th>
            <th>name</th>
            <th>Employee no</th>
            <th>unit</th>
            <th>organization</th>
            <th>case</th>
            <th>docs</th>
            <th>-</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($approval_info as $idx => $row) {
          $source = !empty($row['source']) ? $row['source'] : "work_injury";
        ?>   
            <tr>
                <td><?php echo $idx+1 ?></td>
                <td><?php echo $row['name']." ".$row['sname']." ".$row['tame']." ".$row['lname'] ?></td>
                <td><?php echo $row['emp_no'] ?></td>
                <td><?php echo $row['unitname'] ?></td>
                <td><?php echo ($row['work_type'] == 1) ? "DGM" : "PPM"  ?></td>
                <td><?php echo isset($row['source']) ? "Work suitability": "Work injury" ?></td>
                <td>
                    <?php if($row['doc1']) { ?>
                        <a href="./uploads/patient_doc/<?php echo $row['doc1']; ?>" target="_blank"><?php echo substr($row['doc1'], 0, strrpos($row['doc1'], '_')) ?></a><br>
                    <?php } ?>
                    <?php if($row['doc2']) { ?>
                        <a href="./uploads/patient_doc/<?php echo $row['doc2']; ?>" target="_blank"><?php echo substr($row['doc2'], 0, strrpos($row['doc2'], '_')) ?></a><br>
                    <?php } ?>
                    <?php if($row['doc3']) { ?>
                        <a href="./uploads/patient_doc/<?php echo $row['doc3']; ?>" target="_blank"><?php echo substr($row['doc3'], 0, strrpos($row['doc3'], '_')) ?></a><br>
                    <?php } ?>
                    <?php if($row['doc4']) { ?>
                        <a href="./uploads/patient_doc/<?php echo $row['doc4']; ?>" target="_blank"><?php echo substr($row['doc4'], 0, strrpos($row['doc4'], '_')) ?></a><br>
                    <?php } ?>
                    <?php if($row['doc5']) { ?>
                        <a href="./uploads/patient_doc/<?php echo $row['doc5']; ?>" target="_blank"><?php echo substr($row['doc5'], 0, strrpos($row['doc5'], '_')) ?></a>
                    <?php } ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success" onclick="editData(<?php echo $row['id'];?>, '<?php echo $source; ?>', $('#decision').val());" >Edit</button>
                    <button type="button" class="btn btn-warning" onclick="onClickDeleteBtn(<?php echo $row['id'];?>, '<?php echo $source; ?>');" >Delete</button>
                </td>
                
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });

    function onClickDeleteBtn(id, source) {
        showConfirmDeleteModal(id, source);
    }
    

    function editData(id, source) {
        if (source == 'work_injury') {
            showUpdateModal('<?php echo site_url('modal/popup/update_patient');?>', id);
        } else {
            showUpdateModal('<?php echo site_url('modal/popup/update_work_suitability');?>', id);
        }
    }

    function saveData(id, source, decision) {
        var formData = new FormData();
        var fileData = document.getElementById("choosefile").files[0];
        var decision  = document.getElementById('decision').value;
        formData.append('id', id);
        formData.append('source', source);
        formData.append('newfile', fileData);
        formData.append('decision', decision);
        
        $.ajax({
        url: "normal/saveAppointment",
        data: formData,
        method: "POST",
        contentType:false,
        processData:false,
        success: function (result) {
            location.reload();
        }
      });
    }

</script>
