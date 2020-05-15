<?php

// Load core
include('core/Constants.php');
include('Configuration.php');

// Load classes
include('class/Account.php');
include('class/AuthManager.php');
include('class/Cache.php');
include('class/Cookies.php');
include('class/Database.php');
include('class/Session.php');
include('class/Utility.php');



// Initialize
Database::connect();



// Load the app
include('app/AppConfig.php');
include('app/AppCore.php');
