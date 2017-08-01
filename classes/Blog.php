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
        }

        public function installDb() {
            $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_post`(
                `id_blog_post` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `title` VARCHAR(250) NOT NULL ,
                `body` TEXT ,
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

        public function hookDisplayHeader()
        {
            $this->context->controller->addCSS($this->_path.'css/blog.css', 'all');
        }
    }
}
