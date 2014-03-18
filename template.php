<?php

/**
 * Implements hook_preprocess_views_view().
 * Add a collapsible fieldset around the views exposed filters
 */
function kptheme_preprocess_views_view(&$variables) {

  // Wrap exposed filters in a fieldset.
  $default_display = $variables['view']->display['default'];
  if ($variables['exposed']) {


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