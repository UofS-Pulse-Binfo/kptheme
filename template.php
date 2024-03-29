<?php

/**
 * Preprocessor: Tripal Content Entity pages
 *
function kptheme_preprocess(&$vars) {
  if (isset($vars['elements']['#entity_type']) AND ($vars['elements']['#entity_type'] == 'TripalEntity')) {

    drupal_add_js('
      jQuery(document).ready(function () {
        $(".field-group-tripalpane").not(":has(.field)").remove();
    });', 'inline');

  }
}*/

/**
 * Implements hook_preprocess_table().
 * 
 * Apply an inline style to crops pages only, particularly the
 * crops summary overview table. This style rule along with the rule
 * applied to crop image render both table and image side by side.
 */
function kptheme_preprocess_table(&$vars) {
  // Get current path.
  $path_alias = drupal_get_path_alias();
  // In crops page, arg1 is the species.
  $arg1 = strstr($path_alias, '/', TRUE);
  // Species: 
  $species = array('Cicer', 'Glycine', 'Lens', 'Medicago', 'Phaseolus', 'Pisum', 'Vicia');
  
  // Apply inline style when arg1 (in path alias) is matching one
  // of the species.
  if ($arg1 && in_array(ucfirst(strtolower($arg1)), $species)) {
    $vars['attributes']['style'][] = 'width: auto';
  }
}

/**
 * Implements hook_preprocess_views_view().
 * Add a collapsible fieldset around the views exposed filters
 */ 
function kptheme_preprocess_views_view(&$variables) {

  // No fieldset for the following views
  $skip_views = array('kp_genotype_search');
  $skip_view = FALSE;
  if (in_array($variables['view']->name, $skip_views)) {
    $skip_view = TRUE;
  }

  // Wrap exposed filters in a fieldset.
  $default_display = $variables['view']->display['default'];
  if ($variables['exposed'] AND !($skip_view)) {


    // We want it collapsed by default only if there are search results
    $collapsed = FALSE;
    $classes = array('collapsible');
    if (sizeof($variables['view']->result) > 0) {
      $collapsed = TRUE;
      $classes = array('collapsible', 'collapsed');
    }

    // Ensure required js libs are added
    drupal_add_js('misc/form.js');
    drupal_add_js('misc/collapse.js');
      // Build fieldset element, using correct array nesting for theme_fieldset
      $fieldset['element'] = array(
        '#title' => t('Search Criteria'),
        '#collapsible' => TRUE,
        '#collapsed' => $collapsed,
        '#attributes' => array('class' => $classes),
        '#value' => $variables['exposed'],
        '#children' => '',
      );
      // Reassign exposed filter tpl var to fieldset value
      $variables['exposed'] = theme('fieldset', $fieldset);
  }
  
  if ($variables['view']->name == 'uofs_wild_species') {
		// These files are needed to get the accordion list to work.
		// include requred css and js file
		// markup: sites/all/themes/kptheme/views-views--uofs-wildspecies--page.tpl.php
		// initilialize: sites/all/themes/kptheme/js 
		if ($jquery_path = libraries_get_path('jquery_ui')) {
			drupal_add_css($jquery_path . '/css/kptheme/jquery-ui-1.10.4.custom.css');
			drupal_add_js($jquery_path . '/js/jquery-1.10.2.js');
			drupal_add_js($jquery_path . '/js/jquery-ui-1.10.4.custom.js');
			
			$theme_path = $GLOBALS['base_url'] . '/'. drupal_get_path('theme', 'kptheme');
			drupal_add_js($theme_path . '/js/WildSpeciesView_ResearchWildSpecies_JQueryAccordion.js');
		}
	}
}

function kptheme_views_data_export_feed_icon($variables) {

  $url_options = array('html' => TRUE, 'attributes' => array('class' => 'download-feed'));
  if($variables['query']) {
      $url_options['query'] = $variables['query'];
  }

  return '<li>' . l($variables['text'], $variables['url'], $url_options) . '</li>';
}


