<button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_patient');?>');" 
    class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i>&nbsp; ضافة حالة جديددة
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
           <th>الرقم الوظيفي</th>
            <th>الاسم</th>
                       
          <!--  <th>رقم الهاتف</th>-->
            <th>الوحدة</th>
            <th>الوثائق</th>
            <th>الاستيفاء</th>
         
            <th></th>
			 
        </tr>
    </thead>

    <tbody>
        <?php foreach ($patient_info as $row) { ?>   
            <tr>
                <td><?php echo $row['Emp_NO']?></td>
                <td><?php echo $row['name']," ",$row['sname']," ",$row['tname']," ",$row['lname']?></td>
              <td><?php echo $row['unitname']?></td>
            <!--    <td><?php echo $row['phone']?></td>-->
             
       
				
    
                <td>
                    <?php if(!empty($row['doc_1'])) {?>
                    <a  href="<?= base_url('/uploads/patient_doc/'.$row['doc_1'])?>" style="margin-bottom: 4px;"
                        class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> &nbsp;
                          المستند 1
                            
                    </a>
                    <?php }?>
                    <?php if(!empty($row['doc_2'])){?>
                    <a  href="<?= base_url('/uploads/patient_doc/'.$row['doc_2'])?>" style="margin-bottom: 4px;"
                        class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> &nbsp;
                          المستند 2
                            
                      
                    </a>
                   <?php }?>
                    <br/>
                    <?php if(!empty($row['doc_3'])){?>
                    <a  href="<?= base_url('/uploads/patient_doc/'.$row['doc_3'])?>" style="margin-bottom: 4px;"
                        class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> &nbsp;
                         المستند 3   
                    </a>
                    <?php }?>
                    
                </td>
				
				
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
                <td>
                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_patient/'.$row['patient_id']);?>');" 
                        class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>&nbsp;
                            <?php echo get_phrase('تعديل');?>
                    </a>
                    <a onclick="confirm_modal('<?php echo site_url('admin/patient/delete/'.$row['patient_id']); ?>')"
                        class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i>&nbsp;
                            <?php echo get_phrase('مسح');?>
                    </a>
                     
  
                    
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