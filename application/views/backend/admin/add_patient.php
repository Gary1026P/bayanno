<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3>add new case</h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups" action="<?php echo site_url('admin/patient/create'); ?>" 
                    method="post" enctype="multipart/form-data">



<div class="form-group" style="display:flex;margin-right:90px;">
         <label for="field-1" class="col-sm-3 control-label"></label>
         
         <div class="col-sm-7">
                            <input type="radio" name="work_type" id="radioExample_4a"
                                   checked="checked" value="1" onchange="setWorkType(this);">
                            <label for="radioExample_4a">
                              DGM
                        </div>
                        <div class="col-sm-7">
                            <input type="radio" name="work_type" id="radioExample_4b"
                                value="2" onchange="setWorkType(this);">
                            <label for="radioExample_4b">
                             PPM
                            </label>
                        </div>
                    
                    </div>

    
    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">unit neme</label>

                        <div class="col-sm-7">
                            <input type="text" name="unitname" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">first name </label>

                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" id="field-1" required>
                            <input type="hidden" name="tableName" value="work_injury" >
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">second name </label>

                        <div class="col-sm-7">
                            <input type="text" name="sname" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">third name </label>

                        <div class="col-sm-7">
                            <input type="text" name="tname" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">last name</label>

                        <div class="col-sm-7">
                            <input type="text" name="lname" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
										             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">position</label>

                        <div class="col-sm-7">
                            <input type="text" name="position" class="form-control" id="field-1" required>
                        </div>
                    </div>
				
					  <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Employee No</label>

                        <div class="col-sm-7">
                            <input type="number" name="Emp_NO" class="form-control" id="field-1" >
                        </div>
                    </div>
				
				
				  <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Civil No</label>

                        <div class="col-sm-7">
                            <input type="number" name="Civil_No" class="form-control" id="field-1" >
                        </div>
                    </div>
				
				
				
				  <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Start Date </label>

                        <div class="col-sm-7">
                            <input type="date" name="start_date" class="form-control" id="field-1" >
                        </div>
                    </div>
				
				
				
										             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Work Place </label>

                        <div class="col-sm-7">
                            <input type="text" name="work_place" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
					
					
										             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> Stay Place </label>

                        <div class="col-sm-7">
                            <input type="text" name="work_stay" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
				
				 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">phone No </label>

                        <div class="col-sm-7">
                            <input type="number" name="Phone_No" class="form-control" id="field-1" >
                        </div>
                    </div>
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> Direct director name </label>

                        <div class="col-sm-7">
                            <input type="text" name="Direct_director_name" class="form-control" id="field-1" required>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Director Phone No </label>

                        <div class="col-sm-7">
                            <input type="number" name="Director_Phone_No" class="form-control" id="field-1" >
                        </div>
                    </div>
					
							
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> treatment card number </label>

                        <div class="col-sm-7">
                            <input type="number" name="treatment_card_number" class="form-control" id="field-1" >
                        </div>
                    </div>
					
					
						 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> injury date</label>

                        <div class="col-sm-7">
                            <input type="date" name="injury_date" class="form-control" id="field-1" >
                        </div>
                    </div>
										
                    <div class="form-group">
                        <label class="col-sm-3 control-label">sickleave attach</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="sickleave_attach" accept="application/pdf">
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="col-sm-3 control-label">unit letter</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="unit_letter" accept="application/pdf">
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Injury report</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="injury_report" accept="application/pdf">
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
					
					
					           <div class="form-group">
                        <label class="col-sm-3 control-label">medical report</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="">
                                        
                                
                                        <input type="file" name="medical_report" accept="application/pdf">
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success" name="Submit">
                            <i class="fa fa-check"></i> save
							
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
