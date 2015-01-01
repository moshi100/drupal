<?php

/**
 * Override or insert variables into the maintenance page template.
 */
function seven_preprocess_maintenance_page(&$vars) {
  // While markup for normal pages is split into page.tpl.php and html.tpl.php,
  // the markup for the maintenance page is all in the single
  // maintenance-page.tpl.php template. So, to have what's done in
  // seven_preprocess_html() also happen on the maintenance page, it has to be
  // called here.
  seven_preprocess_html($vars);
}

/**
 * Override or insert variables into the html template.
 */
function seven_preprocess_html(&$vars) {
  // Add conditional CSS for IE8 and below.
  drupal_add_css(path_to_theme() . '/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 8', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
  // Add conditional CSS for IE7 and below.
  drupal_add_css(path_to_theme() . '/ie7.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
  // Add conditional CSS for IE6.
  drupal_add_css(path_to_theme() . '/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 6', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
}

/**
 * Override or insert variables into the page template.
 */
function seven_preprocess_page(&$vars) {
  $vars['primary_local_tasks'] = $vars['tabs'];
  unset($vars['primary_local_tasks']['#secondary']);
  $vars['secondary_local_tasks'] = array(
    '#theme' => 'menu_local_tasks',
    '#secondary' => $vars['tabs']['#secondary'],
  );
}

/**
 * Display the list of available node types for node creation.
 */
function seven_node_add_list($variables) {
  $content = $variables['content'];
  $output = '';
  if ($content) {
    $output = '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="clearfix">';
      $output .= '<span class="label">' . l($item['title'], $item['href'], $item['localized_options']) . '</span>';
      $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  else {
    $output = '<p>' . t('You have not created any content types yet. Go to the <a href="@create-content">content type creation page</a> to add a new content type.', array('@create-content' => url('admin/structure/types/add'))) . '</p>';
  }
  return $output;
}

/**
 * Overrides theme_admin_block_content().
 *
 * Use unordered list markup in both compact and extended mode.
 */
function seven_admin_block_content($variables) {
  $content = $variables['content'];
  $output = '';
  if (!empty($content)) {
    $output = system_admin_compact_mode() ? '<ul class="admin-list compact">' : '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="leaf">';
      $output .= l($item['title'], $item['href'], $item['localized_options']);
      if (isset($item['description']) && !system_admin_compact_mode()) {
        $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      }
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  return $output;
}

/**
 * Override of theme_tablesort_indicator().
 *
 * Use our own image versions, so they show up as black and not gray on gray.
 */
function seven_tablesort_indicator($variables) {
  $style = $variables['style'];
  $theme_path = drupal_get_path('theme', 'seven');
  if ($style == 'asc') {
    return theme('image', array('path' => $theme_path . '/images/arrow-asc.png', 'alt' => t('sort ascending'), 'width' => 13, 'height' => 13, 'title' => t('sort ascending')));
  }
  else {
    return theme('image', array('path' => $theme_path . '/images/arrow-desc.png', 'alt' => t('sort descending'), 'width' => 13, 'height' => 13, 'title' => t('sort descending')));
  }
}

/**
 * Implements hook_css_alter().
 */
function seven_css_alter(&$css) {
  // Use Seven's vertical tabs style instead of the default one.
  if (isset($css['misc/vertical-tabs.css'])) {
    $css['misc/vertical-tabs.css']['data'] = drupal_get_path('theme', 'seven') . '/vertical-tabs.css';
    $css['misc/vertical-tabs.css']['type'] = 'file';
  }
  if (isset($css['misc/vertical-tabs-rtl.css'])) {
    $css['misc/vertical-tabs-rtl.css']['data'] = drupal_get_path('theme', 'seven') . '/vertical-tabs-rtl.css';
    $css['misc/vertical-tabs-rtl.css']['type'] = 'file';
  }
  // Use Seven's jQuery UI theme style instead of the default one.
  if (isset($css['misc/ui/jquery.ui.theme.css'])) {
    $css['misc/ui/jquery.ui.theme.css']['data'] = drupal_get_path('theme', 'seven') . '/jquery.ui.theme.css';
    $css['misc/ui/jquery.ui.theme.css']['type'] = 'file';
  }
}

/*
function seven_table($variables) {
	
	$header = $variables['header'];
	$rows = $variables['rows'];
	$attributes = $variables['attributes'];
	$caption = $variables['caption'];
	$colgroups = $variables['colgroups'];
	$sticky = $variables['sticky'];
	$empty = $variables['empty'];
	
	if(isset($attributes['id']))
		if($attributes['id'] == "CRUD_table")
			$flag_att = true;
		else $flag_att = false;
	else
		$flag_att = false;
	
	// Add sticky headers, if applicable.
	if (count($header) && $sticky) {
		drupal_add_js('misc/tableheader.js');
		// Add 'sticky-enabled' class to the table to identify it for JS.
		// This is needed to target tables constructed by this function.
		$attributes['class'][] = 'sticky-enabled';
	}
	
	$output = '<table' . drupal_attributes($attributes) . ">\n";
	
	if (isset($caption)) {
		$output .= '<caption>' . $caption . "</caption>\n";
	}
	
	// Format the table columns:
	if (count($colgroups)) {
		foreach ($colgroups as $number => $colgroup) {
			$attributes = array();
	
			// Check if we're dealing with a simple or complex column
			if (isset($colgroup['data'])) {
				foreach ($colgroup as $key => $value) {
					if ($key == 'data') {
						$cols = $value;
					}
					else {
						$attributes[$key] = $value;
					}
				}
			}
			else {
				$cols = $colgroup;
			}
	
			// Build colgroup
			if (is_array($cols) && count($cols)) {
				$output .= ' <colgroup' . drupal_attributes($attributes) . '>';
				$i = 0;
				foreach ($cols as $col) {
					$output .= ' <col' . drupal_attributes($col) . ' />';
				}
				$output .= " </colgroup>\n";
			}
			else {
				$output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
			}
		}
	}
	
	// Add the 'empty' row message if available.
	if (!count($rows) && $empty) {
		$header_count = 0;
		foreach ($header as $header_cell) {
			if (is_array($header_cell)) {
				$header_count += isset($header_cell['colspan']) ? $header_cell['colspan'] : 1;
			}
			else {
				$header_count++;
			}
		}
		$rows[] = array(array('data' => $empty, 'colspan' => $header_count, 'class' => array('empty', 'message')));
	}
	
	// Format the table header:
	if (count($header)) {
		$ts = tablesort_init($header);
		// HTML requires that the thead tag has tr tags in it followed by tbody
		// tags. Using ternary operator to check and see if we have any rows.
		$output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
		foreach ($header as $cell) {
			$cell = tablesort_header($cell, $header, $ts);
			$output .= _theme_table_cell($cell, TRUE);
		}
		// Using ternary operator to close the tags based on whether or not there are rows
		$output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
	}
	else {
		$ts = array();
	}
	
	// Format the table rows:
	if (count($rows)) {
		$output .= "<tbody>\n";
		$flip = array('even' => 'odd', 'odd' => 'even');
		$class = 'even';
		foreach ($rows as $number => $row) {
			// Check if we're dealing with a simple or complex row
			if (isset($row['data'])) {
				$cells = $row['data'];
				$no_striping = isset($row['no_striping']) ? $row['no_striping'] : FALSE;
	
				// Set the attributes array and exclude 'data' and 'no_striping'.
				$attributes = $row;
				unset($attributes['data']);
				unset($attributes['no_striping']);
			}
			else {
				$cells = $row;
				$attributes = array();
				$no_striping = FALSE;
			}
			if (count($cells)) {
				// Add odd/even class
				if (!$no_striping) {
					$class = $flip[$class];
					$attributes['class'][] = $class;
				}
	
				// Build row
				$output .= ' <tr' . drupal_attributes($attributes) . '>';
				$i = 0;
				foreach ($cells as $cell) {
					$cell = tablesort_cell($cell, $header, $ts, $i++);
					if ($flag_att)
						$output .= seven_theme_table_cell($cell);
					else
						$output .= _theme_table_cell($cell);
				}
				$output .= " </tr>\n";
			}
		}
		$output .= "</tbody>\n";
	}
	
	$output .= "</table>\n";
	return $output;
}

function seven_theme_table_cell($cell, $header = FALSE) {
	$attributes = '';

	if (is_array($cell)) {
		$data = isset($cell['data']) ? $cell['data'] : '';
		// Cell's data property can be a string or a renderable array.
		if (is_array($data)) {
			$data = drupal_render($data);
		}
		$header |= isset($cell['header']);
		unset($cell['data']);
		unset($cell['header']);
		$attributes = drupal_attributes($cell);
	}
	else {
		$data = $cell;
	}

	if ($header) {
		$output = "<th$attributes>$data</th>";
	}
	else {//<input type='text' value='$data'></td> <textarea rows='1'>$data</textarea>
		$output = "<td$attributes><input type='text' value='$data'></td></td>";
	}
	
	return $output;
}*/
