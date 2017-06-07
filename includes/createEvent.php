<?php

function createEvent_run($args) {
  $input = getOption('input-file', $args);
  define('EVENT_TYPE', getOption('event-type', $args));

  $main = 'processEventsForImport';
  withFile($input, $main);
}

$fieldDefinition = array();

function processEventsForImport($line, $index) {
  global $fieldDefinition;
  $row = parseCsv($line, $index, $fieldDefinition);

  if (!empty($row['custom_75'])) {
    $row['custom_75'] = cvCli('Contact', 'getvalue', array(
      'external_identifier' => $row['custom_75'],
      'return' => 'id',
    ));
  }

  processEventForImport($row);
}

function processEventForImport($event) {
  if (!$event) {
    return;
  }
  $params = $event;

  if (!array_key_exists('event_type_id', $event) && EVENT_TYPE) {
    $params['event_type_id'] = EVENT_TYPE;
  }

  //Do the deed
  $result = cvCli('Event', 'create', $params);
  if ($result['is_error'] != 0) {
    echo "Error creating event," . implode(",", $event);
  }
  return $result;
}
