// ------------------------------------------------------------------------
// DOM - action
// ------------------------------------------------------------------------

$(function()
{
	// ------------------------------------------------------------------------
	// Adjust layout to fit screen
	// ------------------------------------------------------------------------
	
	adjust_layout()
	
	$(window).resize(function()
	{
		adjust_layout();
	});
	
	// ------------------------------------------------------------------------
	// Search Section
	// ------------------------------------------------------------------------

	$('#keyword').keyup(function()
	{
		search_content();
	});

	$('#criteria').change(function()
	{
		search_content();
	});

	$('#buttton_advance_search').click(function()
	{
		var advance_search_section = $('#advance_search_section');
		var arrow = $('#buttton_advance_search span');

		if(advance_search_section.css('display') == "none")
		{
			advance_search_section.slideDown();
			arrow.html('&#x25BC;')
		}
		else
		{
			advance_search_section.slideUp();
			arrow.html('&#x25C0;')
		}
	});
	
	// ------------------------------------------------------------------------
	// Main table checkbox
	// ------------------------------------------------------------------------

	// Select all
	$('#select_all').live('click', function()
	{
		if($(this).attr('checked') == 'checked')
		{
			$('tbody').find('input[type=checkbox]').attr('checked', 'checked').parent().parent().addClass('checked');
		}
		else
		{
			$('tbody').find('input[type=checkbox]').removeAttr('checked');
			$('tbody').find('tr').removeClass('checked');
		}
	});
	
	// Hilite selected row
	$('tbody').find('input[type=checkbox]').live('click', function()
	{
		$(this).parent().parent().toggleClass('checked');
	});

	// ------------------------------------------------------------------------
	// Button create
	// ------------------------------------------------------------------------

	$('.button_create').button({ icons: { primary : "ui-icon-plusthick" }})
	.click(function()
	{
		// Setup variable
		var url = URL_SERVER + $('#config_uri_form').val();

		// Call ajax function
		get_create_form(url);
	});
	
	// ------------------------------------------------------------------------
	// Button read (when clik on table row)
	// ------------------------------------------------------------------------

	$('table.main.table td:not(td:has(input[type=checkbox])):not([colspan])').live('click', function()
	{
		// Setup variable
		var form_uri = $('#config_uri_form').val();
		var id_content = $(this).parent().attr('rel');
		var url = URL_SERVER + form_uri + '/' + id_content;

		// Call ajax function
		get_update_form(url);
	});
	
	// ------------------------------------------------------------------------
	// Button delete
	// ------------------------------------------------------------------------

	$(".button_delete").button({ icons: { primary : "ui-icon-trash" }})
	.click(function()
	{
		// Setup variable
		var checked = $('tbody').find('input[type=checkbox]:checked').length;

		if(checked > 0)
		{
			// Open dialog
			$('#dialog_delete').dialog('open');
		}
		else
		{
			var msg = 'โปรดเลือกข้อมูลอย่างน้อย 1 แถว.';
			$('#dialog_alert_message').html(msg);

			// Open dialog
			$('#dialog_alert').dialog('open');
		}
	});
	
	// ------------------------------------------------------------------------
	// Button delete attachfile
	// ------------------------------------------------------------------------
	
	$('a.delete_attachfile').live('click', function()
	{
		var file_id = '#' + $(this).attr('rel');
		
		// Hide attachfile
		$(this).parent().parent().parent().fadeOut();
		
		// Set delete this file
		$(file_id).val('1');
	});
	
	// ------------------------------------------------------------------------
	// Button remove content
	// ------------------------------------------------------------------------
	
	$('a.remove_content').live('click', function()
	{
		var id ='#' + $(this).attr('rel');
		
		$(id).remove();
	});
	
	// ------------------------------------------------------------------------
	// Dialog - alert
	// ------------------------------------------------------------------------

	$('#dialog_alert').dialog
	({
		title		: LANG_ALERT,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		width		: 400,
		height		: 'auto',
		modal		: true,
		buttons		: [
					  	  {
							  text	: LANG_OK,
							  click	: function()
									  {
										  $(this).dialog("close");
									  }
						  }
					  ]
	});
	
	// ------------------------------------------------------------------------
	// Dialog error
	// ------------------------------------------------------------------------
	
	$('#dialog_error').dialog
	({
		title		: LANG_ERROR,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		width		: 890,
		height		: 600,
		modal		: false,
		buttons		: [
					  	  {
							  text	: 'WTF !!!',
							  click	: function()
									  {
										  $(this).dialog("close");
									  }
						  }
					  ]
	});
	
	// ------------------------------------------------------------------------
	// Dialog create
	// ------------------------------------------------------------------------

	$('#dialog_create').dialog
	({
		title		: LANG_CREATE,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		width		: 'auto',
		height		: 600,
		modal		: true,
		buttons		: [
					  	  {
							  text	: LANG_SAVE,
							  click	: function()
									  {
										  create_content();
									  },
							  icons : { primary : "ui-icon-plusthick" }
						  }
					  ]
	});

	// Set icon
	$('#dialog_create')
	.next()
	.find('button')
	.removeClass('ui-button-text-only')
	.addClass('ui-button-text-icon-primary')
	.prepend('<span class="ui-button-icon-primary ui-icon ui-icon-disk"/>');

	// Submit form when press enter
	$('#dialog_create').keypress(function(event)
	{
		if(event.keyCode == '13')
		{
			create_content();
		}
	})
	
	// ------------------------------------------------------------------------
	// Dialog update
	// ------------------------------------------------------------------------

	$('#dialog_update').dialog
	({
		title		: LANG_EDIT,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		width		: 'auto',
		height		: 600,
		minWidth	: 400,
		modal		: true,
		buttons 	: [
					  	  {
							  text	: LANG_SAVE,
							  click	: function()
									  {
										  update_content();
									  }
						  }
					  ]
	});

	// Set icon
	$('#dialog_update')
	.next()
	.find('button')
	.removeClass('ui-button-text-only')
	.addClass('ui-button-text-icon-primary')
	.prepend('<span class="ui-button-icon-primary ui-icon ui-icon-disk"/>');

	// Submit form when press enter
	$('#dialog_update').keypress(function(event)
	{
		if(event.keyCode == '13')
		{
			update_content();
		}
	})
	
	// ------------------------------------------------------------------------
	// Dialog delete
	// ------------------------------------------------------------------------

	$('#dialog_delete').dialog
	({
		title 		: LANG_CONFIRM_DELETE,
		autoOpen 	: false,
		draggable 	: false,
		resizable 	: false,
		width 		: 400,
		height 		: 'auto',
		modal 		: true,
		buttons 	: [
					  	  {
							  text	: LANG_OK,
							  click	: function()
									  {
										  delete_content();
									  }
						  }
					  ]
	});
	
	// ------------------------------------------------------------------------
	// Init form validator 
	// ------------------------------------------------------------------------

	jQuery.validator.setDefaults
	({
		debug : true,
		errorElement : "i",
		errorPlacement : function(error, element)
		{
			error.appendTo(element.prev());
		}
	});
	
	// ------------------------------------------------------------------------

});

