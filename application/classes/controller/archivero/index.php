<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_index extends Controller_archivero_base{
    
    public function before(){
        parent::before();
       /* include Kohana::find_file('classes','simplewiki/muster/simplewiki');
        include Kohana::find_file('classes','simplewiki/muster/simplewiki/parser');
        include Kohana::find_file('classes','simplewiki/muster/simplewiki/emitter');
        include Kohana::find_file('classes','simplewiki/muster/simplewiki/docnode');
        */
        $menu = View::factory('archivero/menu');
        $this->template->menu = $menu;
        $this->template->content = '';
	$this->template->title = 'Administrador';
	$this->template->page_title = 'Pagina Principal Admin';
        
        //Admin
        $this->template->scripts[] = 'assets/js/jquery-1.7.2.min.js';
        $this->template->scripts[] = 'assets/js/jquery-ui-1.8.21.custom.min.js';
        $this->template->scripts[] = 'assets/js/bootstrap-transition.js';
        $this->template->scripts[] = 'assets/js/bootstrap-alert.js';
        $this->template->scripts[] = 'assets/js/bootstrap-modal.js';
        $this->template->scripts[] = 'assets/js/bootstrap-dropdown.js';
        $this->template->scripts[] = 'assets/js/bootstrap-scrollspy.js';
        $this->template->scripts[] = 'assets/js/bootstrap-tab.js';
        $this->template->scripts[] = 'assets/js/bootstrap-tooltip.js';
        $this->template->scripts[] = 'assets/js/bootstrap-popover.js';
        $this->template->scripts[] = 'assets/js/bootstrap-button.js';
        $this->template->scripts[] = 'assets/js/bootstrap-collapse.js';
        $this->template->scripts[] = 'assets/js/bootstrap-carousel.js';
        $this->template->scripts[] = 'assets/js/bootstrap-typeahead.js';
        $this->template->scripts[] = 'assets/js/bootstrap-tour.js';
       // $this->template->scripts[] = 'js/jquery.cookie.js';
        $this->template->scripts[] = 'assets/js/fullcalendar.min.js';
        $this->template->scripts[] = 'assets/js/jquery.dataTables.min.js';
        $this->template->scripts[] = 'assets/js/excanvas.js';
        $this->template->scripts[] = 'assets/js/jquery.flot.min.js';
        $this->template->scripts[] = 'assets/js/jquery.flot.pie.min.js';
        $this->template->scripts[] = 'assets/js/jquery.flot.stack.js';
        $this->template->scripts[] = 'assets/js/jquery.flot.resize.min.js';
        $this->template->scripts[] = 'assets/js/jquery.chosen.min.js';
        $this->template->scripts[] = 'assets/js/jquery.uniform.min.js';
        $this->template->scripts[] = 'assets/js/jquery.colorbox.min.js';
        $this->template->scripts[] = 'assets/js/jquery.cleditor.min.js';
        $this->template->scripts[] = 'assets/js/jquery.noty.js';
        $this->template->scripts[] = 'assets/js/jquery.elfinder.min.js';
        $this->template->scripts[] = 'assets/js/jquery.raty.min.js';
        $this->template->scripts[] = 'assets/js/jquery.iphone.toggle.js';
        $this->template->scripts[] = 'assets/js/jquery.autogrow-textarea.js';
        $this->template->scripts[] = 'assets/js/jquery.uploadify-3.1.min.js';
        //$this->template->scripts[] = 'js/jquery.history.js';
      //  $this->template->scripts[] = 'js/charisma.js';
        $this->template->styles[] = 'assets/css/bootstrap-cerulean.css';
        $this->template->styles[] = 'assets/css/bootstrap-responsive.css';
        $this->template->styles[] = 'assets/css/charisma-app.css';
        $this->template->styles[] = 'assets/css/jquery-ui-1.8.21.custom.css';
        $this->template->styles[] = 'assets/css/fullcalendar.css';
        $this->template->styles[] = 'assets/css/fullcalendar.print.css';
        $this->template->styles[] = 'assets/css/chosen.css';
        $this->template->styles[] = 'assets/css/uniform.default.css';
        $this->template->styles[] = 'assets/css/colorbox.css';
        $this->template->styles[] = 'assets/css/jquery.cleditor.css';
        $this->template->styles[] = 'assets/css/jquery.noty.css';
        $this->template->styles[] = 'assets/css/noty_theme_default.css';
        $this->template->styles[] = 'assets/css/elfinder.min.css';
        $this->template->styles[] = 'assets/css/elfinder.theme.css';
        $this->template->styles[] = 'assets/css/jquery.iphone.toggle.css';
        $this->template->styles[] = 'assets/css/opa-icons.css';
        $this->template->styles[] = 'assets/css/uploadify.css';
        //Lightbox2
        $this->template->scripts[]  = 'assets/js/lightbox.js';
        $this->template->styles[]  = 'assets/css/lightbox.css';
        //Simple Wiki
        //$this->template->scripts[]  = 'application/classes/simplewiki/SimpleWiki.js';
        //$this->template->styles[]  = 'application/classes/simplewiki/SimpleWiki.css';
        $this->template->scripts[]  = 'assets/js/SimpleWiki.js';
        $this->template->styles[]  = 'assets/css/SimpleWiki.css';
    }
    
    public function action_index(){
        HTTP::redirect('Archivosgestion');
        //$this->template->content = View::factory('/dashboard');
    }
	
}