<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code




/**
 * Project Configs + Paths
 */
define('DOMAIN',$_SERVER['HTTP_HOST']);
define('BASE_URL','https://guyanaci.ceonpointllc.com/');
// define('BASE_URL','https://'.DOMAIN.'/bahamas_ci/');
define('ASSETS_URL',BASE_URL.'assets/');

define('ADMIN_URL',BASE_URL.'admin/');
define('ADMIN_ASSETS',BASE_URL.'assets/admin/');

 

/**
 * Email Configs<info@pmshotelier.com
 */
define('SITE_EMAIL','admin@infoicontechnologies.com');
define('FROM_EMAIL','info@pmshotelier.com');
define('FROM_NAME','Hotelier');
define('SMTP_HOST','smtp.sendgrid.net');
define('SMTP_PORT','587');
define('SMTP_USER','sushant.infodev');
define('SMTP_PASS','sushant@1234');

// define('SENDER_NAME','RBoard.com'); 
// define('SENT_EMAIL_FROM','rboard@ceonpoint.com'); 
// define('SENT_EMAIL_PASSWORD','mBxpZUJF~BmU'); 
// define('SMTP_HOSTNAME','mail.ceonpoint.com'); 
// define('SMTP_PORT',25);

define('SITE_NAME','Ceonpoint');
define('EMAIL','team@ceonpoint.com');

define('PAYAPAL_URL','https://www.sandbox.paypal.com/cgi-bin/webscr');
define('PAYAPAL_ID','business@karmatech.in'); //only bussiness account

// define('PAYAPAL_URL','https://www.paypal.com/cgi-bin/webscr');
// define('PAYAPAL_ID','paypal@webpanelsolutions.com');



define('GOVT_URL','http://govt.ceonpoint.com/');

/**
 * Stripe Payment Gateway
 */
define("STRIPE_SECRET_KEY", "sk_test_lmx2DweRqDmid04S2eJARHdq00A0yrEUm8");
define("STRIPE_PUBLISHABLE_KEY", "pk_test_5Gy4jV04WmuLfplXGu7qGZff00RsV0dc4o");


define("CAR_INSURANCE_PATH", " home3/cme5fo1r/guyanaci.ceonpointllc.com/");
define("ROAD_TRAFFIC_PATH", "home3/cme5fo1r/guyanart.ceonpointllc.com/");

define("CAR_INSURANCE_DOMAIN", "https://guyanaci.ceonpointllc.com/");
define("ROAD_TRAFFIC_DOMAIN", "https://guyanart.ceonpointllc.com/");