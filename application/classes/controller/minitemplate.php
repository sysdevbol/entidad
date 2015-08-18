<?php
 defined('SYSPATH') or die('No direct script access.');
 
 class Controller_Minitemplate extends Controller_Template
  {
     public $template = 'templates/mini';
     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();
         if($this->auto_render)
          {
            // Initialize empty values
            $this->template->title            = '';
            $this->template->theme            = 'azul';
            $this->template->content          = '';           
            $this->template->styles           = array();
            $this->template->scripts          = array();
          }
      }
     /**
      * Fill in default values for our properties before rendering the output.
      */
     public function after()
     {
         if($this->auto_render)
          {
             // Define defaults
             $styles                  = array( 
                                              'media/css/themes/'.$this->template->theme.'.css'=>'screen',
                                              'media/css/style.css'=>'all',
                                              'media/css/main.css'=>'all',
                                              'media/css/input.css'=>'screen',
                                              'media/css/tablas.css'=>'all',
                                            //  'media/css/flick/jquery-ui-1.9.0.custom.css'=>'all'
                                              );
              
             $scripts                 = array(
                                           //   'media/js/autoNumeric.min.js',
                                           //   'media/Highcharts/js/highcharts.js',
                                          //    'media/js/jquery-ui-1.9.0.custom.min.js',
                                              'media/js/jquery-1.7.2.min.js'
                                              );
             // Add defaults to template variables.
             $this->template->styles  = array_reverse(array_merge($this->template->styles, $styles));
             $this->template->scripts = array_reverse(array_merge($this->template->scripts, $scripts));
           }
         // Run anything that needs to run after this.
         parent::after();
      }
 }
?>