<div style="position:absolute; vertical-align: middle; text-align: center;">
<button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_patient');?>');" 
    class="btn btn-primary pull-right" style="font-size : 16px; width: 100%; height: 100px; font-family :Calibri">
        <i class="fa fa-plus"></i>&nbsp; work injury
</button>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
 
<center>
<div style="position:absolute; vertical-align: middle; text-align: center;">
<button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_work_suitability');?>');" 
    class="btn btn-primary pull-right" style="font-size : 16px; width: 100%; height: 100px;font-family :Calibri">
        <i class="fa fa-plus"></i>&nbsp; work suitability
</button>
</div>
</center>
<div style="clear:both;"></div>
<br>
<!-- Show Table -->
<!--
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
           <th>الاسم</th>
            <th>الرقم الوظيفي</th>
                      <th>الوحدة</th>    

   <th>ديوان البلاط السلطاني / شؤون البلاط السلطاني</th>
 <th>اصابة عمل  / صلاحية عمل</th>

            <th>اعتماد</th>
         
            <th></th>
			 
        </tr>
    </thead>

    <tbody>
        <?php foreach ($patient_info as $row) { ?>   
            <tr>
          
                <td><?php echo $row['name']," ",$row['sname']," ",$row['tname']," ",$row['lname']?></td>
				      <td><?php echo $row['Emp_NO']?></td>
              <td><?php echo $row['unitname']?></td>
                    <td><?php echo $row['drc_rca']?></td>
             
                  <td><?php echo $row['unitname']?></td>
				

				
				
				            <td width="10%">
  
  <?php if($row['satisfy_rate'] == 1){?>
  
   <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/1')?>" class="btn btn-sm btn-success"> مستوفي <i class="fa fa-thumbs-up"></i></a>
                    <br/>
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/2')?>" class="btn btn-outline-secondary">  غير مستوفي <i class="fa fa-thumbs-down"></i></a>
  
  <?php }if($row['satisfy_rate'] == 2){?> 
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/1')?>" class="btn btn-outline-secondary"> مستوفي <i class="fa fa-thumbs-up"></i></a>
                    <br/>
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/2')?>" class="btn btn-sm btn-danger">  غير مستوفي <i class="fa fa-thumbs-down"></i></a>
   
  <?php }?>
  
  <?php if($row['satisfy_rate'] == null){?> 
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/1')?>" class="btn btn-outline-secondary"> مستوفي <i class="fa fa-thumbs-up"></i></a>
                    <br/>
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/2')?>" class="btn btn-outline-secondary">  غير مستوفي <i class="fa fa-thumbs-down"></i></a>
   
  <?php }?>
  

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
