<?php
  $organism  = $variables['node']->organism;
  $image_url = tripal_organism_get_image_url($organism, $node->nid);

  $organism_image = $node->content['field_image_with_source'];
  $organism_image_entity = current($organism_image[0]['entity']['field_collection_item']);
  unset($node->content['field_image_with_source']);
?>

<div class="tripal_organism-teaser tripal-teaser">
  <div class="tripal-organism-teaser-title tripal-teaser-title"><?php
    print l("<i>$organism->genus $organism->species</i> ($organism->common_name)", "node/$node->nid", array('html' => TRUE));?>
  </div>
  <div class="tripal-organism-teaser-text tripal-teaser-text">
    <span class="organism-main-image">
      <?php print render($organism_image_entity['field_image']); ?>
    </span>
    <?php
    print substr($organism->comment, 0, 650);
    if (strlen($organism->comment) > 650) {
      print "... " . l("[more]", "node/$node->nid");
    } ?>
  </div>
</div>
