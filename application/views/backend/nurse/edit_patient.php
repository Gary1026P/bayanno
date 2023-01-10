<?php
$single_patient_info = $this->db->get_where('patient', array('patient_id' => $param2))->result_array();
foreach ($single_patient_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>تعديل الحالة</h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups" action="<?php echo site_url('nurse/patient/update/'.$row['patient_id']); ?>" 
                        method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>" required>
                            </div>
                        </div>
						
						
						
						                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">الاسم الثاني</label>

                            <div class="col-sm-7">
                                <input type="text" name="sname" class="form-control" id="field-1" value="<?php echo $row['sname']; ?>" required>
                            </div>
                        </div>
						
						
						                      <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">الاسم الثالث</label>

                            <div class="col-sm-7">
                                <input type="text" name="tname" class="form-control" id="field-1" value="<?php echo $row['tname']; ?>" required>
                            </div>
                        </div>


        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"> القبيلة</label>

                            <div class="col-sm-7">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['tname']; ?>" required>
                            </div>
                        </div>
						
						
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                            <div class="col-sm-7">
                                <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $row['email']; ?>" required>
                            </div>
                        </div>

-->
<!--
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                            <div class="col-sm-7">
                                <textarea rows="5" name="address" class="form-control" id="field-ta"><?php echo $row['address'];?></textarea>
                            </div>
                        </div>
-->
<!--
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="phone" class="form-control" id="field-1" value="<?php echo $row['phone']; ?>">
                            </div>
                        </div>
-->

<!--
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('sex'); ?></label>

                            <div class="col-sm-7">
                                <select name="sex" class="form-control">
                                    <option value=""><?php echo get_phrase('select_sex'); ?></option>
                                    <option value="male" <?php if ($row['sex'] == 'male')echo 'selected';?>>
                                        <?php echo get_phrase('male'); ?>
                                    </option>
                                    <option value="female" <?php if ($row['sex'] == 'female')echo 'selected';?>>
                                        <?php echo get_phrase('female'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>
-->


      <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">الوحدة</label>

                            <div class="col-sm-7">
                                <select name="unitname" class="form-control">
                                    <option value="">اختر الوحدة</option>
                                    <option value="المديرية العامة للاتصالات ونظم المعلومات" <?php if ($row['unitname'] == 'المديرية العامة للاتصالات ونظم المعلومات')echo 'selected';?>>
                                        "المديرية العامة للاتصالات ونظم المعلومات"
                                    </option>
                                    <option value="المديرية العامة للخدمات الطبية" <?php if ($row['unitname'] == 'المديرية العامة للخدمات الطبية')echo 'selected';?>>
                                        المديرية العامة للخدمات الطبية
                                    </option>
									<option value=" المديرية العامة للشؤون العامة" <?php if ($row['unitname'] == 'المديرية العامة للشؤون العامة')echo 'selected';?>>
                                     المديرية العامة للشؤون العامة
                                    </option>
									<option value="مركز السلطان قابوس العالي للثقافة والعلوم" <?php if ($row['unitname'] == 'مركز السلطان قابوس العالي للثقافة والعلوم')echo 'selected';?>>
                                    مركز السلطان قابوس العالي للثقافة والعلوم
                                    </option>
									
                                </select>
                            </div>
                        </div>
						<!--
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('birth_date'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="birth_date" class="form-control datepicker" id="field-1" value="<?php echo date("m/d/Y", $row['birth_date']); ?>">
                            </div>
                        </div>
-->
<!--
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age'); ?></label>

                            <div class="col-sm-7">
                                <input type="number" name="age" class="form-control" id="field-1" value="<?php echo $row['age']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('blood_group'); ?></label>

                            <div class="col-sm-7">
                                <select name="blood_group" class="form-control">
                                    <option value=""><?php echo get_phrase('select_blood_group'); ?></option>
                                    <option value="A+" <?php if ($row['blood_group'] == 'A+')echo 'selected';?>>A+</option>
                                    <option value="A-" <?php if ($row['blood_group'] == 'A-')echo 'selected';?>>A-</option>
                                    <option value="B+" <?php if ($row['blood_group'] == 'B+')echo 'selected';?>>B+</option>
                                    <option value="B-" <?php if ($row['blood_group'] == 'B-')echo 'selected';?>>B-</option>
                                    <option value="AB+" <?php if ($row['blood_group'] == 'AB+')echo 'selected';?>>AB+</option>
                                    <option value="AB-" <?php if ($row['blood_group'] == 'AB-')echo 'selected';?>>AB-</option>
                                    <option value="O+" <?php if ($row['blood_group'] == 'O+')echo 'selected';?>>O+</option>
                                    <option value="O-" <?php if ($row['blood_group'] == 'O-')echo 'selected';?>>O-</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('image'); ?></label>

                            <div class="col-sm-7">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo $this->crud_model->get_image_url('patient' , $row['patient_id']);?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>

                            </div>
                        </div>
						-->
                        <div class="form-group">
                        <label class="col-sm-3 control-label">المستند الأول</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <a href="<?= base_url('/uploads/patient_doc/'.$row['doc_1'])?>"   <span class="fileinput-new"> </span></a>
                                <div>
                                 
                                    <br>
                                    <span class="">
                                        
                                
                                        <input type="file" name="doc_1" accept="application/pdf" >
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">المستند الثاني</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <a href="<?= base_url('/uploads/patient_doc/'.$row['doc_2'])?>"   <span class="fileinput-new"></span></a>
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="doc_2" accept="application/pdf" >
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">المستند الثالث</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <a href="<?= base_url('/uploads/patient_doc/'.$row['doc_3'])?>"   <span class="fileinput-new"> </span></a>
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="doc_3" accept="application/pdf" >
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                        <div class="col-sm-3 control-label col-sm-offset-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> تحديث
                            </button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>
