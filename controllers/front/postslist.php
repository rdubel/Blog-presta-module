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
        $postObj = new BlogPost();
        $posts_list = $postObj->getPosts();
        $posts = [];
        foreach ($posts_list as $post) {
            $post['link'] = $this->context->link->getModuleLink('blog', 'postdetail', array('id' => $post['id_blog_post']));
            $posts[] = $post;
        }
        $this->context->smarty->assign('posts', $posts);
    }
}

}
