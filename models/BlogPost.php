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


    }
}
