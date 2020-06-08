<?php

  include('SportScribe.php');

  $c = new SportScribeClient('PUT_API_HERE');

  $leagues = $c->getLeagues();

  if($leagues) {

    foreach($leagues as $l) {
      print "League ID / Name: " . $l->id . "\t" . $l->name . "\n";
    }

  } else {
    print "ERROR";
  }
?>
