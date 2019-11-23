<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>


<div class="content">
          <div class="container-fluid">

  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="col-sm-3">
                <div class="card-header card-header-success">
                    <h4 class="card-title">House Payment </h4>
                    
                </div>
            </div>
          
            <div class="card-body">
            <div class="dataTable_wrapper" style="margin:20px;">
                    <div class="table-responsive">
                      <table class="table table-striped compact nowrap fixed" cellspacing="0"  id="dataTables-example" style="width:100%;">
                        <thead class=" text-primary">
                         
                          <th > 
                            DP
                          </th>

                          <th>
                            Due Date
                          </th>
                         
                          <th>
                            Amount
                          </th>
                       
                          <th>
                            Status
                          </th> 
                          
                         
                        </thead>
                        <tbody>
                          
                        <?php
                        //  $action =  "index.php?".md5("controller")."=".md5("edit_marker");
                        // foreach( getMarkers()as $row ){
                        //       $id = $row['marker_id'];
                        //       $lat = $row['lat'];
                        //       $lng = $row['lng'];
                        //       $date = $row['date'];
                        //       $location = $row['location_description'];
                        //       $category = $row['category_desc'];
                        //       $items = $row['items'];
                        //       $victim = $row['victim'];
                        //       $incident_narrative = $row['what_happened'];
                        //       $action_taken = $row['action_taken'];
                        //       $suspect = $row['suspect'];
                        //       $classification=$row['classification_desc'];
                        //       $school_id=$row['reported_by'];
                              
                        //       $status =$row['status_description'];
                        //       $status_id=$row['status_id'];
                        //       $category_id=$row['category'];
                        //       $class=$row['class'];
                        //       $narrative_id= $row['narrative_id'];
                        //       $recommendation= $row['recommendation'];

                        //   echo'
                        //   <tr>
                              
                        //       <td></td>
                        //       <td>'.date("M d, Y", strtotime($date)).'</td>
                             
                        //       <td>'.$location.'</td>
                        //       <td>'.$category.'</td>
                        //       <td>'.$items.'</td>
                        //       <td>'.$victim.'</td>
                        //       <td>'.$incident_narrative.'</td>
                             
                        //       <td>'.$classification.'</td>
                        //       <td>'.$action_taken.'</td>
                        //       ';
                          //}
                        ?>  
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                        
            </div>
        </div>
    </div>
  </div>
  
  
  </div>
</div>
  
  
  
  
  
  
  


<?php
include('layouts/footer.php');
?>