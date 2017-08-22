<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Bar Chart Example <small>With custom colors.</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

							<div class="flot-chart">
							<?php
							$arr_str="";
							$arr_str="{label: \"bar\",data: [";

							$i=1;
							foreach($views as $vs){
								//echo sprintf('[%s,%s],',$i,$vs->{'cnt'});
							$arr_str=$arr_str.sprintf("[%s,%s],",date("d",strtotime($vs->{'DATE'})),$vs->{'cnt'});
							
							$i++;

							}
							//echo $arr_str;
							$arr_str=$arr_str.']}';
//							echo $arr_str;
							?>
  <SCRIPT>
  
      var barData = <?php echo $arr_str;?>;

		</SCRIPT>
								<div class="flot-chart-content" id="flot-bar-chart"></div>
								<div class="flot-chart-content"  id="flot-line-chart-multi"></div>
                            </div>

                    </div>
                </div>
            </div>
</div><!-- <div class="wrapper wrapper-content animated fadeInRight"> -->
