<?php
namespace

{
    class Post extends ObjectModel
    {
        public $id_blog_post;
    	public $title;
    	public $content;
        public $publication_date;

    	public static $definition = array(
    		'table' => "blog_posts",
    		'primary' => 'id_blog_post',
    		'multilang' => false,
    		'fields' => array(
    			'title' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 100),
    			'content' => array('type' => self::TYPE_HTML, 'validate' => 'isGenericName', 'required' => false, 'size' => 5000),
                'publication_date' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'required' => true),
    		),
    	);


    }
}
