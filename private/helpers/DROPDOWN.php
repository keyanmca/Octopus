<?php
//private/helpers/DROPDOWN.php
/**
 * Helper class for displaying bootstrap drop down elements. It uses the twitter bootstrap css
 * and javascript frameworks to formate the displayed content. So make sure you
 * include both bootstrap frameworks to effectively use this helper class.
 */
 
 class DROPDOWN{
 	
 	/**
 	 * Keeps track of the ids to affect to each dropdown on a page
 	 * @var int
 	 * @access private
 	 */
 	 private static $count = 0;
 	
 	/**
 	 * Returns the html code for a simple boostrap dropdown.
 	 * Use :
 	 *
 	 * DROPDOWN::simple('Languages',['Web'=>
 	 * 									['HTML'=>'#','JavaScript'=>'#','PHP'=>'#',],
 	 * 								  'Mobil'=>
 	 * 									['C++'=>'#','Java'=>'#','C#'=>'#',],
 	 * 								]);
 	 */
 	static function simple($label, $item_groups){
 		
 		$output = "<div class=\"dropdown\">
 					<button type=\"button\" class=\"btn dropdown-toggle\" id=\"dropdownMenu".self::$count."\" data-toggle=\"dropdown\">
 					$label<span class=\"caret\"></span>
 					</button>
 					<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu".self::$count."\">";

 					
 		foreach($item_groups as $title => $item){
 			
 			if($title != '')
 				$output .= "<li role=\"presentation\" class=\"dropdown-header\">$title</li>";
 			
 			foreach($item as $label=>$link){
 					
 				$output .= "<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"$link\">
 				$label
 				</a>
 				</li>";
 				
 			}
			$output .= "<li role=\"presentation\" class=\"divider\"></li>";

 		}
 		
 		$output .= "</ul></div>";
 		
 		self::$count++;
 		
 		return $output;
 	}
 	
 	/**
 	 * Returns the html code for a simple button boostrap dropdown.
 	 * Use :
 	 *
 	 * DROPDOWN::button('Languages',['Web'=>
 	 * 									['HTML'=>'#','JavaScript'=>'#','PHP'=>'#',],
 	 * 								  'Mobil'=>
 	 * 									['C++'=>'#','Java'=>'#','C#'=>'#',],
 	 * 								], 'sm');
 	 */
 	static function button($label, $item_groups, $size = "", $button_type = 'default'){
 		
 		$output = "<div class=\"btn-group\">
 					<button type=\"button\" class=\"btn btn-$button_type btn-$size dropdown-toggle\" data-toggle=\"dropdown\">
 					$label<span class=\"caret\"></span>
 					</button>
 					<ul class=\"dropdown-menu\" role=\"menu\">";

 					
 		foreach($item_groups as $title => $item){
 			
 			if($title != '')
 				$output .= "<li role=\"presentation\" class=\"dropdown-header\">$title</li>";
 			
 			foreach($item as $label=>$link){
 					
 				$output .= "<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"$link\">
 				$label
 				</a>
 				</li>";
 				
 			}
			$output .= "<li role=\"presentation\" class=\"divider\"></li>";

 		}
 		
 		$output .= "</ul></div>";
 		
 		return $output;
 	}
 	
 	/**
 	 * Returns the html code for a split-button boostrap dropdown.
 	 * Use :
 	 *
 	 * DROPDOWN::button('Languages',['Web'=>
 	 * 									['HTML'=>'#','JavaScript'=>'#','PHP'=>'#',],
 	 * 								  'Mobil'=>
 	 * 									['C++'=>'#','Java'=>'#','C#'=>'#',],
 	 * 								], 'lg');
 	 */
 	static function split_button($label, $item_groups, $button_type = 'default'){
 		
 		$output = "<div class=\"btn-group\">
 					<button type=\"button\" class=\"btn btn-$button_type dropdown-toggle\">$label</button>
 					<button type=\"button\" class=\"btn btn-$button_type dropdown-toggle\" data-toggle=\"dropdown\">
 					<span class=\"caret\"></span>
 					<span class=\"sr-only\">Toggle Dropdown</span>
 					</button>
 					<ul class=\"dropdown-menu\" role=\"menu\">";

 					
 		foreach($item_groups as $title => $item){
 			
 			if($title != '')
 				$output .= "<li role=\"presentation\" class=\"dropdown-header\">$title</li>";
 			
 			foreach($item as $label=>$link){
 					
 				$output .= "<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"$link\">
 				$label
 				</a>
 				</li>";
 				
 			}
			$output .= "<li role=\"presentation\" class=\"divider\"></li>";

 		}
 		
 		$output .= "</ul></div>";
 		
 		return $output;
 	}
 }
 ?>