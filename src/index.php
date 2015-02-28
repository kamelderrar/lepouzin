
	<?php require_once('includes/functions.php');
		  require_once('includes/header.php'); 
	ob_start();
// Par défaut, la page est Home
$page = 'pages/home';
// Si GET['page'] existe, alors la page est GET['page']
if (isset($_GET['page'])) {
    $page =  'pages/' . $_GET['page'];
    // Sauf si GET['page'] ne correspond pas à un fichier existant
    // Dans ce cas, la page sera 404
    if (!file_exists($page . '.php')) {
        header("HTTP/1.0 404 Not Found");
        $page = 'pages/404';   
    }
}
require_once $page . '.php';
$content = ob_get_clean(); 
echo $content;

require_once('includes/footer.php'); ?>

	