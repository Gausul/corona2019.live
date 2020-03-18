    <section id="main-content">
      <section class="wrapper">
<?php

if(!empty($country_data)){
?>  
         <div class="col-md-9" style="margin-top: 30px;">

            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Country Data</h4>
              <table class="table" >
                <thead>
                  <tr>
                    <th>Country</th>
                    <th style="text-align: center;">Active cases</th>
                    <th style="text-align: center;">Recovered cases</th>
                    <th style="text-align: center;">Fatal cases</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>
                      <?=$country_data->country_name;?>
                    </th>
                    <td style="text-align: center;"><?=$country_data->total_case;?></td>
                    <td style="text-align: center;"><?=$country_data->recovered_cases;?></td>
                    <td style="text-align: center;"><?=$country_data->fatal_cases;?></td>
                  </tr>               
                </tbody>
              </table>
            
<?php } ?>

<?php
$state_data=$this->admin_model->resselect('cronadata','country_code',$country_id,'total_case','DESC');
if(!empty($state_data)){
?>  
         <h4><i class="fa fa-angle-right"></i> State Wise Data</h4>
             <style type="text/css">
               .t1 {
    display:block;
    height:400px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
    color: #222;

}
             </style>


              <table class="table" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>State</th>
                    
                    <th style="text-align: center;">Active cases</th>
                    <th style="text-align: center;">Recovered cases</th>
                    <th style="text-align: center;">Fatal cases</th>
                  </tr>
                </thead>
                <tbody class="t1">
<?php
$i=1;

foreach($state_data as $sd){
?>
                  <tr>
                    <td><?=$i;?></td>
                    <th><?=$sd->state_name;?></th>
                    <td style="text-align: center;"><?=$sd->total_case;?> <?php 
if(!empty($sd->total_case_text)){ echo '<br>'.$sd->total_case_text; }

                    ?></td>
                    <td style="text-align: center;"><?=$sd->total_recovered;?></td>
                    <td style="text-align: center;"><?=$sd->total_dead;?></td>
                  </tr>
 <?php $i++;} ?>                
                </tbody>
              </table>
<?php } ?>
            </div>
          </div>
          <div class="col-lg-3 ds" style="margin-top: 4px;">
            <!--COMPLETED ACTIONS DONUTS CHART-->
            <div class="donut-main">
              <h4>GLOBEL TOTAL CONFIRMED CASES</h4>
              <canvas id="newchart" height="130" width="130"></canvas>
<?php
$finaltotal=($total_count->total-$country_data->total_case);
$finalper=(($finaltotal*100)/$total_count->total);
$country_per=(($country_data->total_case*100)/$total_count->total);
?>

               <script>
                var doughnutData = [{
                    value: <?=$finalper;?>,
                    color: "#4ECDC4"
                  },
                  {
                    value: <?=$country_per;?>,
                    color: "#fdfdfd"
                  }
                ];
                var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
              </script> 
            </div>
            <!--NEW EARNING STATS -->
            <div class="panel">
              <div class="panel-body">
                <div class="chart">
                  <div class="centered">
                    <span>GLOBAL CONFIRMED CASES</span>
                    <h3 style="margin-top: 3px;color: red;font-weight: 600;"><?php 
echo($total_count->total);
                    ?></h3>
                  </div>
                  <div class="centered">
                    <span>CONFIRMED CASES IN <?=strtoupper($country_data->country_name);?></span>
                    <h4 style="margin-top: 3px;color: red;font-weight: 600;"><?=$country_data->total_case;?></h4>
                  </div>
                    <div>
                    <span>RECOVERED CASES IN <?=strtoupper($country_data->country_name);?></span>
                    <h4 style="margin-top: 3px;color: green;font-weight: 600;"><?=$country_data->recovered_cases;?></h4>
                  </div>
                    <div>
                    <span>DEATHS CASES IN <?=strtoupper($country_data->country_name);?></span>
                    <h4 style="margin-top: 3px;color: black;font-weight: 600;"><?=$country_data->fatal_cases;?></h4>
                  </div>
                  
                </div>
              </div>
            </div>
        
          </div>
          <!-- /col-lg-3 -->
        </div>
        <!-- /row -->
      </section>

    </section>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>