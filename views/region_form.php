<?php 
if( ! isset($id))
{
	$id = '';
	$name = '';
} 
?>

<form>
	<label for="name"><?php echo $this->lang->line('name') ?></label>
	<input type="text" id="name" name="name" value="<?php echo $name ?>" >

	<input type="hidden" id="id" name="id" value="<?php echo $id ?>" />
</form>