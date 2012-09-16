<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<link rel="shortcut icon" href="../favicon.ico" />
<?php $this->load->view('backoffice/asset'); ?>

<script type="text/javascript">	
$(function() 
{
	$("input[type=submit]").button();
	$('#username').focus();
});
</script>

<style type="text/css">

.table
{
	display: table;
	height: 100%;
	position: absolute;
	top: 0;
}

.table_cell 
{ 
	display: table-cell; 
	vertical-align: middle;
}

div.gadget 
{ 
	background: #FFF;
	border: 1px solid #666;
	box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.5);
	max-width: 480px; 
	margin: auto;
	padding: 0px; 
}

#header
{
	height: 100px;
	padding: 9px 10px 11px 158px;
	margin: 0px;
	text-align: right;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	text-align: left;
}

#header #logo
{
	background-color: rgba(255, 255, 255, 0.95);
	border-radius: 3px;
	box-shadow: none;
	width: 128px;
	height: 128px;
	bottom: -190px;
	left: 20px;
}

#header h2,
#header h3
{
	background-color: rgba(0, 0, 0, 0.5);
	border-radius: 3px;
	/*box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.8) inset, 0px 0px 5px rgba(255, 255, 255, 0.8);*/
	box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
	margin: 0px 0px 8px 0px;
	padding: 3px 10px;
}

#form_section 
{ 
	border-left: 1px dotted #DDD;
	float: right;
	width: 250px;
	background: #FFF; 
	padding: 32px 30px 20px 30px;
	
}

label
{
	font-size: 14px;
	font-weight: normal
}

p { margin: 0px; }

form 
{ 
	padding: 0px 10px;
	margin-left: -13px;
}

#form_section input[type=text], 
#form_section input[type=password] 
{ 
	font-size: 1.5em;
	width: 100%; 
}

#submit
{ 
	position: relative;
	margin-right: -10px; 
	padding: 12px 16px;
}

#footer
{
	color: #999;
	font-size: 11px;
	padding: 15px 5px 5px 5px;
	text-align: center;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}
</style>
</head>

<body class="table">
<div class="table_cell">
	<div class="gadget">
		<div id="header">
			<div id="logo"></div>
		</div>
		<div id="form_section">
			<p id="error_msg" class="center red text_12"><?php echo $error_msg ?></p>
			<?php echo form_open($form_target); ?>
				<label for="username"><?php echo $this->lang->line('username') ?></label>
				<input type="text" name="username" id="username" value="" />
				<label for="password"><?php echo $this->lang->line('password') ?></label>
				<input type="password" name="password" id="password" />
				<div class="right">
					<input name="Submit" id="submit" type="submit" value="<?php echo $this->lang->line('login') ?>" class="ui-button-primary" />
				</div>
			<?php echo form_close() ?>
		</div>
		<div id="footer" class="clear"><?php echo $theme['footer_text'] ?></div>
	</div>
</div>
</body>
</html>