// ------------------------------------------------------------------------
// FUNCTION
// ------------------------------------------------------------------------

/**
 * Load create form via ajax
 *
 * @param string url
 */

function get_create_form(url)
{
	// Setup ajax
	$.post(url, function(response)
	{
		$('#dialog_create').html(response);
		$('#dialog_create').dialog('open')
	})
	.error(function()
	{
		var msg = 'Error: get_create_form(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Load update form via ajax
 *
 * @param string url
 */

function get_update_form(url)
{
	// Setup ajax
	$.post(url, function(response)
	{
		$('#dialog_update').html(response);
		$('#dialog_update').dialog('open');
	})
	.error(function()
	{
		var msg = 'Error: get_update_form(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Adjust screen layout to fit windows size
 *
 * @param string url
 */

function adjust_layout()
{
	var page_height = $(window).height();
	var content_height = (page_height - 180 - 35 - 30); // window - header - nav - footer
	
	$('#content').css('min-height', content_height);
	
	$('.dashboard').css('min-height', content_height - 50);
}

// ------------------------------------------------------------------------

/**
 * Get content via ajax
 */	

function get_content(limit, offset)
{
	// Show preload
	$('#preload').slideDown('fast');
	
	// Setup variable
	var limit	= limit || 25;
	var offset	= offset || (limit * parseInt($('.pagination').find('strong').html())) - limit;
	
	offset = (isNaN(offset)) ? 0 : offset;
	
	var url = URL_SERVER + $('#config_uri_list').val() + '/' + limit + '/' + offset;
	var data = {
					'limit'		: limit,
					'offset' 	: offset
			   };
			   
	// Setup ajax
	$.post(url, data, function(response)
	{
		update_table_content(response);	
	}, "json")
	.success(function() 
	{ 
		$('#preload').slideUp('fast'); 
	})
	.error(function() 
	{  
		var msg = 'Error: list_content(' + limit + ', ' + offset + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Generate HTML tag and replace in <tbody>
 * 
 * @param json content
 */	

function generate_html(content)
{
	var list = '';
	 
	$.each(content, function(i, data) 
	{		
		list += '<tr rel="' + data['id'] + '">';
		list += '<td><input type="checkbox" id="' + data['id'] + '" value="' + data['id'] + '" /></td>';
		
		$('table.main.table thead th:not(:first-child)').each(function(index) 
		{		
			field = $(this).attr('axis');
			align = $(this).attr('align');			
			
			list += '<td class="'+ align + '">' + data[field] + '</td>';
		})
				
		list += '</tr>';
	});
	
	return list;
}

// ------------------------------------------------------------------------

/**
 * Generate HTML tag and replace in <tbody>
 * 
 * @param json content
 */	

function update_table_content(content)
{
	if(content != '')
	{
		 var list = generate_html(content);
		
		// Uncheck select all   
		$('#select_all').removeAttr('checked');
		
		// Update table content			
		$("tbody").html(list);
	}
	else
	{
		// Uncheck select all   
		$('#select_all').removeAttr('checked');
		
		// Count table column
		var total_column = $('thead th').length;
		
		// Update table content			
		$("tbody").html('<td align="center" colspan="'+total_column+'">'+LANG_NO_RESULT_FOUND+'</td>');	
	}
}

// ------------------------------------------------------------------------

/**
 * Create content via ajax
 */

function create_content()
{
	// Setup variable
	var dialog	= $('#dialog_create');
	var form	= dialog.find('form');
	var url 	= URL_SERVER + $('#config_uri_create').val();
	var config 	= {
						'target' 		: '',
						'beforeSubmit' 	: showRequest,
						'success' 		: showResponse,
						'url' 			: url,
						'type' 			: 'post'
				  };

	// Pre-submit callback
	function showRequest(formData, jqForm, data)
	{
		// Show preload
		$('#preload').slideDown('fast');

		return true;
	}

	// Post-submit callback
	function showResponse(responseText, statusText, xhr, $form)
	{
		if(statusText == 'success')
		{
			get_content();
		
			$('#preload').slideUp('fast');
			
			dialog.dialog('close');
		}
		else
		{
			$("#dialog_error").html(responseText)
			$("#dialog_error").dialog('open');
			$('#preload').slideUp('fast');
		}
	}

	// Validate form
	if(form.valid())
	{
		dialog.find('form').ajaxSubmit(config);
	}
}

// ------------------------------------------------------------------------

/**
 * Update content via ajax
 */	
 
function update_content()
{
	// Setup variable
	var dialog	= $('#dialog_update');
	var form 	= dialog.find('form');	
	var url		= URL_SERVER + $('#config_uri_update').val();
	var config	= { 
					  'target'		: '',   
					  'beforeSubmit': showRequest, 
					  'success'		: showResponse,
					  'url'			: url,
					  'type'		: 'post'
				  }; 
		
	// Pre-submit callback 
	function showRequest(formData, jqForm, data) 
	{ 
		// Show preload
		$('#preload').slideDown('fast');
		
		return true; 
	} 
	 
	// Post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  
	{ 
		get_content();
		
		$('#preload').slideUp('fast'); 
		
		dialog.dialog('close');
	} 
	
	// Validate form
	if(form.valid())
	{
		dialog.find('form').ajaxSubmit(config); 
	}
}

// ------------------------------------------------------------------------

/**
 * Delete content via ajax
 */	

function delete_content()
{
	// Setup variable
	var checked	= $('tbody').find('input[type=checkbox]:checked');
	var url		= URL_SERVER + $('#config_uri_delete').val();
	var id		= new Array();
	
	checked.each(function(index) 
	{
		id.push($(this).val());
	});
	
	var data = {
					'id' : id
			   };
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		get_content();
	})
	.success(function() { $('#dialog_delete').dialog('close'); })
	.error(function() 
	{  
		var msg = 'Error: delete_content(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}

// ------------------------------------------------------------------------

/**
 * Search content via ajax
 */	
 
function search_content()
{
	// Setup variable
	var url = URL_SERVER + $('#config_uri_search').val();
	var data = {
					'keyword'	: $('#keyword').val(),
					'criteria'	: $('#criteria').val()
			   };
	
	// Setup ajax
	$.post(url, data, function(response)
	{
		update_table_content(response);
	}, "json")
	.error(function() 
	{  
		var msg = 'Error: search_content(' + url + ')';
		$('#dialog_alert_message').html(msg);
		$('#dialog_alert').dialog('open');
	});
}


/* End of file main.js */
/* Location: assets/modules/backoffice/js/main.js */