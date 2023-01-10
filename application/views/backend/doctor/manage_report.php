<?php $doctor_id    = $this->session->userdata('login_user_id'); ?>
<button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_report');?>');" 
    class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_report'); ?>
</button>
<a href="<?php echo site_url('doctor/death_report_download'); ?>" 
    class="btn btn-success pull-right"style="margin-right: 5px;">
        <i class="fa fa-download"></i>&nbsp;<?php echo get_phrase('export_death_report'); ?>
</a>
<a href="<?php echo site_url('doctor/birth_report_download'); ?>" 
    class="btn btn-success pull-right"style="margin-right: 5px;">
        <i class="fa fa-download"></i>&nbsp;<?php echo get_phrase('export_birth_report'); ?>
</a>
<a href="<?php echo site_url('doctor/operation_report_download'); ?>" 
    class="btn btn-success pull-right"style="margin-right: 5px;">
        <i class="fa fa-download"></i>&nbsp;<?php echo get_phrase('export_operation_report'); ?>
</a>
<div style="clear:both;"></div>
<br>
<div class="row">

    <div class="col-md-12">

        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
            <li class="active">
                <a href="#operation" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-home"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('operation');?></span>
                </a>
            </li>
            <li>
                <a href="#birth" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('birth');?></span>
                </a>
            </li>
            <li>
                <a href="#death" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('death');?></span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            
            <div class="tab-pane active" id="operation">
                    
                <table class="table table-bordered table-striped datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('patient'); ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $report_info    = $this->db->get_where('report', array('type' => 'operation', 'doctor_id' => $doctor_id))->result_array();
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                <td>
                                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_report/'.$row['report_id']); ?>');" 
                                        class="btn btn-info btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        <?php echo get_phrase('edit');?>
                                    </a>
                                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/manage_report_files/'.$row['report_id']); ?>');" 
                                        class="btn btn-default btn-sm">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        <?php echo get_phrase('view_files');?>
                                    </a>
                                    <a onclick="confirm_modal('<?php echo site_url('doctor/report/delete/'.$row['report_id']); ?>')"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        <?php echo get_phrase('delete');?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            
            <div class="tab-pane" id="birth">
                    
                <table class="table table-bordered table-striped datatable" id="table-2">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('patient'); ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $report_info    = $this->db->get_where('report', array('type' => 'birth', 'doctor_id' => $doctor_id))->result_array();
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                <td>
                                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_report/'.$row['report_id']); ?>');"
                                        class="btn btn-info btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        <?php echo get_phrase('edit');?>
                                    </a>
                                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/manage_report_files/'.$row['report_id']); ?>');"
                                        class="btn btn-default btn-sm">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        <?php echo get_phrase('view_files');?>
                                    </a>
                                    <a onclick="confirm_modal('<?php echo site_url('doctor/report/delete/'.$row['report_id']); ?>')"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        <?php echo get_phrase('delete');?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            
            <div class="tab-pane" id="death">
                    
                <table class="table table-bordered table-striped datatable" id="table-3">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('patient'); ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $report_info    = $this->db->get_where('report', array('type' => 'death', 'doctor_id' => $doctor_id))->result_array();
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                <td>
                                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_report/'.$row['report_id']); ?>');"
                                        class="btn btn-info btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        <?php echo get_phrase('edit');?>
                                    </a>
                                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/manage_report_files/'.$row['report_id']); ?>');"
                                        class="btn btn-default btn-sm">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        <?php echo get_phrase('view_files');?>
                                    </a>
                                    <a onclick="confirm_modal('<?php echo site_url('doctor/report/delete/'.$row['report_id']); ?>')"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        <?php echo get_phrase('delete');?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            
        </div>
        
    </div>
    
</div>

<?php for($count=1; $count<=3; $count++){ ?>
    <script type="text/javascript">
        jQuery(window).load(function ()
        {
            var $ = jQuery;

            $("#table-<?php echo $count ?>").dataTable({
                "sPaginationType": "bootstrap",
                "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
            });

            $(".dataTables_wrapper select").select2({
                minimumResultsForSearch: -1
            });

            // Highlighted rows
            $("#table-<?php echo $count ?> tbody input[type=checkbox]").each(function (i, el)
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
<?php } ?>