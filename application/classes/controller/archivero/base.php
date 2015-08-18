<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_base extends Controller_Template{
    
    public $template = 'archivero/base';
    public $user;
    protected $auth;
    protected $cache;
    protected $session;
    
    public function before(){
        parent::before();
        I18n::lang('es');
      //  Cookie::$salt = 'eqw67dakbs';
      //  Session::$default = 'cookie';
	$this->session = Session::instance();
	$this->template->title = '';
	$this->template->page_title = '';
        $this->template->styles = array();
        $this->template->scripts = array();
	$this->template->menu = null;
	$this->template->info = null;
	$this->template->block_left = null;
	$this->template->content = null;
	$this->template->block_right = null;
    }
}