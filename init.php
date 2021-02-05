<?php
/*******************************************************************************
 * Obligatory WordPress plugin information
 ******************************************************************************/
/*
Plugin Name: WPDataSearch
Plugin URI: https://www.chucksplayground.com
Description: Wordpress plugin that allows you to store and search through arbitrary data
Version: 1.0
Author: Chuck Hriczko
Author URI: https://www.chucksplayground.com
License: GPLv2
*/
//Include our autoload file
require 'vendor/autoload.php';

//Import our core namespace
use \WPDataSearch\Plugin\Core;

///Initialize our plugin
Core::init();