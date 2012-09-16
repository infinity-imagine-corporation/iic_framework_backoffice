<div id="content_warper">
	<input type="hidden" id="config_uri_create" value="<?php echo $module ?>/<?php echo $controller ?>/create_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_update" value="<?php echo $module ?>/<?php echo $controller ?>/update_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_delete" value="<?php echo $module ?>/<?php echo $controller ?>/delete_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_search" value="<?php echo $module ?>/<?php echo $controller ?>/search_<?php echo $ajax_uri; ?>" />
	<input type="hidden" id="config_uri_form" value="<?php echo $module ?>/<?php echo $controller ?>/get_<?php echo $ajax_uri; ?>_form" />
	<input type="hidden" id="config_uri_list" value="<?php echo $module ?>/<?php echo $controller ?>/list_<?php echo $ajax_uri; ?>" />
	
	<div id="content_top">
		<button class="button_create">
		<?php
		if(isset($button_create_label))
		{
			echo $button_create_label;
		}
		else 
		{
			echo $this->lang->line('create');
		}
		?>
		</button>
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
		</div>
	</div>
	<table class="main table">
		<thead>
			<tr>
				<th class="ui-state-default"><input type="checkbox" id="select_all" /></th>
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
		<tbody>
			<?php echo'<tr><td colspan="'.(count($th) + 1).'" class="center">'.$this->lang->line('no_result_found').'</td></tr>'; ?>
		</tbody>
	</table>
	<div id="content_bottom">
		<?php if(isset($pagination)): ?>
		<div class="pagination"><?php echo $pagination; ?></div>
		<?php endif; ?>
		<button class="button_delete"><?php echo $this->lang->line('delete') ?></button>
	</div>
</div>