<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th></th>
            <th>name</th>
            <th>Employee no</th>
            <th>unit</th>
            <th>organization</th>
            <th>case</th>
            <th>vacation No</th>
            <th>Final Decision</th>
            <th>Decision</th>
            <th>-</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($approval_info as $row) {
          $source = !empty($row['source']) ? $row['source'] : "work_injury";
        ?>   
            <tr>

                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name']." ".$row['sname']." ".$row['tame']." ".$row['lname'] ?></td>
                <td><?php echo $row['emp_no'] ?></td>
                <td><?php echo $row['unitname'] ?></td>
                <td><?php echo ($row['work_type'] == 1) ? "DGM" : "PPM"  ?></td>
                <td><?php echo isset($row['source']) ? "Work suitability": "Work injury" ?></td>
                <td><?php echo $row['vacation'] ?></td>
                <td>
                    <?php if($row['final_decision']) { ?>
                        <a href="../uploads/final_decision/<?php echo $row['final_decision']; ?>" target="_blank"><?php echo $row['final_decision_filename'] ?></a><br>
                    <?php } ?>
                    <input type="file" id="choosefile" />
                </td>
                <td><input type="text" id="decision" value=<?php echo $row['decision'] ?>></td>
                <td>
                    <button type="button" class="btn btn-success" onclick="saveData(<?php echo $row['id'];?>, '<?php echo $source; ?>', $('#decision').val());" >Save</button>
                    <button type="button" class="btn btn-warning" onclick="deleteData(<?php echo $row['id'];?>, '<?php echo $source; ?>');" >Delete</button>
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
    
    
    function deleteData(id, source){
      $.ajax({
        url: "deleteAppointment",
        data: {"id":id, "source" : source},
        type: "POST",
        success: function (result) {
          location.reload();
        }
      });
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
        url: "saveAppointment",
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
