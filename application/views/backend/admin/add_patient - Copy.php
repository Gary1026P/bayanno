<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3>إضافة حالة جديدة</h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups" action="<?php echo site_url('admin/patient/create'); ?>" 
                    method="post" enctype="multipart/form-data">


      <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">الرقم الوظيفي</label>

                        <div class="col-sm-7">
                            <input type="number" name="Emp_NO" class="form-control" id="field-1" >
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">الاسم الاول</label>

                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" id="field-1" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">الاسم الثاني </label>

                        <div class="col-sm-7">
                            <input type="text" name="sname" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">الاسم الثالث </label>

                        <div class="col-sm-7">
                            <input type="text" name="tname" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">القبيلة </label>

                        <div class="col-sm-7">
                            <input type="text" name="lname" class="form-control" id="field-1" required>
                        </div>
                    </div>
					<!--Email-->
				
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-7">
                            <input type="email" name="email" class="form-control" id="field-1" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password'); ?></label>

                        <div class="col-sm-7">
                            <input type="password" name="password" class="form-control" id="field-1" required>
                        </div>
                    </div>
<!--
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-7">
                            <textarea name="address" class="form-control" id="field-ta" rows="5"></textarea>
                        </div>
                    </div>
					
-->

<!--Phone Number -->
<!--
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="phone" class="form-control" id="field-1" >
                        </div>
                    </div>
-->

         <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label">الوحدة</label>

                        <div class="col-sm-7">
                            <select name="unitname" class="form-control">
                                <option value="">الوحدة</option>
                                <option value="المديرية العامة للاتصالات ونظم المعلومات">المديرية العامة للاتصالات ونظم المعلومات</option>
                                <option value="المديرية العامة للخدمات الطبية">المديرية العامة للخدمات الطبية</option>
								<option value="المديرية العامة للشؤون العامة">المديرية العامة للشؤون العامة</option>
								<option value="مركز السلطان قابوس العالي للثقافة والعلوم">مركز السلطان قابوس العالي للثقافة والعلوم</option>
                            </select>
                        </div>
                    </div>
					<!--
					
           <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label">الوحدة</label>

                        <div class="col-sm-7">
                            <select name="sex" class="form-control">
                                <option value="">الوحدة</option>
                                <option value="Male">المديرية العامة للاتصالات ونظم المعلومات</option>
                                <option value="Female">الشؤون الادارية </option>
                            </select>
                        </div>
                    </div>
					-->
<!-- Calender -->
<!--
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('birth_date'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="birth_date" class="form-control datepicker" id="field-1" >
                        </div>
                    </div>
<!-- Age-->
<!--
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age'); ?></label>

                        <div class="col-sm-7">
                            <input type="number" name="age" class="form-control" id="field-1" >
                        </div>
                    </div>
-->

<!--
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('blood_group'); ?></label>

                        <div class="col-sm-7">
                            <select name="blood_group" class="form-control">
                                <option value=""><?php echo get_phrase('select_blood_group'); ?></option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
-->
<!--
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('image'); ?></label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                    <img src="http://placehold.it/200x150" alt="...">
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
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="doc_1" accept="application/pdf">
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">المستند الثاني</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="doc_2" accept="application/pdf">
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">المستند الثالث</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="doc_3" accept="application/pdf">
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> <?php echo get_phrase('save');?>
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
