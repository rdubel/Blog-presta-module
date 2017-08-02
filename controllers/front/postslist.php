<?php
namespace

{
    /**
    * display controller
    */
    class blogpostslistModuleFrontController extends ModuleFrontController
    {

        function initContent()
        {
            parent::initContent();
            $this->setTemplate('posts_list.tpl');

            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('blog_post');

            $posts = [];

            if ($posts_list = Db::getInstance()->executeS($sql)) {

                foreach ($posts_list as $post) {

                    $post['link'] = $this->context->link->getModuleLink('blog', 'postdetail', array('id' => $post['id_blog_post']));
                    $posts[] = $post;

                }
            }

            $this->context->smarty->assign(array(
                'posts' => $posts
            ));
        }
    }

}
