<?php

namespace

{

    class Blog extends Module
    {
        public function __construct()
        {
            $this->name = 'blog';
            $this->tab = 'front_office_features';
            $this->version = '1.0.0';
            $this->author = 'Thibault & Rémy';
            $this->need_instance = 0;
            $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
            $this->bootstrap = true;

            parent::__construct();

            $this->displayName = $this->l('Blog');
            $this->description = $this->l('This thing here creates a blog for your eshop.');

            $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

            // if (!Configuration::get('MYMODULE_NAME')) {
            //     $this->warning = $this->l('No name provided');
            // }
        }

        public function install()
        {
            if (Shop::isFeatureActive()) {
                Shop::setContext(Shop::CONTEXT_ALL);
            }

            if (!parent::install()
            || !$this->registerHook('displayHome')
            || !$this->registerHook('header')
            // || !Configuration::updateValue('MYMODULE_NAME', 'my friend')
            ) {
                return false;
            }
            
            $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_posts`(
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `title` VARCHAR(250) NOT NULL ,
                `content` TEXT ,
                `publication_date` DATE NOT NULL) DEFAULT CHARSET=utf8";
                
            if(!$result=Db::getInstance()->Execute($sql)){
                return false;
            }
                

            return true;
        }

        public function uninstall()
        {
            if (!parent::uninstall()
            // || !Configuration::deleteByName('MYMODULE_NAME')
            ) {
                return false;
            }
            
            $sql = "DROP TABLE IF EXISTS `"._DB_PREFIX_."blog_posts`";
                
            if(!$result=Db::getInstance()->Execute($sql)){
                return false;
            }
            
            return true;
        }

        // public function getContent()
        // {
        //     $output = null;
        // 
            // if (Tools::isSubmit('submit'.$this->name)) {
            //     $my_module_name = strval(Tools::getValue('MYMODULE_NAME'));
            //     if (!$my_module_name
            //     || empty($my_module_name)
            //     || !Validate::isGenericName($my_module_name)) {
            //         $output .= $this->displayError($this->l('Invalid Configuration value'));
            //     } else {
            //         Configuration::updateValue('MYMODULE_NAME', $my_module_name);
            //         $output .= $this->displayConfirmation($this->l('Settings updated'));
            //     }
            // }
        //     return $output.$this->displayForm();
        // }

        // public function displayForm()
        // {
        //     // Get default language
        //     $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        // 
        //     // Init Fields form array
        //     $fields_form[0]['form'] = array(
        //     'legend' => array(
        //     'title' => $this->l('Settings'),
        //     ),
        //     'input' => array(
        //     array(
        //     'type' => 'text',
        //     'label' => $this->l('Configuration value'),
        //     'name' => 'MYMODULE_NAME',
        //     'size' => 20,
        //     'required' => true
        //     )
        //     ),
        //     'submit' => array(
        //     'title' => $this->l('Save'),
        //     'class' => 'btn btn-default pull-right'
        //     )
        //     );
        // 
        //     $helper = new HelperForm();
        // 
        //     // Module, token and currentIndex
        //     $helper->module = $this;
        //     $helper->name_controller = $this->name;
        //     $helper->token = Tools::getAdminTokenLite('AdminModules');
        //     $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        // 
        //     // Language
        //     $helper->default_form_language = $default_lang;
        //     $helper->allow_employee_form_lang = $default_lang;
        // 
        //     // Title and toolbar
        //     $helper->title = $this->displayName;
        //     $helper->show_toolbar = true;        // false -> remove toolbar
        //     $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        //     $helper->submit_action = 'submit'.$this->name;
        //     $helper->toolbar_btn = array(
        //     'save' =>
        //     array(
        //     'desc' => $this->l('Save'),
        //     'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
        //     '&token='.Tools::getAdminTokenLite('AdminModules'),
        //     ),
        //     'back' => array(
        //     'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
        //     'desc' => $this->l('Back to list')
        //     )
        //     );
        // 
        //     // Load current value
        //     $helper->fields_value['MYMODULE_NAME'] = Configuration::get('MYMODULE_NAME');
        // 
        //     return $helper->generateForm($fields_form);
        // }
        public function hookDisplayHome($params)
        {
            // $productsObj = new Product();
            // $products = $productsObj->getProducts(
            //     Context::getContext()->language->id,
            //     0,
            //     0,
            //     'id_product',
            //     'DESC',
            //     false,
            //     true
            // );
            // $this->context->smarty->assign(
            //     array(
            //     'my_module_name' => Configuration::get('MYMODULE_NAME'),
            //     'my_module_link' => $this->context->link->getModuleLink('blog', 'display'),
            //     'total' => count($products),
            //     'lastproduct' => $products[0]['name']
            //     )
            // );
            return $this->display(_PS_MODULE_DIR_.'blog', 'blog.tpl');
        }

        public function hookDisplayHeader()
        {
            $this->context->controller->addCSS($this->_path.'css/blog.css', 'all');
        }
    }
}
