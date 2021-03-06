<?php
    include("modules/aktiviteter_v1.php");
    
    class DeltagerTilmeldingAktiviteterPage7 extends SignupPage
    {
        public function getSlug()
        {
            return 'aktiviteter';
        }
        
        public function __construct(){
        }
        
        public function init()
        {
        }
        
        public function validate()
        {
            $aktiviteter_v1 = new aktiviteter_v1();
            
			$aktiviteter = $aktiviteter_v1->loadAktiviteter();
			$afviklinger = $aktiviteter_v1->loadAfviklinger($aktiviteter);
			
			$_SESSION['customer']['aktiviteter_is_spilleder'] = 0;
			
			foreach($afviklinger as $afvikling)
			{
				if ($_SESSION['customer']['event_'.$afvikling['afvikling_id']]==5)
					$_SESSION['customer']['aktiviteter_is_spilleder'] = 1;
				if ($_SESSION['customer']['event_'.$afvikling['afvikling_id']]==4)
					$_SESSION['customer']['aktiviteter_is_spilleder'] = 1;
			}
			
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
        
        
        public function canShow()
        {
            if (isset($_SESSION['customer']['is_package']) && ($_SESSION['customer']['is_package']==1))
                return false;
            return true;
        }
        
        public function render()
        {
            ?>

        	<form method="post" action="<?php echo get_previous_step_name();?>" class='prev-form'>
                <?php tilm_form_prev_fields(); ?>
                <?php render_previous_button("general_previous_page");?>
        	</form>
        	
        	<form method="post" action="<?php echo get_next_step_name();?>" onSubmit='return validate_form(this);'>
                <?php render_next_button("general_next_page");?>
                <?php tilm_form_prefields(); ?>
                
                <h1 class='entry-title'><?php __etm('nocat_300');?></h1>
                <div id='tilmelding-info'>
                    
                    <?php
                        __etm('nocat_8');
                    ?>

<?php __etm('nocat_9');?>

<?php 
__etm('nocat_9_2');
?>



<script>
    jQuery(document).ready(function()
    {
        
        jQuery(".type-selector").each(function(){
            var day = jQuery(this).data("day");
            var all_types = ['rolle','braet','live','workshop','figur', 'ottoviteter', 'magic'];
            
            for(i=0;i<all_types.length;i++)
            {
                var this_type = all_types[i];
                var type_count = jQuery('#aktiviteter table.table-day-'+day+' tr.row-type-'+this_type).size();
                if (type_count==0){
                    jQuery('.type-selector.selector-day-'+day+' li[data-type="'+this_type+'"]').hide();
                }
            }
        })
        
        jQuery(".type-selector li").click(function()
        {
            var day = jQuery(this).data("day");
            var all_types = ['rolle','braet','live','workshop','figur','ottoviteter', 'magic'];
            var show_type = jQuery(this).data('type');
            
            jQuery('.type-selector.selector-day-'+day+' li').removeClass('selected');
            jQuery('.type-selector.selector-day-'+day+' li[data-type="'+show_type+'"]').addClass('selected');
            
            
            if (show_type==""){
                jQuery('#aktiviteter table.table-day-'+day+' tr.row-with-game').removeClass('hidden');
            }
            else
            {
                jQuery('#aktiviteter table.table-day-'+day+' tr.row-with-game').addClass('hidden');
                jQuery('#aktiviteter table.table-day-'+day+' tr.row-type-'+show_type).removeClass('hidden');
            }
            
            /*
            for(i=0;i<all_types.length;i++)
            {
                var this_type = all_types[i];
                if ((this_type==show_type)||(show_type==""))
                {
                    jQuery('#aktiviteter table.table-day-'+day+' tr.row-type-'+this_type).removeClass('hidden');
                }
                else{
                    jQuery('#aktiviteter table.table-day-'+day+' tr.row-type-'+this_type).addClass('hidden');
                }
            }
            */
        });
    });
</script>

<?php
    
    $aktiviteter_obj = new aktiviteter_v1();
    if ($aktiviteter_obj)
    {
        $aktiviteter_obj->render();
    }
    else
    {
        echo "Error. Unknown";
    }
?>



                    <p><?php __etm('nocat_24');?></p>
                    <?php
        			renderFieldByType(array(
            			'id'=>'max_games',
            			'input-type'=>'select',
            			'input-name'=>'max_games',
            			'text'=>'nocat_25',
            			'value' => array(
                			'0' =>  'nocat_113',
                			'1' =>  'nocat_114',
                			'2' =>  'nocat_115',
                			'3' =>  'nocat_116',
                			'4' =>  'nocat_117',
                			'5' =>  'nocat_118',
                			'6' =>  'nocat_119',
                			'7' =>  'nocat_120',
                			'8' =>  'nocat_121',
                			'9' =>  'nocat_122',
                			'10' => 'nocat_123',
            			),
            			'class'=> array('fullsize-label'),
        			));
                    ?>
                    
                    <?php /*
                    <h2><?php __etm('HelCon');?></h2>
                    <p><?php __etm('I år vender vi blikket mod middelalderens europa, hvor rigfolk og magthavere kæmper om magten, mens paven kæmper mod dæmoner om de levendes sjæle!');?></p>
                    <p><?php __etm('Dette års HelCon ligger i og udenfor spilblokke. Da man spiller i hold og andre afhænger af en forventes det at man som minimum møder op til disse fastsatte tidspunkter (onsdag aften og lørdag eftermiddag). Udover det kan du spille videre udenfor blokkene.');?></p>
                    <p><?php __etm('Læs mere på <a href="http://www.fastaval.dk/aktivitet/helcon-komme-dit-rige/" target="_blank">www.fastaval.dk/aktivitet/helcon-komme-dit-rige/</a>');?></p>
                    <?php
        			renderFieldByType(array(
            			'id'=>'event_helcon',
            			'input-type'=>'checkbox',
            			'input-name'=>'event_helcon',
            			'text'=>'Ja, jeg vil gerne deltage i <a href="http://www.fastaval.dk/aktivitet/helcon-komme-dit-rige/" target="_blank" style="color:#b00;">årets HelCon</a>',
        			));
        			?>
        			*/?>
                    
                    <?php if ($this->get_age()>=13){?>
                    
                    <h2><?php __etm('nocat_28');?></h2>
                    <p><?php __etm('nocat_29');?></p>
                    <?php
        			renderFieldByType(array(
            			'id'=>'scenarieskrivningskonkurrence',
            			'input-type'=>'checkbox',
            			'input-name'=>'scenarieskrivningskonkurrence',
            			'text'=>'nocat_250',
        			));
        			?>
                    
                    
                    
                    <h2><?php __etm('nocat_31');?></h2>
                    <p><?php __etm('nocat_140');?></p>
                    <?php
        			renderFieldByType(array(
            			'id'=>'boardgame_competition',
            			'input-type'=>'checkbox',
            			'input-name'=>'boardgame_competition',
            			'text'=>'nocat_131',
        			));
        			?>

                    <?php }?>
                     
                    
                    <h2><?php __etm('nocat_32');?></h2>
                    <?php
        			renderFieldByType(array(
            			'id'=>'may_contact',
            			'input-type'=>'checkbox',
            			'input-name'=>'may_contact',
            			'text'=>'nocat_33',
        			));
        			?>
        			
                </div>
                <?php render_next_button("general_next_page"); ?>
                <?php tilm_form_postfields(); ?>
        	</form>
        	
        	<form method="post" action="<?php echo get_previous_step_name();?>" class='prev-form'>
                <?php tilm_form_prev_fields(); ?>
                <?php render_previous_button("general_previous_page");?>
        	</form>
        	<?php

        }
    }


