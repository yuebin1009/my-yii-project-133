<?php
require_once(Yii::getPathOfAlias('application.vendor.smarty').DIRECTORY_SEPARATOR.'Smarty.class.php');
define('SMARTY_VIEW_DIR',Yii::getPathOfAlias('application.views'));
class CSmarty extends Smarty {

    const DS = DIRECTORY_SEPARATOR;

    function __construct() {

        parent::__construct();

        $this->template_dir = SMARTY_VIEW_DIR.self::DS.'tpl';
        $this->compile_dir =SMARTY_VIEW_DIR.self::DS.'tpl_c';
        $this->caching = true;
        $this->cache_dir =SMARTY_VIEW_DIR.self::DS.'cache';
        //$this->left_delimiter =  '<{';
        //$this->right_delimiter = '}>';
        $this->cache_lifetime = 3600;
    }

    function init(){
        
        /* 
        $projects = scandir(Yii::getPathOfAlias('application.vendor.smarty.sysplugins'));
        foreach( $projects as $project ) {

            if ($project == '.' || $project == '..' || $project == '.svn') {
                continue;
            }
            include_once Yii::getPathOfAlias('application.vendor.smarty.sysplugins').DIRECTORY_SEPARATOR.$project;  
        }
         */

    }

}
