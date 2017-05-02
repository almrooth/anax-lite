<?php
/**
 * Bootstrap the framework.
 */
// Where are all the files? Booth are needed by Anax.
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Add all resources to $app
$app            = new \Talm\App\App();
$app->request   = new \Anax\Request\Request();
$app->response  = new \Anax\Response\Response();
$app->url       = new \Anax\Url\Url();
$app->router    = new \Anax\Route\RouterInjectable();
$app->view      = new \Anax\View\ViewContainer();
$app->session   = new \Talm\Session\Session();
$app->calendar  = new \Talm\Calendar\Calendar();
$app->cookie    = new \Talm\Cookie\Cookie();

// Navbar
$app->navbar    = new \Talm\Navbar\Navbar();
$app->navbar->configure("navbar.php");
$app->navbar->setApp($app);

// Database
$app->db        = new \Talm\Database\Database();
// $app->db->configure("database-local.php");
$app->db->configure("database.php");
$app->db->setApp($app);

// TextFilter
$app->textformat = new \Talm\Textformat\Textformat();

// Content class
$app->content    = new \Talm\Content\Content();
$app->content->setApp($app);

// Init request object
$app->request->init();

// Init url object with defaults from the request object
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

// Inject $app into the view container for use in view files.
$app->view->setApp($app);

// Update view configuration with values from config file.
$app->view->configure("view.php");

// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();

// Add stylesheet to app
$app->stylesheet = $app->url->asset("css/style.min.css");

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Leave to router to match incoming request to routes
$app->router->handle($app->request->getRoute());
