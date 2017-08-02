<?php
namespace

{
    class BlogPost extends ObjectModel
    {
        public $id_blog_post;
    	public $title;
    	public $body;
        public $publication_date;

    	public static $definition = array(
    		'table' => "blog_post",
    		'primary' => 'id_blog_post',
    		'multilang' => false,
    		'fields' => array(
    			'title' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName'),
    			'body' => array('type' => self::TYPE_HTML, 'validate' => 'isGenericName'),
                'publication_date' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
    		),
    	);

        public function getPosts() {
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('blog_post');
            $result=Db::getInstance()->ExecuteS($sql);
            if ($result) {
                return $result;
            }
            return false;
        }

        public function getPost($id) {
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('blog_post');
            $sql->where('id_blog_post ='.$id);
            $result=Db::getInstance()->getRow($sql);
            if ($result) {
                return $result;
            }
            return false;
        }


    }
}
