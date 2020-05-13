<?php

// Load core
include($ROOT_PATH . '/core/Constants.php');
include($ROOT_PATH . 'Configuration.php');

// Load classes
include($ROOT_PATH . 'class/Cache.php');
include($ROOT_PATH . 'class/Database.php');
include($ROOT_PATH . 'class/Session.php');



// Initialize
Database::connect();



// Load the app
include($ROOT_PATH . 'app/AppConfig.php');
include($ROOT_PATH . 'app/AppCore.php');
