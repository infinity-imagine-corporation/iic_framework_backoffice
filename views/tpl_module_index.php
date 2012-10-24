<?php
// Hack for support older version with no button config
$button['create']['is_enable'] = (isset($button['create']['is_enable'])) ? $button['create']['is_enable'] : TRUE;
$button['create']['label'] = (isset($button['create']['label'])) ? $button['create']['label'] : $this->lang->line('create');

$button['delete']['is_enable'] = (isset($button['delete']['is_enable'])) ? $button['delete']['is_enable'] : TRUE;
$button['delete']['label'] = (isset($button['delete']['label'])) ? $button['delete']['label'] : $this->lang->line('delete');

$content['readonly'] = (isset($content['readonly'])) ? $content['readonly'] : FALSE;
$content['advance_search'] = (isset($content['advance_search'])) ? $content['advance_search'] : FALSE;
?>

<div id="content_warper">
	<input type="hidden" id="config_uri_create" value="<?php echo $module ?>/<?php echo $controller ?>/create_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_update" value="<?php echo $module ?>/<?php echo $controller ?>/update_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_delete" value="<?php echo $module ?>/<?php echo $controller ?>/delete_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_search" value="<?php echo $module ?>/<?php echo $controller ?>/search_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_form" value="<?php echo $module ?>/<?php echo $controller ?>/get_<?php echo $ajax_uri; ?>_form" />
	<input type="hidden" id="config_uri_list" value="<?php echo $module ?>/<?php echo $controller ?>/list_<?php echo $ajax_uri; ?>" />
	
	<div id="content_top">
		<?php if ($button['create']['is_enable']): ?>
		<button class="button_create"><?php echo $button['create']['label'] ?></button>
		<?php endif ?>
		<?php if(isset($button['additional_top_button']) && $button['additional_top_button'] == TRUE) $this->load->view($page.'_top_button'); ?>
		<div id="search_section">
			<input type="text" name="keyword" id="keyword" class="search_left" />
			<label class="inline" for="criteria"><?php echo $this->lang->line('in') ?></label>
			<select name="criteria" id="criteria">
				<?php			
				foreach($th as $data)
				{
					if($data['is_criteria'])
					{
						echo '<option value="'.$data['axis'].'">'.$data['label'].'</option>';
					}
				}
				?>
			</select>
			<?php if($content['advance_search']) $this->load->view($page.'_advance_search'); ?>
		</div>
	</div>
	<table class="main table">
		<thead>
			<tr>
				<th class="ui-state-default">
				<?php if ($button['delete']['is_enable']): ?>
				<input type="checkbox" id="select_all" />
				<?php endif ?>
				</th>
				<?php
				foreach($th as $data)
				{
					echo '<th axis="'.$data['axis'].'"';
					echo (isset($data['align'])) ? 'align="'.$data['align'].'"' : '';
					echo ' class="ui-state-default">'.$data['label'].'</th>';
				}
				?>
			</tr>
		</thead>
		<tbody class="<?php if($content['readonly']) echo 'readonly"'; if($button['delete']['is_enable']) echo 'deletable"' ?>">
			<?php echo'<tr><td colspan="'.(count($th) + 1).'" class="center">'.$this->lang->line('no_result_found').'</td></tr>'; ?>
		</tbody>
	</table>
	<div id="content_bottom">
		<?php if(isset($pagination)): ?>
		<div class="pagination"><?php echo $pagination; ?></div>
		<?php endif; ?>
		<?php if ($button['delete']['is_enable']): ?>
		<button class="button_delete"><?php echo $button['delete']['label'] ?></button>
		<?php endif ?>
		<?php if(isset($button['additional_bottom_button']) && $button['additional_bottom_button'] == TRUE) $this->load->view($page.'_bottom_button'); ?>
	</div>
</div>