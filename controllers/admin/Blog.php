<?php

class BlogController extends AdminController {

    public function __construct() {
        $module_name = "blog";
        Tools::redirectAdmin('index.php?controller=AdminModules&configure=' . $module_name . '&token=' . Tools::getAdminTokenLite('AdminModules'));
    }

}
