<?php
//private/helpers/helpers/NAV
/**This class is responsible for creating bootstrp navigation elements. It
 * sholuld be noted that this class makes use of the bootstrap css and javascript
 * plugins.
 */
class NAV{
	
	/**
	 * <p>Returns the HTML code to display a bootstrap stacked pills navigation
	 * menu.
	 * <h4>Example :</h4>
	 * <pre><code>
	 * NAV::stack('tab', [
	 * 			'Home'=>['href'=>'#'],
	 * 			'JAVA'=>['href'=>'#', 'class'=>'disabled'],
	 * 			'PHP'=>['href'=>'#', 'class'=>'active'],
	 * 			'C++'=>['href'=>'#'],
	 * 			]);
	 * </code></pre>
	 *@param array $items Associative label/attributes array.
	 */
	static function stack($items){
		
		$type = "pills nav-stacked";
		
		return self::build_tab($type,$items);
	}
	
	/**
	 * <p>Returns the HTML code to display a bootstrap tabbed navigation menu.
	 * <h4>Example :</h4>
	 * <pre><code>
	 * NAV::tab('tab', [
	 * 			'Home'=>['href'=>'#'],
	 * 			'JAVA'=>['href'=>'#', 'class'=>'disabled'],
	 * 			'PHP'=>['href'=>'#', 'class'=>'active'],
	 * 			'C++'=>['href'=>'#'],
	 * 			]);
	 * </code></pre>
	 *@param array $items Associative label/attributes array.
	 */
	static function tab($items){
		
		$type = "tabs";
		
		return self::build_tab($type,$items);
	}
	
	/**
	 * <p>Returns the HTML code to display a bootstrap pills navigation menu.
	 * <h4>Example :</h4>
	 * <pre><code>
	 * NAV::pill('tab', [
	 * 			'Home'=>['href'=>'#'],
	 * 			'JAVA'=>['href'=>'#', 'class'=>'disabled'],
	 * 			'PHP'=>['href'=>'#', 'class'=>'active'],
	 * 			'C++'=>['href'=>'#'],
	 * 			]);
	 * </code></pre>
	 *@param array $items Associative label/attributes array.
	 */
	static function pill($items){
		
			$type = "pills";
		
		return self::build_tab($type,$items);
	}
	
	private static function build_tab($type,$items){
		
		$tab = "<ul class=\"nav nav-$type\">";
		
		foreach($items as $label => $attribs){
			
			$tab .= "<li";
			
			if(isset($attribs['class']))
				$tab .= " class=\"".$attribs['class']."\"";
				
			$tab .="><a";
			
			if(isset($attribs['href']))
				$tab .= " href=\"".$attribs['href']."\"";
				
			$tab .= ">$label</a></li>";
			
		}
		$tab .= "</ul>";
		
		return $tab;
	}
}
?>