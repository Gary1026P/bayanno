<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th></th>
            <th>unit</th>
            <th>Employee no</th>

            <th>organization</th>
            <th>case type</th>
            <th>appoitment</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($approval_info as $row) {
          $source_display = isset($row['source']) ? get_phrase('work_suitability') : get_phrase('work_injury');
          $source = isset($row['source']) ? 'work_suitability' : 'work_injury';
        ?>   
            <tr>
                
                <td><?php echo $row['id'] ?></td>

                <td><?php echo $row['name']." ".$row['sname']." ".$row['tame']." ".$row['lname'] ?></td>
                <td><?php echo $row['emp_no'] ?></td>

                                <td><?php echo ($row['work_type'] == 1) ? "dgm" : "ppm"  ?></td>
                <td><?php echo isset($row['source']) ? "work suitability": "work injury" ?></td>
                <td><input type="text" class="form-control datepicker" value="<?php if($row['appointment_date']){ echo  date('m/d/Y', strtotime($row['appointment_date'])); }?>"  id="appoint<?php echo $row['id'];?>"  />
                  
                </td>
                
                <td>
                  <button type="button" class="btn btn-success" onclick="makeAppointment(<?php echo $row['id'];?>, '<?php echo $source; ?>');" >save</button>
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
    
    function makeAppointment(id, source){
      $.ajax({
        url: "makeAppointment",
        data: {"date":$("#appoint"+id).val(), "id":id, "source" : source},
        type: "POST",
        success: function (result) {
          toastr.info(result);
        }
      });
    }
    
</script>
