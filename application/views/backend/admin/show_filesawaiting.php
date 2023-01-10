<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>

           <th></th>
            <th>name</th>
            <th>Emp no</th>
            <th>work place</th>
            <th>organization</th>
            <th>case type</th>
            <th>action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($awaiting_info as $row) {
          $source = !empty($row['source']) ? $row['source'] : "work_injury";
        ?>   
            <tr>

                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name']." ".$row['sname']." ".$row['tame']." ".$row['lname'] ?></td>
                <td><?php echo $row['emp_no'] ?></td>
                <td><?php echo $row['work_place'] ?></td>
                <td><?php echo ($row['work_type'] == 1) ? "DGM" : "PPM"  ?></td>
                <td><?php echo isset($row['source']) ? "Work Suitability": "work injury" ?></td>
                               
                <td>
                  <?php 
                  if($row['status'] == "awaiting"){
                    echo "<a href='filesawaiting/$source/".$row['id']."/yes' >Yes</a> / <a href='filesawaiting/$source/".$row['id']."/no' >No</a>";
                  }
                  else if($row['status'] == "yes"){
                    echo "<span>".$row['status']."</span>";
                  }
                  else if($row['status'] == "no"){
                    echo "<span>".$row['status']."</span>";
                  }
                  ?>
                  
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
</script>
