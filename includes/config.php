<?php

// Define Database constants

// Define host
defined("DB_SERVER") ? null : define("DB_SERVER", getenv("IP"));

// Define database user
defined("DB_USER")   ? null : define("DB_USER", "Bunias");

// Define database password
defined("DB_PASS")   ? null : define("DB_PASS", "");

//Define database name
defined("DB_NAME")   ? null : define("DB_NAME", "c9");


