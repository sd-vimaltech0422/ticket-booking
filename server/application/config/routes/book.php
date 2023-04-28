<?php
/*$route['showmymessage'] = 'AuthController/Login';*/

$route['showmymessage'] = 'Welcome/showMessage';

$route['getallpersons'] = 'BookingController/getAllPersonsList';
$route['getallseatsavailable'] = 'BookingController/getSeatsBookingDetails';
$route['savebookingstatus'] = 'BookingController/saveBookingData';

