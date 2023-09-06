 <?php
    session_start();
  
    error_reporting(E_ALL & ~E_NOTICE);
    // Report all errors
    //error_reporting(E_ALL);
    /*
* set default time-zone to confirm the timezone
* else it will show an error that system time is not reliable
* Change it as per your timezone
*/
    date_default_timezone_set('Asia/Kolkata');
    /*
* set maximum script execution time to overcome
* timeout situations
* I have set it for 5 minutes, i.e. 5 mins * 60 seconds,
* But dont use unlimited or too much time as it may cause
* too much server load and even breakdown 
*/
    set_time_limit(10 * 60);
    if ($_SERVER['HTTP_HOST'] == "localhost") {
        define('ROOTINDEX', 'https://www.ccvs.in');
        define('ROOTBIMG', 'https://www.ccvs.in/admin/upload/banner-images');
        define('ROOTIMG', 'https://www.ccvs.in/admin/upload/post-images');
        define('ROOTSERV', 'https://www.ccvs.in/admin/upload/service-images');
        define('ROOTLOGO', 'https://www.ccvs.in/admin/upload/logo-images');
        define('ROOTPDF', 'https://www.ccvs.in/admin/upload/pdf');
        define('ROOT', 'https://localhost/ccvs.in/admin');
        ///define('HOST', $_SERVER['SERVER_NAME']);
        $server = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'auction';
     //   $port = '3308';
    } else {
        define('ROOTINDEX', 'https://www.diamondexchg.in');
        define('ROOTBIMG', 'https://www.localhost/www.findhouses.in/admin/upload/banner-images');
        define('ROOTIMG', 'https://www.localhost/www.findhouses.in/admin/upload/post-images');
        define('ROOTSERV', 'https://www.localhost/www.findhouses.in/admin/upload/service-images');
        define('ROOTLOGO', 'https://www.localhost/www.findhouses.in/admin/upload/logo-images');
        define('ROOTPDF', 'https://www.ccvs.in/admin/upload/pdf');
        define('ROOTTEST', 'https://www.localhost/www.findhouses.in/admin/upload/testimonial');
        define('ROOTPROIMG', 'https://www.localhost/www.findhouses.in/admin/upload/product');
        define('ROOT', 'https://www.localhost/www.findhouses.in/admin');
        //define('HOST', $_SERVER['SERVER_NAME']);
        $server = 'localhost';
        $user = 'sabredge_stock_managment_system';
        $password = 'stock_managment_system';
        $database = 'sabredge_stock_managment_system';
        /*$port = '3308';*/
    }
    //Open a new connection to the MySQL server
    $db = new mysqli($server, $user, $password, $database);
    //Output any connection error
    if ($db->connect_error) {
        die('Connect Error (' . $db->connect_errno . ') '
            . $db->connect_error);
    }
    //echo '<p>Connection OK '. $db->host_info.'</p>';
    //echo '<p>Server '.$db->server_info.'</p>';
    //$db->close();

    $url = $_SERVER['REQUEST_URI'];
    $url = explode('/', $url);
