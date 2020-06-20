<?php
/**
 * general medecine consultation
 *
 * @package     general medecine consultation
 * @author      Solange Iyubu
 * @license     GPLv3
 *
 * @wordpress-plugin
 * Plugin Name: general medecine consultation
 * Version: 2.0.1
 * Description: The user who is not an administrator enters information into the created admin form in his/her own account and submits them into the WordPress Database
 * Author: Solange Iyubu
 * Author URI: https://github.com/Siyubu
 * Plugin URI:https://github.com/Siyubu/muganga-mwiza
 * Text Domain: consultation
 * License: Muganga Mwiza
 * License URI: https://www.mugangamwiza.rw/
 */
wp_register_style('generalMedecineConsultationCss', 'general-medecine-consultation-css.php');
wp_enqueue_style( 'generalMedecineConsultationCss');
  class GeneralMedecineConsultation{  
        
        private $my_plugin_screen_name;  
        private static $instance;  
      
        static function GetInstance()  
        {  
              
            if (!isset(self::$instance))  
            {  
                self::$instance = new self();  
            }  
            return self::$instance;  
        }  
          
        public function PluginMenu()  
        {  
         $this->my_plugin_screen_name = add_menu_page(  
                                          'General Medecine Consultation',   
                                          'General Medecine Consultation',   
                                          'manage_options',  
                                          _FILE_,   
                                          array($this, 'RenderPage'),   
                                          plugins_url('/img/icon.png',_DIR_)  
                                          );  
        }  
          
        public function RenderPage(){  
         ?>  
         <div class='wrap'>  

         <div class="page-inner" style="min-height:1631px !important">
         <div class="page-title">
         <div id="main-wrapper">
		 <div class="row">

          <h2>General Medecine Consultation</h2>  
          <div class="main-content">  
    
          <!-- You only need this form and the form-basic.css -->  
    
          <form class="form-basic" method="post" action="#">  
    
              <div class="form-title-row">  
                  <h1>General Medecine Consultation Form</h1>  
              </div> 
              <div data-field-wrapper="fld_7817980" class="form-group" id="fld_7817980_1-wrap">
	<label id="fld_7817980Label" for="fld_7817980_1" class="control-label">Patient Clinical Identity Number <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
	<div class="">
		<input   required type="text" data-field="fld_7817980" class=" form-control" id="fld_7817980_1" name="fld_7817980" value="" data-type="text" aria-required="true"   aria-labelledby="fld_7817980Label" >		</div>
        </div> 
    
              <div class="form-row">  
                  <label>  
                      <span>Email</span>  
                      <input type="email" name="email">  
                  </label>  
              </div>  
    
              <div class="form-row">  
                  <label>  
                      <span>Dropdown</span>  
                      <select name="dropdown">  
                          <option>Option One</option>  
                          <option>Option Two</option>  
                          <option>Option Three</option>  
                          <option>Option Four</option>  
                      </select>  
                  </label>  
              </div>  
    
              <div class="form-row">  
                  <label>  
                      <span>Textarea</span>  
                      <textarea name="textarea"></textarea>  
                  </label>  
              </div>  
    
              <div class="form-row">  
                  <label>  
                      <span>Checkbox</span>  
                      <input type="checkbox" name="checkbox" checked>  
                  </label>  
              </div>  
    
              <div class="form-row">  
                  <label><span>Radio</span></label>  
                  <div class="form-radio-buttons">  
    
                      <div>  
                          <label>  
                              <input type="radio" name="radio">  
                              <span>Radio option 1</span>  
                          </label>  
                      </div>  
    
                      <div>  
                          <label>  
                              <input type="radio" name="radio">  
                              <span>Radio option 2</span>  
                          </label>  
                      </div>  
    
                      <div>  
                          <label>  
                              <input type="radio" name="radio">  
                              <span>Radio option 3</span>  
                          </label>  
                      </div>  
    
                  </div>  
              </div>  
    
              <div class="form-row">  
                  <button type="submit">Submit Form</button>  
              </div>  
    
          </form>  
    
      </div>  
            
         </div>
         </div>
         </div>
         </div>
         </div>  
         <?php  
        }  
    
        public function InitPlugin()  
        {  
             add_action('admin_menu', array($this, 'PluginMenu'));  
        } 
        register_activation_hook( _FILE_, 'my_plugin_create_db' );
        
         // Create DB Here
        public function my_plugin_create_db() {
           
    global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'general_medicine_consultation';

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		views smallint(5) NOT NULL,
		clicks smallint(5) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
        }
        // make our plug in accessible  
    public function activate_plugin_name() {
            $role = get_role( 'Nurse' );
            $role->add_cap( 'manage_options' ); // capability
         }
   }  
     
  $GeneralMedecineConsultation = GeneralMedecineConsultation::GetInstance();  
  $GeneralMedecineConsultation->InitPlugin();
  //$GeneralMedecineConsultation->my_plugin_create_db(); 
  $GeneralMedecineConsultation->activate_plugin_name(); 
  ?>