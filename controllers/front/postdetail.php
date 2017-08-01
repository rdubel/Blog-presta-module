<?php
namespace

{
/**
 * display controller
 */
class blogpostdetailModuleFrontController extends ModuleFrontController
{

    function initContent()
    {
        parent::initContent();
        $this->setTemplate('post_detail.tpl');
        $post_id = Tools::getValue('id');
        $postObj = new BlogPost();
        $post = $postObj->getPost($post_id);
        $this->context->smarty->assign(array(
            'post' => $post
        ));
    }
}

}
