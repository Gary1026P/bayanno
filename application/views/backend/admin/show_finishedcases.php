<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>

            <th></th>
            <th>name</th>
            <th>employee no</th>
            <th>unit</th>
            <th>organization</th>
            <th>case</th>
            <th>vacation no</th>
            <th>meeting date</th>
            <th>meeting no</th>
            <th></th>
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
                <td><?php echo isset($row['source']) ? "Work suitability": "work injury" ?></td>
                <td><?php echo $row['vacation'] ?></td>
                <td><input type="text" class="form-control datepicker" value="<?php if($row['meeting_date']){ echo  date('m/d/Y', strtotime($row['meeting_date'])); }?>"  id="appoint<?php echo $source.$row['id'];?>" ?>  </td>
                <td><input type="number" class="form-control" value="<?php if($row['meeting_number']){ echo  $row['meeting_number']; }?>"  id="appointnumber<?php echo $source.$row['id'];?>" ?>  </td>
                <td>
                  <button type="button" class="btn btn-warning" onclick="deleteFinishcaseData(<?php echo $row['id'];?>, '<?php echo $source; ?>');" >delete</button>&nbsp;<button type="button" class="btn btn-success" onclick="updateData(<?php echo $row['id'];?>, '<?php echo $source; ?>');" >add</button>               
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
    
    
    function deleteFinishcaseData(id, source){
      $.ajax({
        url: "deleteAppointment",
        data: {"id":id, "source" : source},
        type: "POST",
        success: function (result) {
          location.reload();
        }
      });
    }
    
    function updateData(id, source){
      $.ajax({
        url: "updateData",
        data: {"id":id, "source" : source, "number":$("#appointnumber"+source+id).val(), "date":$("#appoint"+source+id).val()},
        type: "POST",
        success: function (result) {
          toastr.info(result);
        }
      });
    }

</script>
