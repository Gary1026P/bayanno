<style>


.center {
  margin: 0;
  position: absolute;
  top: 32%;
  left: 3%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

</style>

<form> 
  <div class="input-group col-sm-2">
    <input type="text" class="form-control" placeholder="Search" name="searchVal" value="<?php echo $searchVal; ?>" />
    <div class="input-group-btn">
      <button class="btn btn-default">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>


<?php
if(!empty($info )){

$source = isset($row['source']) ? 'work_suitability' : 'work_injury';
  
?>

<div class="row"  style="text-align:center;">
  <div class="col-sm-12">
    <h1>
    <?php
    echo $info[0]['name']." ".$info[0]['sname']." ".$info[0]['tame']." ".$info[0]['lname'];
    ?>
    </h1>
  </div>  
</div>  <br/>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>emp no</th>
            <th>name</th>
            <th>unit</th>
            <th>position</th>
            <th>civil no</th>
            <th>start date</th>
            <th>work place</th>
            <th>stay place</th>
            <th>phone no</th>
            <th>dirctor name</th>
            <th>director phone number</th>
            <th>treatment card</th>
            <th>injury date</th>
            <th>docs</th>
            <th>final decision</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($info as $row) {
          $source = !empty($row['source']) ? $row['source'] : "work_injury";
          $id = $row['id'];
        ?>   
            <tr>
                <td><?php echo $row['emp_no'] ?></td>
                <td><?php echo $row['name']." ".$row['sname']." ".$row['tame']." ".$row['lname']; ?></td>
                <td><?php echo $row['unitname'] ?></td>
                <td><?php echo $row['position'] ?></td>
                <td><?php echo $row['civil_no'] ?></td>
                <td><?php echo $row['start_date'] ?></td>
                <td><?php echo $row['work_place'] ?></td>
                <td><?php echo $row['work_stay'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['direct_name'] ?></td>
                <td><?php echo $row['direct_number'] ?></td>
                <td><?php echo $row['treat_number'] ?></td>
                <td><?php echo $row['injury_date'] ?></td>
                <td>
                  <?php if($row['doc1']) {  ?>
                        <a href="../uploads/patient_doc/<?php echo $row['doc1']; ?>" target="_blank"><?php echo substr($row['doc1'], 0, strrpos($row['doc1'], '_')) ?></a><br>
                    <?php } ?>
                    <?php if($row['doc2']) { ?>
                        <a href="../uploads/patient_doc/<?php echo $row['doc2']; ?>" target="_blank"><?php echo substr($row['doc2'], 0, strrpos($row['doc2'], '_')) ?></a><br>
                    <?php } ?>
                    <?php if($row['doc3']) { ?>
                        <a href="../uploads/patient_doc/<?php echo $row['doc3']; ?>" target="_blank"><?php echo substr($row['doc3'], 0, strrpos($row['doc3'], '_')) ?></a><br>
                    <?php } ?>
                    <?php if($row['doc4']) { ?>
                        <a href="../uploads/patient_doc/<?php echo $row['doc4']; ?>" target="_blank"><?php echo substr($row['doc4'], 0, strrpos($row['doc4'], '_')) ?></a>
                  <?php } ?>
                  <?php if($row['doc5']) { ?>
                        <a href="../uploads/patient_doc/<?php echo $row['doc5']; ?>" target="_blank"><?php echo substr($row['doc5'], 0, strrpos($row['doc5'], '_')) ?></a>
                  <?php } ?>
                </td>
                <td>
                    <?php if($row['final_decision']) { ?>
                        <a href="../uploads/final_decision/<?php echo $row['final_decision']; ?>" target="_blank"><?php echo $row['final_decision'] ?></a><br>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<!--طباعة -->
<!--
<form action="infoprint" method="post"  >   
  <button class= "center" style="background-color: #add8e68a;">طباعة</button> 
                 
    <input value="<?php echo $source;?>" type="hidden" name="itable" />
    <input value="<?php echo $id;?>"  type="hidden" name="id" />
              
</form>
-->



<div class="row">

  <div class="col-sm-8" >
    
    <?php
    if(!empty($comments)){
      foreach($comments as $co){
    ?>
    <div class="row">
    
      <!-- <div class="col-sm-5" >
        <?php
          // if($co['filepath']){
          //   echo "<iframe width='400' height='100' src='../uploads/comments/".$co['filepath']."' ></iframe>";
          // }
        ?>
      </div> -->

      <div class="col-sm-5">
            <a href="../uploads/comments/<?php echo $co['filepath'] ?>" target="_blank"><?php echo $co['comment_filename'] ?></a>
      </div>
      
      <div class="col-sm-6" > 
        
        <form action="editcomment" method="post" enctype="multipart/form-data" > 
            
            <textarea class="form-control" rows="4" name="editcomment" style="float:right"  >
            <?php
            echo $co['comments'];
            ?>
            </textarea>
            <label for="editcomment"  style="margin-right:1px;" >
            <input value="<?php echo $co['id'];?>"  type="hidden" name="id" />
            <input value="<?php echo $searchVal;?>" type="hidden" name="searchVal" /> 
           <!--  <button  type="submit" >EDIT</button>-->
              <button type="submit"  onclick="deletecomments(<?php echo $co['id'];?>)">delete</button>
                                                                                         
            </label>
                                      
        </form>
                                                              
     </div> 
         
     <div class="col-sm-1" >          
          <?php
           $date= $co['addedtime'];
           $d= date('jS/F/Y', strtotime($date));
           //$m= date('F', strtotime($date));
           //$y= date('Y', strtotime($date));
           echo "$d";
          ?>
          <br>  <br> 
                                            
     </div>
                            
</div><br/>
    
    <?php      
      }
    }
    ?>

    <div class="row">

      <div class="col-sm-5" >

      </div>

        <div class="col-sm-6" >    
          <form action="saveComments" method="post" enctype="multipart/form-data">
            <textarea class="form-control" rows="5" name="newComment" style="float:right">
            
            </textarea>
            <label for="comment" class="row" style="margin-right:1px;">
              <button class="col-sm-6 form-control btn-success" type="submit" >add</button>
              <input class="col-sm-6 form-control" type="file" name="newfile" />

              <input value="<?php echo $source;?>" type="hidden" name="table" />
              <input value="<?php echo $id;?>"  type="hidden" name="id" />
              <input value="<?php echo $searchVal;?>"  type="hidden" name="searchVal" />
              
            </label>
          </form>
        </div>

     </div>

  </div>
  
  <div class="col-sm-3" >
    <?php
    $full = 547;
    $leave =  $row['vacation'];
    
    $totalHeight = 400;
    $bottom = ($totalHeight/100)*round(($leave/$full)*100); 
    $top = $totalHeight-$bottom;
    $bottom = $bottom+15;
    echo "<span style='float:left;margin-left:80px;'>$leave/$full</span>";
    ?>
    <div id="firP" title="<?php echo $full; ?>" style="height: <?php echo $top;?>px;width: 20px; background-color: gold;margin-right:40%; border-radius: 25px"></div>
    <div id="secP" title="<?php echo $leave; ?> "style="height: <?php echo $bottom;?>px;width: 20px; background-color: red;margin-right:40%; margin-top:-15px; border-radius: 25px"></div >
  </div>


  
</div><br/>

<div class="row">
  <div class="col-sm-6" style="font-weight:bold;" >
    <?php echo $info[0]['display_status'];?>
  </div>

  <div class="form-group col-sm-5" >
    <select id="statusNew" class="form-select" onchange="changeStatus(); ">
      <option value="">change stutus</option>
      <option value="New case" >new case</option>
      <option value="Active case" >active case</option>
      <option value="Ready case" >ready case</option>
      <option value="Finished case" >finish case</option> 
    </select>
  </div>
</div>


<script type="text/javascript">
  function changeStatus(id, source) {
    showChangeStatusModal();
  }

</script>

<script type="text/javascript">
  function deletecomments(id){
    $.ajax({
      url: "deletecomments",
      data: {"id": id},
      type: "POST",
      success: function (result) {
        //toastr.info("commentdeleted");
        window.location.reload();
      }

    });
  }

</script>


<?php
}
?>

