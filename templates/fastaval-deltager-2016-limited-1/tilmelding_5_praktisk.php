<?php
    
    class DeltagerTilmeldingPratiskPage5 extends SignupPage
    {
        public function init()
        {
        }
        
        public function canShow()
        {
            return true;
        }
        
        public function get_age(){
            $year = $_SESSION['customer']['birthday-year']*1;
            $day = $_SESSION['customer']['birthday-day']*1;
            $month = $_SESSION['customer']['birthday-month']*1;
            $age = 100;
            
            if (is_numeric($year)&&is_numeric($month)&&is_numeric($day))
            {
                $birthDate = $year."-".($month<10?"0":"").$month."-".($day<10?"0":"").$day;
                # object oriented
                $from = new DateTime($birthDate);
                $to   = new DateTime('today');
                return $from->diff($to)->y;
            }
            return $age;
        }
        
        public function render()
        {
            
            if ($this->get_age()>=13)
            {
                ?>
                <script>
                    function validate_form(the_form){
                        if (
                            (jQuery('#days_all').attr('checked')=="checked")   ||
                            (jQuery('#days_1').attr('checked')=="checked")   ||
                            (jQuery('#days_2').attr('checked')=="checked")   ||
                            (jQuery('#days_3').attr('checked')=="checked")   ||
                            (jQuery('#days_4').attr('checked')=="checked")   ||
                            (jQuery('#days_5').attr('checked')=="checked")
                        )
                            return true;
                        alert('<?php __etm('nocat_127')?>');
                        return false;
                    }
                </script>
                <?php
            }
            ?>
            
        	<form method="post" action="<?php echo get_previous_step_name();?>" class='prev-form'>
                <?php tilm_form_prev_fields(); ?>
                <?php render_previous_button("general_previous_page");?>
        	</form>
        	
        	<form method="post" action="<?php echo get_next_step_name();?>" onSubmit='return validate_form(this);'>
                <?php render_next_button("general_next_page");?>
                <?php tilm_form_prefields(); ?>
                
                <h1 class='entry-title'><?php __etm('page4_text1');?></h1>
                <div id='tilmelding-info'>
                    
                    <?php
                        
                    if ($this->get_age()<13){
                        ?>
                        <input type='hidden' name='days_all' id='days_all' value='1'>
                        <?php
                    }
                    else
                    {
                        ?>
                        <h2><?php __etm('page4_text2');?></h2>
                        <?php
                    
            			renderFieldByType(array(
                			'id'=>'field_days_all',
                			'input-type'=>'checkbox',
                			'input-name'=>'days_all',
                			'text'=>'page4_text3',
            			));
            			?>
            			<script>
                			jQuery(document).ready(function()
                			{
                    			function days_logic()
                    			{
                        			if (jQuery('#days_all').attr('checked'))
                        			{
                            			jQuery('#days_1').attr("disabled", true);
                            			jQuery('#days_2').attr("disabled", true);
                            			jQuery('#days_3').attr("disabled", true);
                            			jQuery('#days_4').attr("disabled", true);
                            			jQuery('#days_5').attr("disabled", true);
                            			
                            			jQuery('.field_days_1 label').addClass('disabled');
                            			jQuery('.field_days_2 label').addClass('disabled');
                            			jQuery('.field_days_3 label').addClass('disabled');
                            			jQuery('.field_days_4 label').addClass('disabled');
                            			jQuery('.field_days_5 label').addClass('disabled');
                        			}
                        			else{
                            			jQuery('#days_1').attr("disabled", false);
                            			jQuery('#days_2').attr("disabled", false);
                            			jQuery('#days_3').attr("disabled", false);
                            			jQuery('#days_4').attr("disabled", false);
                            			jQuery('#days_5').attr("disabled", false);
                            			jQuery('.field_days_1 label').removeClass('disabled');
                            			jQuery('.field_days_2 label').removeClass('disabled');
                            			jQuery('.field_days_3 label').removeClass('disabled');
                            			jQuery('.field_days_4 label').removeClass('disabled');
                            			jQuery('.field_days_5 label').removeClass('disabled');
                        			}
                    			}
                    			jQuery('#days_all').click(function()
                    			{
                        			days_logic();
                    			});
                    			days_logic();
    
    
                                jQuery('.link-previous').click(function()
                                {
                                    jQuery("form.prev-form:first-child input[type='submit']").click();
                                    //alert("aa");
                                });
    
                			});
                        </script>
                        <?php
                        if (!isset($_SESSION['customer']['new_alea']))
                        {
                            ?><p class='indent'><?php 
                            __etm('page4_text4');
                            ?></p><?php
                        }
                        
                        if (isset($_SESSION['customer']['new_alea']))
                        {
                            ?><p class='indent'><?php 
                            __etm('nocat_145');
                            ?></p><?php 
                        }
                        
                        ?><div class='grouped'><?php
            			renderFieldByType(array(
                			'id'=>'field_days_1',
                			'input-type'=>'checkbox',
                			'input-name'=>'days_1',
                			'text'=>'page4_text5',
            			));
            			renderFieldByType(array(
                			'id'=>'field_days_2',
                			'input-type'=>'checkbox',
                			'input-name'=>'days_2',
                			'text'=>'page4_text6',
            			));
            			renderFieldByType(array(
                			'id'=>'field_days_3',
                			'input-type'=>'checkbox',
                			'input-name'=>'days_3',
                			'text'=>'page4_text7',
            			));
            			renderFieldByType(array(
                			'id'=>'field_days_4',
                			'input-type'=>'checkbox',
                			'input-name'=>'days_4',
                			'text'=>'page4_text8',
            			));
            			renderFieldByType(array(
                			'id'=>'field_days_5',
                			'input-type'=>'checkbox',
                			'input-name'=>'days_5',
                			'text'=>'page4_text9',
            			));
                        ?></div><?php
                    }
            			
            			
                    ?><h2><?php __etm('page4_text10');?></h2><?php
                        
        			renderFieldByType(array(
            			'id'=>'field_days_sleeping',
            			'input-type'=>'checkbox',
            			'input-name'=>'days_sleeping',
            			'text'=>'page4_text11',
        			));
        			?>
        			<script>
            			
            			function sleeping_logic()
            			{
                			if (jQuery('#days_sleeping').attr('checked')){
                    			jQuery('#days_sleeping_1').attr("disabled", true);
                    			jQuery('#days_sleeping_2').attr("disabled", true);
                    			jQuery('#days_sleeping_3').attr("disabled", true);
                    			jQuery('#days_sleeping_4').attr("disabled", true);
                    			jQuery('#days_sleeping_5').attr("disabled", true);
                    			
                    			jQuery('.field_days_sleeping_1 label').addClass('disabled');
                    			jQuery('.field_days_sleeping_2 label').addClass('disabled');
                    			jQuery('.field_days_sleeping_3 label').addClass('disabled');
                    			jQuery('.field_days_sleeping_4 label').addClass('disabled');
                    			jQuery('.field_days_sleeping_5 label').addClass('disabled');
                			}
                			else{
                    			jQuery('#days_sleeping_1').attr("disabled", false);
                    			jQuery('#days_sleeping_2').attr("disabled", false);
                    			jQuery('#days_sleeping_3').attr("disabled", false);
                    			jQuery('#days_sleeping_4').attr("disabled", false);
                    			jQuery('#days_sleeping_5').attr("disabled", false);
                    			jQuery('.field_days_sleeping_1 label').removeClass('disabled');
                    			jQuery('.field_days_sleeping_2 label').removeClass('disabled');
                    			jQuery('.field_days_sleeping_3 label').removeClass('disabled');
                    			jQuery('.field_days_sleeping_4 label').removeClass('disabled');
                    			jQuery('.field_days_sleeping_5 label').removeClass('disabled');
                			}
            			}
            			jQuery(document).ready(function()
            			{
                			jQuery('#days_sleeping').click(function()
                			{
                    			sleeping_logic();
                			});
                			
                			sleeping_logic();
            			});
                    </script>
        			<?php
        			
        			if ($_SESSION['customer']['participant']!="deltager")
        			{
            			?><p><strong><?php
                        __etm('page4_text12');
            			?></strong></p><?php
                    }
        			?>
                    <?php
                    ?><div class='grouped'><?php
        			renderFieldByType(array(
            			'id'=>'field_days_sleeping_1',
            			'input-type'=>'checkbox',
            			'input-name'=>'days_sleeping_1',
            			'text'=>'page4_text13',
        			));
        			renderFieldByType(array(
            			'id'=>'field_days_sleeping_2',
            			'input-type'=>'checkbox',
            			'input-name'=>'days_sleeping_2',
            			'text'=>'page4_text14',
        			));
        			renderFieldByType(array(
            			'id'=>'field_days_sleeping_3',
            			'input-type'=>'checkbox',
            			'input-name'=>'days_sleeping_3',
            			'text'=>'page4_text15',
        			));
        			renderFieldByType(array(
            			'id'=>'field_days_sleeping_4',
            			'input-type'=>'checkbox',
            			'input-name'=>'days_sleeping_4',
            			'text'=>'page4_text16',
        			));
        			renderFieldByType(array(
            			'id'=>'field_days_sleeping_5',
            			'input-type'=>'checkbox',
            			'input-name'=>'days_sleeping_5',
            			'text'=>'page4_text17',
        			));
                    ?></div><?php
                    ?>
                    
                    <p><?php __etm('page4_text18');?></p>
                    
                    <?php
        			renderFieldByType(array(
            			'id'=>'field_days_rent_madras',
            			'input-type'=>'checkbox',
            			'input-name'=>'days_rent_madras',
            			'text'=>'page4_text19',
        			));
        			?>
                </div>
                <?php tilm_form_postfields(); ?>
                <?php render_next_button("general_next_page");?>
        	</form>
        	
        	<form method="post" action="<?php echo get_previous_step_name();?>" class='prev-form'>
                <?php tilm_form_prev_fields(); ?>
                <?php render_previous_button("general_previous_page");?>
        	</form>
        	<?php

        }
    }


