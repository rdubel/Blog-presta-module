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
            $this->bootstrap = true;
            $this->need_instance = 0;
            $this->context = Context::getContext();
            $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
            $this->bootstrap = true;

            parent::__construct();

            $this->displayName = $this->l('Blog');
            $this->description = $this->l('This thing here creates a blog for your eshop.');

            $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        }

        public function installDb() {
            $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_post`(
                `id_blog_post` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `title` VARCHAR(250) NOT NULL ,
                `content` TEXT ,
                `publication_date` DATE NOT NULL) DEFAULT CHARSET=utf8";

            if (!$result=Db::getInstance()->Execute($sql)) {
                return false;
            }

            return true;
        }

        public function installTab() {
            $tab = new Tab();
            foreach (Language::getLanguages(true) as $lang) {
                $tab->name[$lang['id_lang']] = $this->l('Blog');
            }
            $tab->module = $this->name;
            $tab->id_parent = 0;
            $tab->class_name = "AdminBlog";

            if (!$tab->add()) {
                return false;
            }

            $subTab1 = new Tab();
            foreach (Language::getLanguages(true) as $lang) {
                $subTab1->name[$lang['id_lang']] = $this->l('Ajouter un post');
            }
            $subTab1->module = $this->name;
            $subTab1->id_parent = $tab->id;
            $subTab1->class_name = "AdminBlog";

            $subTab2 = new Tab();
            foreach (Language::getLanguages(true) as $lang) {
                $subTab2->name[$lang['id_lang']] = $this->l('Tous les posts');
            }
            $subTab2->module = $this->name;
            $subTab2->id_parent = $tab->id;
            $subTab2->class_name = "AdminBlog";

            if (!$subTab1->add()
                || !$subTab2->add()
            ) {
                return false;
            }

            return true;
        }

        public function install()
        {
            if (Shop::isFeatureActive()) {
                Shop::setContext(Shop::CONTEXT_ALL);
            }

            if (!parent::install()
            || !$this->installDb()
            || !$this->installTab()
            || !$this->registerHook('displayHome')
            || !$this->registerHook('header')
            || !$this->registerHook('displayBackOfficeHeader')
            ) {
                return false;
            }

            return true;
        }

        public function uninstallDb() {
            $sql = "DROP TABLE IF EXISTS `"._DB_PREFIX_."blog_post`";

            if (!$result=Db::getInstance()->Execute($sql)) {
                return false;
            }

            return true;
        }

        public function uninstallTab() {
            $moduleTabs = Tab::getCollectionFromModule($this->name);
            if (!empty($moduleTabs)) {

                foreach ($moduleTabs as $tab) {

                    if (!$tab->delete()
                    ) {
                        return false;
                    }

                }
            }
            return true;
        }

        public function uninstall()
        {
            if (!parent::uninstall()
               || !$this->uninstallDb()
               || !$this->uninstallTab()
               || !$this->unregisterHook('displayHome')
               || !$this->unregisterHook('header')
               || !$this->unregisterHook('displayBackOfficeHeader')
            ) {
                return false;
            }

            return true;
        }

        public function hookDisplayBackOfficeHeader()
        {
            $this->context->controller->addCss($this->_path.'css/tab.css');
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
