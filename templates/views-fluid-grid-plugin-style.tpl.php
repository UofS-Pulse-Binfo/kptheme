<?php
/**
 * @file
 * Default view template to display a list of items in a fluid grid.
 *
 * Available template variables:
 * - $view: The view object.
 * - $title: Title of the view. May be empty.
 * - $rows: Array of items.
 * - $list_class: The class for the items list.
 * - $classes: Array of classes for each item.
 * - $classes_array: Array of classes for each item.
 *
 * @ingroup views_templates
 */

/**
drupal_add_library('system', 'ui.accordion');
drupal_add_js(
  'jQuery(document).ready(function(){jQuery("#accordion").accordion({
      collapsible: true
    });
  });',
'inline');
*/
?>


<div class="views-fluid-grid views-group">
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  
  <div class="views-row-content">
  <ul class="<?php print $list_class; ?>">
    
    <?php foreach ($rows as $id => $item): ?>
      <li class="views-fluid-grid-inline views-fluid-grid-item <?php print $classes_array[$id]; ?>"><?php print $item; ?></li>
    <?php endforeach; ?>
    
    <?php if (!empty($options['list_alignment']) && $options['list_alignment'] == 'justify') : ?>
      <li class="views-fluid-grid-inline views-fluid-grid-justify-last"></li>
    <?php endif; ?>
  
  </ul>
  </div>
</div>

