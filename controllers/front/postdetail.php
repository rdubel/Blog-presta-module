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
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('blog_post');
        $sql->where('id_blog_post ='.$post_id);
        if ($res = Db::getInstance()->executeS($sql)) {
            $this->context->smarty->assign(array(
                'post' => $res
            ));
        }
    }
}

}
