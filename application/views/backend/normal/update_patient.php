<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3>update case</h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups" action="<?php echo site_url('normal/updatecase'); ?>" 
                    method="post" enctype="multipart/form-data">



    <div class="form-group" style="display:flex;margin-right:90px;">
         <label for="field-1" class="col-sm-3 control-label"></label>
         <div class="col-sm-7">
                <input type="radio" name="work_type" id="radioExample_4a" <?php if ($info[0]->work_type == 1) { ?> checked="checked" <?php } ?> value="1" onchange="setWorkType(this);">
                <label for="radioExample_4a">
                    DGM
            </div>
            <div class="col-sm-7">
                <input type="radio" name="work_type" id="radioExample_4b" <?php if ($info[0]->work_type == 2) { ?> checked="checked" <?php } ?> value="2" onchange="setWorkType(this);">
                <label for="radioExample_4b">
                    PPM
                </label>
            </div>
        
    </div>

    
    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">unit neme</label>

                        <div class="col-sm-7">
                            <input type="text" name="unitname" class="form-control" id="field-1" value=<?php echo $info[0]->unitname ?> required>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">first name </label>

                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" id="field-1" value=<?php echo $info[0]->name ?> required>
                            <input type="hidden" name="tableName" value="work_injury" >
                            <input type="hidden" name="id" value=<?php echo $info[0]->id ?> >
                            <input type="hidden" name="update" value="isUpdate" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">second name </label>

                        <div class="col-sm-7">
                            <input type="text" name="sname" class="form-control" id="field-1" value=<?php echo $info[0]->sname ?> required>
                        </div>
                    </div>
					
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">third name </label>

                        <div class="col-sm-7">
                            <input type="text" name="tname" class="form-control" id="field-1" value=<?php echo $info[0]->tname ?> required>
                        </div>
                    </div>
					
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">last name</label>

                        <div class="col-sm-7">
                            <input type="text" name="lname" class="form-control" id="field-1" value=<?php echo $info[0]->lname ?> required>
                        </div>
                    </div>
					
										             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">position</label>

                        <div class="col-sm-7">
                            <input type="text" name="position" class="form-control" id="field-1" value=<?php echo $info[0]->position ?> required>
                        </div>
                    </div>
				
					  <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Employee No</label>

                        <div class="col-sm-7">
                            <input type="number" name="Emp_NO" class="form-control" id="field-1" value=<?php echo $info[0]->emp_no ?>>
                        </div>
                    </div>
				
				
				  <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Civil No</label>

                        <div class="col-sm-7">
                            <input type="number" name="Civil_No" class="form-control" id="field-1" value=<?php echo $info[0]->civil_no ?> >
                        </div>
                    </div>
				
				
				
				  <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Start Date </label>

                        <div class="col-sm-7">
                            <input type="date" name="start_date" class="form-control" id="field-1" value=<?php echo $info[0]->start_date ?> >
                        </div>
                    </div>
				
				
				
										             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Work Place </label>

                        <div class="col-sm-7">
                            <input type="text" name="work_place" class="form-control" id="field-1" value=<?php echo $info[0]->work_place ?> required>
                        </div>
                    </div>
					
					
					
										             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> Stay Place </label>

                        <div class="col-sm-7">
                            <input type="text" name="work_stay" class="form-control" id="field-1" value=<?php echo $info[0]->work_stay ?> required>
                        </div>
                    </div>
					
				
				 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">phone No </label>

                        <div class="col-sm-7">
                            <input type="number" name="Phone_No" class="form-control" id="field-1" value=<?php echo $info[0]->phone ?> >
                        </div>
                    </div>
					
					             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> Direct director name </label>

                        <div class="col-sm-7">
                            <input type="text" name="Direct_director_name" class="form-control" id="field-1" value=<?php echo $info[0]->direct_name ?> required>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Director Phone No </label>

                        <div class="col-sm-7">
                            <input type="number" name="Director_Phone_No" class="form-control" id="field-1" value=<?php echo $info[0]->direct_number ?> >
                        </div>
                    </div>
					
							
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> treatment card number </label>

                        <div class="col-sm-7">
                            <input type="number" name="treatment_card_number" class="form-control" id="field-1" value=<?php echo $info[0]->treat_number ?> >
                        </div>
                    </div>
					
					
						 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> injury date</label>

                        <div class="col-sm-7">
                            <input type="date" name="injury_date" class="form-control" id="field-1" value=<?php echo $info[0]->injury_date ?>>
                        </div>
                    </div>
										
                    <div class="form-group">
                        <label class="col-sm-3 control-label">sickleave attach</label>

                        <div class="col-sm-7">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <input type="file" name="sickleave_attach" accept="application/pdf">
                                            </div>
                                            <div class="col-md-5">
                                                <span><?php echo substr($info[0]->doc1, 0, strrpos($info[0]->doc1, '_')) ?></span>
                                            </div>
                                        </div>
            
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
                                        <div class="row">
                                            <div class="col-md-7">
                                                <input type="file" name="unit_letter" accept="application/pdf">
                                            </div>
                                            <div class="col-md-5">
                                                <span><?php echo substr($info[0]->doc2, 0, strrpos($info[0]->doc2, '_')) ?></span>
                                            </div>
                                        </div>
                                
                                        
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
                                        <div class="row">
                                            <div class="col-md-7">
                                                <input type="file" name="injury_report" accept="application/pdf">
                                            </div>
                                            <div class="col-md-5">
                                                <span><?php echo substr($info[0]->doc3, 0, strrpos($info[0]->doc3, '_')) ?></span>
                                            </div>
                                        </div>
                                
                                        
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
                                        <div class="row">
                                            <div class="col-md-7">
                                            <input type="file" name="medical_report" accept="application/pdf">
                                            </div>
                                            <div class="col-md-5">
                                                <span><?php echo substr($info[0]->doc4, 0, strrpos($info[0]->doc4, '_')) ?></span>
                                            </div>
                                        </div>
                                
                                        
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success" name="Submit">
                            <i class="fa fa-check"></i> update
							
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
