<?php
namespace

{
/**
 * display controller
 */
class blogdisplayModuleFrontController extends ModuleFrontController
{

    function initContent()
    {
        parent::initContent();
        $this->setTemplate('display.tpl');

        $postObj = new BlogPost();
        $posts = $postObj->getPosts();
        var_dump($posts);
        $this->context->smarty->assign('bonjour', $posts);
    }
}

}
