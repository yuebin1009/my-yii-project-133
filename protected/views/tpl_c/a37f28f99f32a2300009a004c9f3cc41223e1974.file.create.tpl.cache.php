<?php /* Smarty version Smarty-3.1.18, created on 2014-06-26 14:48:15
         compiled from "/var/www/html/yuebin/web/protected/views/tpl/create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:209777316553abc052964c13-13913947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a37f28f99f32a2300009a004c9f3cc41223e1974' => 
    array (
      0 => '/var/www/html/yuebin/web/protected/views/tpl/create.tpl',
      1 => 1403765294,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209777316553abc052964c13-13913947',
  'function' => 
  array (
  ),
  'cache_lifetime' => 3600,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53abc052965574_16051279',
  'variables' => 
  array (
    'test' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53abc052965574_16051279')) {function content_53abc052965574_16051279($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/html/yuebin/web/protected/vendor/smarty/plugins/modifier.date_format.php';
?><h1><?php echo $_smarty_tpl->tpl_vars['test']->value;?>
</h1>
The current date and time is <?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>

<?php }} ?>
