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
            $sql = "SELECT * FROM `"._DB_PREFIX_."blog_post`";
            if ($result=Db::getInstance()->ExecuteS($sql)) {
                return $result;
            }
        }

        public function getPost($id) {
            $sql = "SELECT * FROM `"._DB_PREFIX_."blog_post` WHERE id_blog_post=".$id;
            if ($result=Db::getInstance()->getRow($sql)) {
                return $result;
            }
        }


    }
}
