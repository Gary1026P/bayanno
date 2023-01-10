<button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_patient');?>');"
    class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i> &nbsp;<?php echo get_phrase('add_patient'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('image');?></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('address');?></th>
            <th><?php echo get_phrase('phone');?></th>
            <th><?php echo get_phrase('sex');?></th>
            <th><?php echo get_phrase('birth_date');?></th>
            <th><?php echo get_phrase('age');?></th>
            <th><?php echo get_phrase('blood_group');?></th>
            <th><?php echo get_phrase('pathology_report');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ( $patients as $patient ) {
            $patient_info = $this->db->get_where('patient', array('patient_id' => $patient['patient_id']))->result_array();
            foreach ($patient_info as $row) { ?>
            <tr>
                <td><img src="<?php echo $this->crud_model->get_image_url('patient' , $row['patient_id']);?>" class="img-circle" width="40px" height="40px"></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone']?></td>
                <td><?php echo $row['sex']?></td>
                <td><?php echo date('d/m/Y', $row['birth_date']); ?></td>
                <td><?php echo $row['age']?></td>
                <td><?php echo $row['blood_group']?></td>
                <td width="10%">
  
  <?php if($row['satisfy_rate'] == 1){?>
  
   <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/1')?>" class="btn btn-sm btn-success"> Satisfy <i class="fa fa-thumbs-up"></i></a>
                    <br/>
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/2')?>" class="btn btn-outline-secondary">  Not Satisfy <i class="fa fa-thumbs-down"></i></a>
  
  <?php }if($row['satisfy_rate'] == 2){?> 
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/1')?>" class="btn btn-outline-secondary"> Satisfy <i class="fa fa-thumbs-up"></i></a>
                    <br/>
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/2')?>" class="btn btn-sm btn-danger">  Not Satisfy <i class="fa fa-thumbs-down"></i></a>
   
  <?php }?>
  
  <?php if($row['satisfy_rate'] == null){?> 
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/1')?>" class="btn btn-outline-secondary"> Satisfy <i class="fa fa-thumbs-up"></i></a>
                    <br/>
  <a href="<?= site_url('/admin/patient_rate/'.$row['patient_id'].'/2')?>" class="btn btn-outline-secondary">  Not Satisfy <i class="fa fa-thumbs-down"></i></a>
   
  <?php }?>
  

                </td>
                <td>
                  <?php
                    $report_info = $this->db->get_where('pathology_report', array('patient_id' => $row['patient_id']))->result_array();
                    foreach ($report_info as $report):?>
                    <a href="<?php echo base_url().'uploads/pathology_reports/'.$report['pathology_report']; ?>" target="_blank" style="color: #fff;" class="badge badge-secondary"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $report['test_name']; ?></a><br>
                  <?php endforeach; ?>
                </td>
                 <td>
                    <?php if(!empty($row['doc_1'])) {?>
                    <a  href="<?= base_url('/uploads/patient_doc/'.$row['doc_1'])?>" style="margin-bottom: 4px;"
                        class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> &nbsp;
                            DOC 1
                            
                    </a>
                    <?php }?>
                    <?php if(!empty($row['doc_2'])){?>
                    <a  href="<?= base_url('/uploads/patient_doc/'.$row['doc_2'])?>" style="margin-bottom: 4px;"
                        class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> &nbsp;
                            DOC 2
                            
                      
                    </a>
                   <?php }?>
                    <br/>
                    <?php if(!empty($row['doc_3'])){?>
                    <a  href="<?= base_url('/uploads/patient_doc/'.$row['doc_3'])?>" style="margin-bottom: 4px;"
                        class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> &nbsp;
                            DOC 3
                            
                    </a>
                    <?php }?>
                    
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                            <li>
                                <a onclick="showAjaxModal('<?php echo site_url('modal/popup/patient_profile/'.$row['patient_id']);?>');">
                                    <i class="fa fa-user"></i> &nbsp;
                                    <?php echo get_phrase('profile'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('doctor/medication_history/'.$row['patient_id']); ?>">
                                    <i class="fa fa-eye"></i> &nbsp;
                                    <?php echo get_phrase('view_medication_history'); ?>
                                </a>
                            </li>
                            <li>
                                <a onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_patient/'.$row['patient_id']);?>');">
                                    <i class="fa fa-pencil"></i> &nbsp;
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a onclick="confirm_modal('<?php echo site_url('doctor/patient/delete/'.$row['patient_id']); ?>')">
                                        <i class="fa fa-trash-o"></i> &nbsp;
                                        <?php echo get_phrase('delete'); ?>
                                </a>
                            </li>
                            
                            <li>
                                 <a href="<?= site_url('/doctor/patient_rate/'.$row['patient_id'].'/1')?>" class="btn btn-sm btn-success"> Satisfy <i class="fa fa-thumbs-up"></i></a>
  
  
  
                    
                            </li>
                            <li>
                                <a href="<?= site_url('/doctor/patient_rate/'.$row['patient_id'].'/2')?>" class="btn btn-sm btn-danger">  Not Satisfy <i class="fa fa-thumbs-down"></i></a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } } ?>
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
