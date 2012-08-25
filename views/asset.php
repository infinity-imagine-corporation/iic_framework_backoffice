<!--Global JS variable-->
<script type="text/javascript">
URL_SERVER = '<?php echo site_url() ?>/';
URL_IMAGE = URL_SERVER + 'application/modules/backoffice/assets/img/';

LANG_ALERT = '<?php echo $this->lang->line('alert') ?>';
LANG_CREATE = '<?php echo $this->lang->line('create') ?>';
LANG_EDIT = '<?php echo $this->lang->line('edit') ?>';
LANG_LOGIN = '<?php echo $this->lang->line('login') ?>';
LANG_OK = '<?php echo $this->lang->line('ok') ?>';
LANG_SAVE = '<?php echo $this->lang->line('save') ?>';
LANG_USERNAME = '<?php echo $this->lang->line('username') ?>';
LANG_PASSWORD = '<?php echo $this->lang->line('password') ?>';
LANG_NO_RESULT_FOUND = '<?php echo $this->lang->line('no_result_found') ?>';
LANG_ERROR = '<?php echo $this->lang->line('no_result_found') ?>';
LANG_CONFIRM_DELETE = '<?php echo $this->lang->line('confirm_delete') ?>';

LANG_ENABLE = '<?php echo $this->lang->line('enable') ?>';
LANG_DISABLE = '<?php echo $this->lang->line('disable') ?>';
</script>

<!--jQuery-->
<?php echo js_asset('jquery-1.6.1.min.js', 'backoffice');?>

<!--jQuery UI Theme-->
<?php echo js_asset('jquery-ui-1.8.10.custom.min.js', 'backoffice');?>
<?php echo css_asset('../../third_party/jquery/ui/themes/aristo/Aristo.css', 'iic_tools');?>

<!--jQuery UI - Date picker-->
<?php echo js_asset('jquery-ui-1.8.10.offset.datepicker.min.js', 'backoffice');?>
<?php echo js_asset('jquery.ui.datepicker-th.js', 'backoffice');?>

<!--Selectlist-->
<?php echo css_asset('jquery.selectlist.css', 'backoffice');?>
<?php echo js_asset('jquery.selectlist.js', 'backoffice');?>

<!--Form Validate-->
<?php echo css_asset('jquery.validate.css', 'backoffice');?>
<?php echo js_asset('jquery.validate.min.js', 'backoffice');?>
<?php echo js_asset('jquery.validate.config.js', 'backoffice');?>

<!--Ajax Form-->
<?php echo js_asset('jquery.form.js', 'backoffice');?>

<!--iic_tools assets-->
<?php echo css_asset('iic_layout.css', 'iic_tools');?>
<?php echo css_asset('iic_style.css', 'iic_tools');?>
<?php echo js_asset('iic_utilities_helper.js', 'iic_tools');?>

<!--Backoffice assets-->
<?php echo css_asset('backoffice.css', 'backoffice');?>
<?php echo css_asset('backoffice_theme.css', 'backoffice');?>
<?php echo js_asset('main.js', 'backoffice');?>

<!--Module assets-->
<?php echo css_asset($module.'.css', $module);?>
<?php echo js_asset($module.'.js', $module);?>

<!--Page assets-->
<?php 
if($page != '')
{
	echo css_asset($page.'.css', $module);
	echo js_asset($page.'.js', $module);
}
?>