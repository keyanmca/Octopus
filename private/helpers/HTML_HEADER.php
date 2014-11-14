<?php
/**
 * Manages the title, meta, script and link tags in the html head tage.
 */
class HTML_HEADER{
	
	private static $css = array();
	private static $js = array();
	private static $link = array();
	private static $meta = array();
	private static $header = "";
	public static $TITLE = "";
	
	/**
	 * Adds a css tag to the html header to be displayed.
	 * @param array $attributes associative array of attribute/value pairs.
	 */
	static function add_css($attributes){
		
		if(is_array($attributes))
			self::$css[] = $attributes;
	}
	
	/**
	 * Adds a script tag to the html header to be displayed.
	 * @param array $attributes associative array of attribute/value pairs.
	 */
	static function add_js($attributes){
		
		if(is_array($attributes))
			self::$js[] = $attributes;
	}
	
	/**
	 * Adds a link tag to the html header to be displayed.
	 * @param array $attributes associative array of attribute/value pairs.
	 */
	static function add_link($attributes){
		
		if(is_array($attributes))
			self::$link[] = $attributes;
	}
	
	/**
	 * Adds a meta tag to the html header to be displayed.
	 * @param array $attributes associative array of attribute/value pairs.
	 */
	static function add_meta($attributes){
		
		if(is_array($attributes))
			self::$meta[] = $attributes;
	}
	
	/**
	 * Displaces the header.
	 */
	 static function display(){
	 	
	 	//Arranging metas
	 	for($i = 0; $i < count(self::$meta) ; $i++){
	 		
	 		self::$header .= "\n\t<meta ";
	 		
		 	foreach(self::$meta[$i] as $key => $value){
		 		
		 		self::$header.= "$key = \"$value\" ";
		 	}
		 	
		 	self::$header .= ' >';
	 	}
	 	//Arranging links
	 	for($i = 0; $i < count(self::$link) ; $i++){
	 		
	 		self::$header .= "\n\t<link ";
	 		
		 	foreach(self::$link[$i] as $key => $value){
		 		
		 		self::$header.= "$key = \"$value\" ";
		 	}
		 	
		 	self::$header .= ' >';
	 	}
	 	
	 	//Arranging css
	 	for($i = 0; $i < count(self::$css) ; $i++){
	 		
	 		self::$header .= "\n\t<link rel=\"stylesheet\" type=\"text/css\" ";
	 		
		 	foreach(self::$css[$i] as $key => $value){
		 		
		 		self::$header.= "$key = \"$value\" ";
		 	}
		 	
		 	self::$header .= ' >';
	 	}
	 	
	 	//Arranging java scripts
	 	for($i = 0; $i < count(self::$js) ; $i++){
	 		
	 		self::$header .= "\n\t<script ";
	 		
		 	foreach(self::$js[$i] as $key => $value){
		 		
		 		self::$header.= "$key = \"$value\" ";
		 	}
		 	
		 	self::$header .= ' ></script>';
	 	}
	 	
	 	echo self::$header."\n";
	 }
}
?>