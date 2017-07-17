<?php

/**
 * Creates a "primary contact" relationship for every parent/child relationship.
 */
function makeParentsPrimary_run($args) {
  civicrm_api3('Relationship', 'get', array(
    'relationship_type_id' => 1,
    'options' => array('limit' => 0),
    'api.Relationship.create' => array(
      // Keep from updating the fetched relationship.
      'id' => '',
      'relationship_type_id' => 13,
      'contact_id_a' => '$value.contact_id_b',
      'contact_id_b' => '$value.contact_id_a',
    ),
  ));
}
