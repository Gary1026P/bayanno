<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
             <th></th>
            <th>name</th>
            <th>emp_no</th>
            <th>work place</th>
            <th>organization	</th>
            <th>case type</th>
            <th>vacation NUMBER</th>
            <th>case</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($active_cases as $row) {
          $source_display = isset($row['source']) ? "work sutitability " : "work injury";
          $source = isset($row['source']) ? 'work_suitability' : 'work_injury';
        ?>   
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name']." ".$row['sname']." ".$row['tname']." ".$row['lname'] ?></td>
                <td><?php echo $row['emp_no'] ?></td>
                <td><?php echo $row['work_place'] ?></td>
                <td><?php echo ($row['work_type'] == 1) ? "dgm" : "ppm"  ?></td>
                <td><?php echo $source_display; ?> </td> 
                <td><input class="form-control" type="number" id="vacation<?php echo $row['id'];?>" value="<?php echo $row['vacation']; ?>" /></td>
                <td>
                   <select class="form-control" id="status<?php echo $row['id'];?>" >
                    <option value="" >--Select--</option>
                    <option value="Appointment" <?php if($row['active_status'] == "Appointment"){echo "selected";} ?> >تحديد موعد</option>
                    <option value="Sick leave"  <?php if($row['active_status'] == "Sick leave"){echo "selected";} ?> >اجازة مرضية</option>
                    <option value="External conversion"  <?php if($row['active_status'] == "External conversion"){echo "selected";} ?> >تحويل خارجي</option>
                    <option value="Internal conversion"  <?php if($row['active_status'] == "Internal conversion"){echo "selected";} ?> >تحويل داخلي</option>
                    <option value="Physical therapy"  <?php if($row['active_status'] == "Physical therapy"){echo "selected";} ?> >علاج طبيعي</option>
                    <option value="Other"  <?php if($row['active_status'] == "Other"){echo "selected";} ?> >اخرى</option>
                  </select>
                </td>
                <td>
                  <button type="button" class="btn btn-success" onclick="save(<?php echo $row['id'];?>, '<?php echo $source; ?>');" >save</button>
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
    
    function save(id, source){
      $.ajax({
        url: "editAppointment",
        data: {"vacation":$("#vacation"+id).val(), "status":$("#status"+id).val(), "source" : source, "id" : id},
        type: "POST",
        success: function (result) {
          toastr.info(result);
        }
      });
    }
    
</script>
