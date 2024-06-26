<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('SALT',  '#*1nf0-*%');
define('PATH_APP',  'http://localhost/Ferrital_web/core/application/');
define('NOMBRE_EMPRESA',		'CAVAL');

define('PERIODOS_GRATIS',		2);
define('TURBOSMTP_USER',		'rodrigo.gonzalez@arnou.cl');
define('TURBOSMTP_PASS',		'P6nLKAvx');
define('API_KEY_MAIL',		'f5776220de8b10e443dd3b62655db60ef33ac16bfd79b0b25aa3a2a9d469716a-OAP4s3I0KraSbwp2');
define('ENVIO_MAIL',		TRUE);



define('PORCT_FONASA',		0.016); //3.9% //1% //3.9% // 2.1% // 1.6%
define('PORCT_INP',		0.054); //3.1%  //6% //3.1% // 4.9 % // 5.4 %

define('PORCT_ISL',		0.93); //3.1%  //6%


define('ACTUALIZA_INDICADORES',		TRUE); 
define('URL_API_ADM',		'http://adm.arnou.cl'); 
define('CENTRALIZACION_PRUEBA',		TRUE); 



/* End of file constants.php */
/* Location: ./application/config/constants.php */