<?php
     class gds_v1{
         
         function ProperCase($string)
         {
         	$string = strtolower($string);
    		$string = substr_replace($string, strtoupper(substr($string, 0, 1)), 0, 1);
    		return $string;
         }
         
    	function loadJSON($url){
    		$c = curl_init();
    		curl_setopt($c, CURLOPT_URL, "http://127.0.0.1/".$url);
    		curl_setopt($c, CURLOPT_HEADER, false);
    		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($c, CURLOPT_REFERER, '');
    		curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-GB; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2');
    		curl_setopt($c, CURLOPT_HTTPHEADER, array('Host: infosys.fastaval.dk'));
    		$data = curl_exec($c);
    		curl_close($c);
    		$json = json_decode($data,true);
         	return $json;
    	} 
        
     
      	function __construct(){
     	}
	     function getFields()
	     {
			$result = array();
			$result[] = 'user_gds';
			return $result;
	     }
	     function validateFields()
	     {
			$customer = $_SESSION['customer'];
		     
	     	if ($customer['participant']!='deltager')
	     		return true;
	     	
	     	if ($customer['aktiviteter_is_spilleder']>0)
	     		return true;
	     	
		     if (count($customer['user_gds'])<3)
		     {
				return __etm("Vælg mindst tre GDS tjanser. Du vil kun f&aring; en af dem (medmindre du har valgt super-GDS, eller at du kan tage flere tjanser)")."<br><br>";
		     }
		     
	     	return true;
	     }
	
		function getGDSCategory($a_id)
		{
			$json = $this->loadJSON("api/gdscategories/".$a_id);
			return $json;
		}

		function render(){
			$customer = $_SESSION['customer'];
			
			$days = array();
			
		     $json = $this->loadJSON("api/gds/*");
		     $vagter = array();
		     $lang = get_language();
		     foreach($json as $tjans)
		     {
		     	$gds_id = $tjans['category_id'];
		     	$title = $tjans['info']['title_'.$lang];
		     	$category_gds = $this->getGDSCategory($gds_id);
		     	$title = $category_gds[0]['category_'.$lang];
		     	
		     	
		     	$description = $tjans['info']['description_'.$lang];
		     	$vagter = $tjans['vagter'];
		     	foreach($vagter as $vagt)
		     	{
		     		$periode = $vagt['period'];
		     		
		     		$day = substr($periode,0,strpos($periode," "));
		     		$daypart = substr($periode,strpos($periode," ")+1,strlen($periode));
		     		$time = strtotime($day);
		     		if (!isset($days[$time])){
			     		$days[$time][$gds_id] = array();
		     		}
		     		$days[$time][$gds_id]['gds_id'] = $gds_id;
		     		$days[$time][$gds_id]['title'] = $title;
		     		$days[$time][$gds_id]['description'] = $description;
		     		$days[$time][$gds_id]['day'] = $day;
		     		$days[$time][$gds_id]['parts'][] = $daypart;
		     	}
		     	
		     }
			?>
			<div id='aktiviteter'>     
				<?php
				
				function cmpDays($a, $b)
				{
				    return $a>$b;
				}
				
				uksort($days, "cmpDays");
			
				foreach($days as $time=>$day){
					
					$these_months = split(",","januar,februar,marts,april,maj,juni,juli,august,september,oktober,november,december");
					$these_days = split(",","mandag,tirsdag,onsdag,torsdag,fredag,lørdag,søndag");
					$this_year = date("Y",$time);
					$this_day = date("j",$time);
					$this_month = $these_months[date("n",$time)-1];
					$this_day_text = $these_days[date("N",$time)-1];
					
					?>
					<table border=0 cellspacing=0 cellpadding=0 style='border:1px solid black;margin-bottom:20px;'>
					<tr>
						<th colspan='4' class='day'><?php echo __etm($this->ProperCase($this_day_text))?> (<?php echo $this_day?>. <?php echo $this_month?> <?php echo $this_year?>)</th>
					</tr>
					<tr>
						<th class='caption'>Aktiviteter</th>
						<th style='width:150px;' class='time'><?php echo __etm('Morgen')?></th>
						<th style='width:150px;' class='time'><?php echo __etm('Middag')?></th>
						<th style='width:150px;' class='time'><?php echo __etm('Aften')?></th>
					</tr>
					<?php
					foreach($day as $gds){
						?>
						<tr>
							<td>&nbsp;<?php echo $gds['title']?></td>
							<?php
							
							$arr = array("04-12","12-17","17-04");
							foreach($arr as $daypart){
								if (in_array($daypart,$gds['parts'])){
									$gds_id = $gds['gds_id'];
									$value = $gds['gds_id']."|".$gds['day']." ".$daypart;
									$checked = false;
									if (isset($customer['user_gds']))
										$checked = in_array($value,$customer['user_gds']);
									?><td>
										<div class='event priority0' style='width:148px'>
											<input type='checkbox' value='<?php echo $value;?>' style='display:inline;margin-left:auto;margin-right:auto;' name='user_gds[]'<?php echo $checked?" checked":""?>>
										</div>
									</td><?php
								}
								else{
									?><td>&nbsp;</td><?php
								}
							}
							?>
						</tr>
						<?php
					}
				}
				?>
				</table>			
			</div>
			
		     <div class='error' id='GDS_v1'><?=getError("GDS_v1")?></div></li>
		     
			<?
		}
	}
