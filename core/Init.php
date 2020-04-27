<?php

// Load core
include('Constants.php');
include('../Configuration.php');

// Load classes
include('../class/Cache.php');
include('../class/Database.php');
include('../class/Routing.php');
include('../class/Session.php');



// Initialize
Database::connect();
Routing::initialize();



// Load the app
include('../app/AppConfig.php');
include('../app/AppCore.php');
