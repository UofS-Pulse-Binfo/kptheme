<?php

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

}

function kptheme_views_data_export_feed_icon($variables) {

  $url_options = array('html' => TRUE, 'attributes' => array('class' => 'download-feed'));
  if($variables['query']) {
      $url_options['query'] = $variables['query'];
  }

  return '<li>' . l($variables['text'], $variables['url'], $url_options) . '</li>';

}