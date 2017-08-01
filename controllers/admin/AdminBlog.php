<?php
namespace

{
    class AdminBlogController extends ModuleAdminController
    {

        public function __construct()
        {
            $this->table = "blog_post";
            $this->display = 'blog_list';
            $this->className = 'Post';
            $this->lang = false;

            $this->fields_list = array(
                'id_blog_post' => array(
                    'title' => 'ID'
                ),
                'title' => array(
                    'title' => 'Title',
                ),
                'content' => array(
                    'title' => 'Content',
                ),
                'publication_date' => array(
                    'title' => 'Publication date',
                ),
            );

            $this->bulk_actions = array(
                'delete' => array(
                    'text' => 'Delete selected',
                    'confirm' => 'Delete selected items?',
                ),
            );
            // définition de l'upload, chemin par défaut _PS_IMG_DIR_
            // $this->fieldImageSettings = array('name' => 'image', 'dir' => 'example');
            parent::__construct();
        }

        public function renderList()
        {
            $this->addRowAction('edit');
            $this->addRowAction('delete');
            $this->addRowAction('details');

            $this->fields_list['position'] = array(
    			'title' => 'Position',
    			'width' => 70,
    			'align' => 'center',
    			'position' => 'position'
    		);

            $lists = parent::renderList();
    		// parent::initToolbar();
    		return $lists;

        }

        // public function ajaxProcessDetails()
        // {
        //     if (($id = Tools::getValue('id')))
        //     {
        //         // override attributes
        //         $this->display = 'list';
        //         $this->lang = false;
        //         $this->addRowAction('edit');
        //         $this->addRowAction('delete');
        //         $this->_select = 'b.*';
        //         $this->_join = 'LEFT JOIN `'._DB_PREFIX_.'tab_lang` b ON (b.`id_tab` = a.`id_tab` AND b.`id_lang` = '.$this->context->language->id.')';
        //         $this->_where = 'AND a.`id_parent` = '.(int)$id;
        //         $this->_orderBy = 'position';
        //         // get list and force no limit clause in the request
        //         $this->getList($this->context->language->id);
        //         // Render list
        //         $helper = new HelperList();
        //         $helper->actions = $this->actions;
        //         $helper->list_skip_actions = $this->list_skip_actions;
        //         $helper->no_link = true;
        //         $helper->shopLinkType = '';
        //         $helper->identifier = $this->identifier;
        //         $helper->imageType = $this->imageType;
        //         $helper->toolbar_scroll = false;
        //         $helper->show_toolbar = false;
        //         $helper->orderBy = 'position';
        //         $helper->orderWay = 'ASC';
        //         $helper->currentIndex = self::$currentIndex;
        //         $helper->token = $this->token;
        //         $helper->table = $this->table;
        //         $helper->position_identifier = $this->position_identifier;
        //         // Force render - no filter, form, js, sorting ...
        //         $helper->simple_header = true;
        //         $content = $helper->generateList($this->_list, $this->fields_list);
        //         echo Tools::jsonEncode(array('use_parent_structure' => false, 'data' => $content));
        //     }
        //     die;
        // }
        // // public function renderForm()
        // {
            $this->fields_form = array(
                'tinymce' => true,
                'legend' => array(
                    'title' => $this->l('Example'),
                    'image' => '../img/admin/cog.gif'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'lang' => true,
                        'label' => $this->l('Name:'),
                        'name' => 'name',
                        'size' => 40
                    ),
                    array(
                        'type' => 'file',
                        'label' => $this->l('Logo:'),
                        'name' => 'image',
                        'display_image' => true,
                        'desc' => $this->l('Upload Example image from your computer')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Lorem:'),
                        'name' => 'lorem',
                        'readonly' => true,
                        'disabled' => true,
                        'size' => 40
                    ),
                    array(
                        'type' => 'date',
                        'name' => 'exampledate',
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'button'
                )
            );
        //     if (!($obj = $this->loadObject(true)))
        //         return;
        //     /* Thumbnail
        //      * @todo Error, deletion of the image
        //     */
        //     $image = ImageManager::thumbnail(_PS_IMG_DIR_.'region/'.$obj->id.'.jpg', $this->table.'_'.(int)$obj->id.'.'.$this->imageType, 350, $this->imageType, true);
        //     $this->fields_value = array(
        //         'image' => $image ? $image : false,
        //         'size' => $image ? filesize(_PS_IMG_DIR_.'example/'.$obj->id.'.jpg') / 1000 : false,
        //     );
        //     $this->fields_value = array('lorem' => 'ipsum');
        //     return parent::renderForm();
        // }
        // public function postProcess()
        // {
        //     if (Tools::isSubmit('submitAdd'.$this->table))
        //     {
        //         // Create Object ExampleData
        //         $exemple_data = new ExampleData();
        //         $exemple_data->exampledate = array();
        //         $languages = Language::getLanguages(false);
        //             foreach ($languages as $language)
        //                 $exemple_data->name[$language['id_lang']] = Tools::getValue('name_'.$language['id_lang']);
        //         // Save object
        //         if (!$exemple_data->save())
        //             $this->errors[] = Tools::displayError('An error has occurred: Can\'t save the current object');
        //         else
        //             Tools::redirectAdmin(self::$currentIndex.'&conf=4&token='.$this->token);
        //     }
        // }

    }
}
