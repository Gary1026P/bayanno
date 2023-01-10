<div class="row" align="center">

    <div class="col-sm-3" align="center">
        <a href="<?php echo site_url('admin/patient'); ?>">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('patient'); ?>" 
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('patient'); ?></div>
                <h3>اضافة ملف جديد</h3>
            </div>
        </a>
    </div>



 <div class="col-sm-3" align="center">
     
	           <a href="<?php echo site_url('admin/newcases'); ?>">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-user"></i></div>
              <br>
			  <br>
			        <br>
			  <br>
                <h3>الحالات الجديدة</h3>
				
				
            </div>
        </a>
    </div>
</div>
<br />



