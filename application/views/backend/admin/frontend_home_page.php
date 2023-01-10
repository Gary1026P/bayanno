<div class="panel panel-primary" data-collapsed="0">
    
    <div class="panel-body">

		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab1" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">
						<?php echo get_phrase('main_slider'); ?>
					</span>
				</a>
			</li>
			<li>
				<a href="#tab2" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cc-nd"></i></span>
					<span class="hidden-xs">
						<?php echo get_phrase('welcome_message_section'); ?>
					</span>
				</a>
			</li>
		</ul>

		<div class="tab-content" style="padding: 20px 0 0 0;">
			<div class="tab-pane active" id="tab1">
				<form action="<?php echo site_url('admin/frontend_settings/slider');?>" 
					method="post" class="form-groups form-horizontal"
						enctype="multipart/form-data">
					<?php $slider = json_decode($sliders);?>
					<?php for ($i=0; $i < count($slider); $i++) { ?>
						<div class="panel panel-white" data-collapsed="0"
							style="border: 0;">
							
							<div class="panel-body">

									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">
											<?php echo get_phrase('slider_title');?>
										</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="title_<?php echo $i;?>"
												value="<?php echo $slider[$i]->title;?>"
													required>
										</div>
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">
											<?php echo get_phrase('slider_description');?>
										</label>
										<div class="col-sm-6">
											<textarea class="form-control" rows="5"
												name="description_<?php echo $i;?>"
													required><?php echo $slider[$i]->description;?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo get_phrase('slider_image');?></label>
										
										<div class="col-sm-6">
											
											<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
												<div class="fileinput-new thumbnail" style="width: 356px; height: 200px;" data-trigger="fileinput">
													<img src="<?php echo base_url();?>uploads/frontend/slider_images/<?php echo $slider[$i]->image;?>" 
														alt="...">
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 356px; max-height: 200px; line-height: 6px;"></div>
												<div>
													<span class="btn btn-white btn-file">
														<span class="fileinput-new"><?php echo get_phrase('select_image');?></span>
														<span class="fileinput-exists"><?php echo get_phrase('change');?></span>
														<input type="file" name="slider_image_<?php echo $i;?>" accept="image/*">
													</span>
													<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove');?></a>
												</div>
											</div>
											
										</div>
									</div>

							</div>
						</div>
					<?php } ?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"></label>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-info btn-block">
								<?php echo get_phrase('save_changes');?>
							</button>
						</div>
					</div>
				</form>

			</div>

			<div class="tab-pane" id="tab2">
				<?php $welcome = json_decode($welcome_content);?>
				<form action="<?php echo site_url('admin/frontend_settings/welcome_section');?>" 
					class="form-groups form-horizontal" method="post"
						enctype="multipart/form-data">

						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">
								<?php echo get_phrase('welcome_title');?>
							</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="title"
									value="<?php echo $welcome[0]->title;?>"
										required>
							</div>
						</div>
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">
								<?php echo get_phrase('welcome_message');?>
							</label>
							<div class="col-sm-6">
								<textarea class="form-control" rows="8"
									name="message"
										required><?php echo $welcome[0]->description;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo get_phrase('left_image');?></label>
							
							<div class="col-sm-6">
								
								<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
									<div class="fileinput-new thumbnail" style="width: 250px; height: 250px;" data-trigger="fileinput">
										<img src="<?php echo base_url();?>uploads/frontend/<?php echo $welcome[0]->image;?>" 
											alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 6px;"></div>
									<div>
										<span class="btn btn-white btn-file">
											<span class="fileinput-new"><?php echo get_phrase('select_image');?></span>
											<span class="fileinput-exists"><?php echo get_phrase('change');?></span>
											<input type="file" name="left_image" accept="image/*">
										</span>
										<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove');?></a>
									</div>
								</div>
								
							</div>
						</div>

						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label"></label>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-info btn-block">
									<?php echo get_phrase('save_changes');?>
								</button>
							</div>
						</div>
				
				</form>

			</div>
		</div>
        
    </div>

</div>
