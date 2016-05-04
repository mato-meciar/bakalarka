<?php

require_once dirname(__FILE__)."/BaseController.php";

class ViewController extends BaseController {
    private $navigation;
    
    public function __construct() {
        parent::__construct();
        $this->navigation = array();
    }
    
    protected function showContent($view, $data = array()) {
        require_once dirname(dirname(__FILE__)).'/views/body.php';
    }
    
    protected function showLogin($message = "") {
        $view = 'login/index';
        $title = 'Prihlasenie';
        $data = array('message' => $message);
        require_once dirname(dirname(__FILE__))."/views/body.php";
    }
    
    protected function setNavLinkActive($key) {
        $this->navigation[$key] = true;
    }
    
    protected function isNavLinkActive($key) {
        if (isset($this->navigation[$key]) && $this->navigation[$key]) {
            return true;
        } else {
            return false;
        }
    }
    
    protected function view($data = array()) {
        $controller_name = 'home';
        $method = 'index';
        $url = explode('/', filter_var(rtrim(@$_GET['url'], '/'), FILTER_SANITIZE_URL));
        if (file_exists(dirname(dirname(__FILE__)).'/controllers/' . $url[0] . '.php')) {
            $controller_name = $url[0];
        }
        if (isset($url[1])) {
            $controller = new $controller_name;
            if (method_exists($controller, $url[1])) {
                $method = $url[1];
            }
        }
        if (file_exists(dirname(dirname(__FILE__)).'/views/' . $controller_name . '/' . $method . '.php')) {
            $this->showContent($controller_name . '/' . $method, $data);
        } else {
            throw new Exception('File app/views/' . $controller_name . '/' . $method . '.php doesn\'t exist');
        }
    }
    
    protected function viewMessage($message) {
        $view = 'message';
        $data = array('message' => $message);
        require_once dirname(dirname(__FILE__)).'/views/body.php';
    }
    
    protected function refresh() {
        header('Location: ' . $this->getUrl($_GET['url']));
    }
    
    protected function goToUrl($url) {
        header('Location: ' . $this->getUrl($url));
    }
}
