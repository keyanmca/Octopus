<?php
//private/helpers/helpers/NAVBAR.php
/**This class is responsible for creating bootstrp navigation elements. It
 * sholuld be noted that this class makes use of the bootstrap css and javascript
 * plugins.
 */
 class NAVBAR{
 	
 	/**
 	 * counts the number of responsive navbars.
 	 * @var int
 	 * @access private
 	 */
 	private static $count;
 	
 	/**
 	 * <p>Returns the HTML code for displaying a default bootstrap navbar.</p>
 	 * <h4>Example :</h4>
 	 * <pre><code>
 	 *
 	 * $java_nav_elements[] = [
 	 * 							'HTML'=>['href'=>'#'],
 	 * 							'javascrip'=>['href'=>'#'],
 	 * 							'HTML5'=>['href'=>'#', 'class'=>'disabled'],
 	 * 						];
 	 *
 	 * $java_nav_elements[] = [
 	 * 							'Flash'=>['href'=>'#'],
 	 * 							'Photoshop'=>['href'=>'#'],
 	 * 							'Gimp'=>['href'=>'#', 'class'=>'disabled'],
 	 * 						];
 	 *
 	 * $java_nav_elements[] = [
 	 * 							'Netbeans'=>['href'=>'#'],
 	 * 							'Eclips'=>['href'=>'#'],
 	 * 							'EBJ'=>['href'=>'#', 'class'=>'disabled'],
 	 * 						];
 	 *
 	 * NAVBAR::bar(['Languages','#'],[
 	 * 									'C++'=>['href'=>'#'],
 	 * 									'C'=>['href'=>'#', 'class'=>'active'],
 	 * 									'C#'=>['href'=>'#', 'class'=>'disabled'],
 	 * 									'Java'=>$java_nav_elements,
 	 * 									]);
 	 * </code></pre>
 	 * @param array $title Title of the navbar.
 	 * @param array $elements Elements of the navbar.
 	 * @return string The navbar HTML code.
 	 */
 	static function bar($title, $elements){
 		
 		$bar = "<nav class='navbar navbar-inverse' role='navigation'>";
 		$bar .= "<div class='navbar-header'>";
 		$bar .= "<a class='navbar-brand' href='".$title[1]."'>".$title[0]."</a>";
 		$bar .= "</div>";
 		$bar .="<ul class='nav navbar-nav'>";
 		
 		$bar .= self::build_list($elements);
 		
 		$bar .= "</ul></div></nav>";
 		
 		return $bar;
 	}
 	
 	/**
 	 * <p>Returns the HTML code for a bootstrap responsive navbar.</p>
 	 * <h4>Example :</h4>
 	 * <pre><code>
 	 *
 	 * $java_nav_elements[] = [
 	 * 							'HTML'=>['href'=>'#'],
 	 * 							'javascrip'=>['href'=>'#'],
 	 * 							'HTML5'=>['href'=>'#', 'class'=>'disabled'],
 	 * 						];
 	 *
 	 * $java_nav_elements[] = [
 	 * 							'Flash'=>['href'=>'#'],
 	 * 							'Photoshop'=>['href'=>'#'],
 	 * 							'Gimp'=>['href'=>'#', 'class'=>'disabled'],
 	 * 						];
 	 *
 	 * $java_nav_elements[] = [
 	 * 							'Netbeans'=>['href'=>'#'],
 	 * 							'Eclips'=>['href'=>'#'],
 	 * 							'EBJ'=>['href'=>'#', 'class'=>'disabled'],
 	 * 						];
 	 *
 	 * NAVBAR::responsive(['Languages','#'],[
 	 * 									'C++'=>['href'=>'#'],
 	 * 									'C'=>['href'=>'#', 'class'=>'active'],
 	 * 									'C#'=>['href'=>'#', 'class'=>'disabled'],
 	 * 									'Java'=>$java_nav_elements,
 	 * 									]);
 	 * </code></pre>
 	 * @param array $title Title of the navbar.
 	 * @param array $elements Elements of the navbar.
 	 * @return string The navbar HTML code.
 	 */
 	static function responsive($title, $elements){
 		
 		$bar = "<nav class='navbar navbar-inverse' role='navigation'>";
 		$bar .= "<div class='navbar-header'>";
 		$bar .= "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbar-collapse".self::$count."'>";
 		$bar .= "<span class='sr-only'>Toggle navigation</span>";
 		$bar .= "<span class='icon-bar'></span>";
 		$bar .= "<span class='icon-bar'></span>";
 		$bar .= "<span class='icon-bar'></span>";
 		$bar .= "</button>";
 		$bar .= "<a class='navbar-brand' href='#'>".$title[0]."</a>";
 		$bar .= "</div>";
 		$bar .= "<div class='collapse navbar-collapse' id='navbar-collapse".self::$count."'>";
 		$bar .= "<ul class='nav navbar-nav'>";
 		
 		$bar .= self::build_list($elements);
 		
 		$bar .= "</ul></div></nav>";
 		
 		self::$count++;
 		return $bar;
 	}
 	
 	/**
 	 * <p>Returns HTML code for displaying a bootstrap form navbar.</p>
 	 * <h4>Example :</h4>
 	 * <pre><code>
 	 * $txt = HTML::text_field('first-name','First Name', ['placeholder'=>'Enter first name']);
 	 * $btn = HTML::button('Start',['class'=>'btn btn-default']);
 	 * NAVBAR::form(['OpenSource','#'],['action'=>'#'],[$txt,$btn]);
 	 * </code></pre>
 	 * @param array $title The title of the navbar
 	 * @param array $frm_attribs The attributs of the form tag.
 	 * @param array $frm_elmnts Form elements to insert to in the navbar.
 	 * @return string The form navbar HTML code.
 	 */
 	 static function form($title, $frm_attribs, $frm_elmnts){
 	 	
 	 	$bar = "<nav class=\"navbar navbar-inverse\" role=\"navigation\">
			 <div class=\"navbar-header\">
			 <a class=\"navbar-brand\" href=\"".$title[1]."\">".$title[0]."</a>
			 </div>
			 <div><form class=\"navbar-form navbar-left\" role=\"search\"";
			 
		foreach($frm_attribs as $key=>$value) $bar .= " $key='$value'";
			 
		$bar .= "><div class=\"form-group\">";
		
		foreach($frm_elmnts as $value){
			
			$bar .= " $value";
		}
		
		$bar .= "</form></div></nav>";
		
		return $bar;
 	 }
 	
 	/**
 	 * Returns the HTML code for list items
 	 */
 	private static function build_list($elements,$seperator = false){
 		
 		$nav = "";
 		foreach($elements as $key=>$value){
 			
 			if(is_string(array_values($value)[0])){
 				
 				$nav .= "<li";
			
				if(isset($value['class']))
					$nav .= " class=\"".$value['class']."\"";
					
				$nav .="><a";
				
				if(isset($value['href']))
					$nav .= " href=\"".$value['href']."\"";
					
				$nav .= ">$key</a></li>";
				
 			}
 			
 			if(is_array(array_values($value)[0])){
 				
	 			$nav .= "<li class='dropdown'>";
	 			$nav .= "<a herf='#' class='dropdown-toglle' data-toggle='dropdown'>";
	 			$nav .= $key;
	 			$nav .= "<b class='caret'></b>";
	 			$nav .= "</a>";
	 			$nav .= "<ul class='dropdown-menu'>";
	 			
	 			foreach($value as $values){
	 				$nav .= self::build_list($values, true);
	 			}
	 			
	 			$nav .= "</ul></li>";
 			}
 			
 		}
 		
 		if($seperator) $nav .= "<li class='divider'></li>";
 		
 		return $nav;
 	}
 }
 ?>