<?php
    
    class DeltagerTilmeldingMoreInfoPage10 extends SignupPage
    {
        public function init()
        {
        }
        
        public function canShow()
        {
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
                <?php render_next_button("nocat_43");?>
                <?php tilm_form_prefields(); ?>
                
                <h1 class='entry-title'><?php __etm('nocat_44');?></h1>
                
                <div id='tilmelding-info'>
                    
                    <h3><?php __etm('nocat_45');?></h3>
                    <p><?php __etm('nocat_199');?></p>
                    <?php
        			renderFieldByType(array(
            			'id'=>'other_dansk',
            			'input-type'=>'checkbox',
            			'input-name'=>'other_dansk',
            			'text'=>'nocat_46',
        			));
        			renderFieldByType(array(
            			'id'=>'other_engelsk',
            			'input-type'=>'checkbox',
            			'input-name'=>'other_engelsk',
            			'text'=>'nocat_47',
        			));
        			renderFieldByType(array(
            			'id'=>'other_scandinavisk',
            			'input-type'=>'checkbox',
            			'input-name'=>'other_scandinavisk',
            			'text'=>'nocat_200',
        			));
        			renderFieldByType(array(
            			'id'=>'simultantolk',
            			'input-type'=>'checkbox',
            			'input-name'=>'simultantolk',
            			'text'=>'nocat_201',
        			));
        			renderFieldByType(array(
            			'id'=>'other_international',
            			'input-type'=>'checkbox',
            			'input-name'=>'other_international',
            			'text'=>'nocat_202',
        			));
        			?>
        			
        			
                    
                    <h3><?php __etm('nocat_203');?></h3>
                    <?php
        			renderFieldByType(array(
            			'id'=>'other_2010',
            			'input-type'=>'checkbox',
            			'input-name'=>'other_2010',
            			'text'=>'nocat_204',
        			));
        			renderFieldByType(array(
            			'id'=>'other_richbastard',
            			'input-type'=>'checkbox',
            			'input-name'=>'other_richbastard',
            			'text'=>'nocat_205',
        			));
        			renderFieldByType(array(
            			'id'=>'other_secretbastard',
            			'input-type'=>'checkbox',
            			'input-name'=>'other_secretbastard',
            			'text'=>'nocat_206',
        			));
        			
        			/*
        			renderFieldByType(array(
            			'id'=>'game_reallocation_participant',
            			'input-type'=>'checkbox',
            			'input-name'=>'game_reallocation_participant',
            			'text'=>'Jeg medbringer et par bræt- eller rollespil at give væk til "The Fastaval Re-Allocation Project" ',
        			));
        			*/
        			?>
                    
                    
                    
                    
                    <h3><?php __etm('nocat_207');?></h3>
                    <?php
        			renderFieldByType(array(
            			'id'=>'ready_mandag',
            			'input-type'=>'checkbox',
            			'input-name'=>'ready_mandag',
            			'text'=>'nocat_208',
        			));
        			renderFieldByType(array(
            			'id'=>'ready_tirsdag',
            			'input-type'=>'checkbox',
            			'input-name'=>'ready_tirsdag',
            			'text'=>'nocat_209',
        			));
        			?>
                    
                    
                    
                    
                    <h3><?php __etm('nocat_210');?></h3>
                    <p><?php __etm('nocat_211');?></p>
        			<?php
            			renderFieldByType(array(
                			'id'=>'special_skills',
                			'input-type'=>'textarea',
                			'input-name'=>'special_skills',
                			'text'=>'',
            			));
                    ?>
                    <p><?php __etm('nocat_212');?></p>
                    
                    
                    
                    <h3><?php __etm('nocat_213');?></h3>
                    <?php __etm('nocat_214');?>
        			<?php
            			renderFieldByType(array(
                			'id'=>'other_comments',
                			'input-type'=>'textarea',
                			'input-name'=>'other_comments',
                			'text'=>'',
            			));
                    ?>
                    
                </div>
                
                <?php tilm_form_postfields(); ?>
                <?php render_next_button("nocat_43"); ?>
        	</form>
        	
        	<form method="post" action="<?php echo get_previous_step_name();?>" class='prev-form'>
                <?php tilm_form_prev_fields(); ?>
                <?php render_previous_button("general_previous_page");?>
        	</form>
        	<?php

        }
    }



