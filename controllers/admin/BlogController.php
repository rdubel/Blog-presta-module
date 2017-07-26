<?php
namespace

{
    class AdminBlogController extends ModuleAdminController
    {
        public function __construct()
        {
            $this->table = "blog_posts";
            $this->className = 'Post';
            $this->lang = false;
            $this->deleted = false;
            $this->colorOnBackground = false;
            $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => 'Delete selected items?'));
            $this->context = Context::getContext();
            // définition de l'upload, chemin par défaut _PS_IMG_DIR_
            // $this->fieldImageSettings = array('name' => 'image', 'dir' => 'example');
            parent::__construct();
        }

        public function renderList()
        {
            $this->addRowAction('edit');
            $this->addRowAction('delete');
            $this->addRowAction('details');

            $this->bulk_actions = array(
                'delete' => array(
                    'text' => 'Delete selected',
                    'confirm' => 'Delete selected items?'
                )
            );

            $this->fields_list = array(
                'id_blog_post' => array(
                    'title' => 'ID',
                    'align' => 'center',
                    'width' => 25
                ),
            )

        }

    }
}
