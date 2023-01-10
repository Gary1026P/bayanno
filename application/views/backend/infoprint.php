 <html>
 <body>
 <?php
 
          $empno = ($results->emp_no); 
         $unitname = ($results->unitname); 
         $position = ($results->position); 
         $civilno = ($results->civil_no); 
         $start_date = ($results->start_date); 
         $work_place = ($results->work_place); 
         $work_stay = ($results->work_stay); 
         $phone = ($results->phone); 
         $direct_name = ($results->direct_name); 
         $direct_number = ($results->direct_number); 
         $treat_number = ($results->treat_number); 
         $injury_date = ($results->injury_date); 
         $name = ($results->name); 
         $sname = ($results->sname);
         $tname = ($results->tname);
         $lname = ($results->lname); 
         ?>
         
       <div> 
        <style>
          table, th, td {
            border:1px solid black;
          }
          table {
            border-collapse: collapse;
            width: 100%;
          }

          td {
            text-align: center;
            height: 50px;
            padding: 15px;
            vertical-align: bottom   
          }
          th {
             height: 50px;
             vertical-align: bottom;
             padding: 15px;
             text-align: center;
          }
          </style>
          
          <div class="row"  style="text-align:center;">
            <div class="col-sm-12">
              <h1 style="color:#2b2828eb">
              <?php
              echo $name." ".$sname." ".$tname." ".$lname;
              ?>
              </h1>
            </div>  
          </div>  <br/>
          <div style="width: 50%; margin: 0 auto;">  
            <table style="width:100%">
              
                <tr>          
                <th><?php echo get_phrase('exployee_no'); ?></th>
                <td><?php echo $empno ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('full_name'); ?></th>
                <td><?php echo $name." ".$sname." ".$tname." ".$lname; ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('unit_name'); ?></th>
                <td><?php echo $unitname ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('position'); ?></th>
                <td><?php echo $position ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('civil_no'); ?></th>
                <td><?php echo $civilno ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('start_date'); ?></th>
                <td><?php echo $start_date ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('work_place'); ?></th>
                <td><?php echo $work_place ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('stay_stay'); ?></th>
                <td><?php echo $work_stay?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('phone'); ?></th>
                <td><?php echo $phone ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('director_name'); ?></th>
                <td><?php echo $direct_name ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('director_number'); ?></th>
                <td><?php echo $direct_number ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('treatment_number'); ?></th>
                <td><?php echo $treat_number ?></td>
                </tr>
                <tr>
                <th><?php echo get_phrase('injury_date'); ?></th>
                <td><?php echo $injury_date ?></td>
                </tr>
        
            </table>
          </div>

 </body>
</html>           
