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
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
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

//Encryption Key
define('Secret_key', 'Al-amaanah Techs');
define('Secret_iv', 'Bismillah@123456');

define('DB_PREFIX', '');

define('TABLE_ACADEMIC_SYLLABUS', DB_PREFIX.'academic_syllabus');
define('TABLE_CLASS', DB_PREFIX.'class');
define('TABLE_SECTION', DB_PREFIX.'section');
define('TABLE_ATTENDANCE', DB_PREFIX.'attendance');
define('TABLE_CLASS_ROUTINE', DB_PREFIX.'class_routine');
define('TABLE_PARENTS', DB_PREFIX.'parent');
define('TABLE_SUBJECTS', DB_PREFIX.'subject');
define('TABLE_STUDENTS', DB_PREFIX.'student');
define('TABLE_TEACHERS', DB_PREFIX.'teacher');
define('TABLE_GCM', DB_PREFIX.'app_gcm_parents');
define('TABLE_ENROLL', DB_PREFIX.'enroll');
define('TABLE_HOMEWORK', DB_PREFIX.'homework');
define('TABLE_UPDATES', DB_PREFIX.'app_daily_update');
define('TABLE_EVENT', DB_PREFIX.'app_event');
define('TABLE_ALBUM', DB_PREFIX.'app_album');
define('TABLE_GALLERY', DB_PREFIX.'app_gallery');
define('TABLE_NOTICE', DB_PREFIX.'app_notice_tbl');
define('TABLE_POSTS', DB_PREFIX.'app_post_det');
define('TABLE_COMMENT', DB_PREFIX.'app_comment_det');
define('TABLE_LIKE', DB_PREFIX.'app_like_det');
define('TABLE_CHAT', DB_PREFIX.'app_chatting');
define('TABLE_SETTING', DB_PREFIX.'settings');
define('TABLE_NOTICEBOARD', DB_PREFIX.'noticeboard');
define('TABLE_FEE_PENDING', DB_PREFIX.'fees_pending');
define('TABLE_FEE_INVOICE', DB_PREFIX.'fees_invoice');

define('TABLE_MESSAGE', DB_PREFIX.'message');
define('TABLE_MESSAGE_THREAD', DB_PREFIX.'message_thread');
define('TABLE_ADMIN', DB_PREFIX.'admin');
define('TABLE_ASSIGNMENT_TEACHER', DB_PREFIX.'assignment_teacher');

//define('Parent_GCM_Key', 'AIzaSyDrm5WYY6XMnhai-TyFiUJzH6vNdg4bpNI');
//define('Admin_GCM_Key', 'AIzaSyC9xy7nxSXL01b1PZFuUxDMLyH0qZwDIu4');
