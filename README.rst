# sportscribe-php


Installation
============

Clone this repo into your working directory

Methods
=======

Return an array of leagues

.. code:: php

        getLeagues()


Return an array of teams for the given leagueId

.. code:: php

        getTeams($leagueId)


Returns the next match's preview for the given teamId

.. code:: php

        getMatchPreviewByTeam($teamId)

Returns an array of all match previews on the given date (YYYY-MM-DD)

.. code:: php

        getMatchPreviewByDate($date)


Configuration
=============

edit config.php to point to the correct endpoint URL
the default config.php is set to access endpoint V1_0 and may need to be updated

Usage
=====

.. code:: php


        include('SportScribe.php');

        $c = new SportScribeClient('API_KEY_HERE');

        $leagues = $c->getLeagues();

        if($l) {
          foreach($leagues as $l) {
            print $l->id . "\t" . $l->name . "\n";
          }
        } else {
          print "THERE WAS AN ERROR";
        }




