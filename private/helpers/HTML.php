<?php

/**
 * Helper class for displaying html elements. It uses the twitter bootstrap css
 * and javascript frameworks to formate the displayed content. So make sure you
 * include both bootstrap frameworks to effectively use this helper class.
 */
 class HTML{
 	
 	/**
 	 * Keeps track of the lattest form's layout
 	 * @var string
 	 * @access private
 	 */
 	private static $form_layout;
 	
 	/**
 	 * <p>
 	 * Displays bootstrap enhanced ordered list, unordered list, unstyled list,
 	 * inline list, definition list and horizontal definition list.
 	 * These are the list of type options :
 	 * </p>
 	 * <ol>
 	 * <li>ordered<l/i>
 	 * <li>unordered<l/i>
 	 * <li>unstyled<l/i>
 	 * <li>inline<l/i>
 	 * <li>definition<l/i>
 	 * <li>horizontal-definition<l/i>
 	 * <o/>
 	 *
 	 * <h4>Examples</h4>
 	 * HTML::lists(['item1', 'item2', 'item3'], 'ordered');//Draws an orders list
 	 * HTML::lists(['def1'=>'item1', 'def2'=>'item2'], definition);//Draws a definition list
 	 *
 	 * If no second argument is supplied or a wrong list-type is supplied, the
 	 * list defaults to an unstyled list.
 	 * @param array $items The list items.
 	 * @param string $type The type of list to display.
 	 */
	static function lists($items, $type = 'unstyled'){
		
		$list = "";
		if(!is_array($items)) throw new Exception("HTML::list first argument must be an array!");
		
		switch($type){
			
			case 'ordered':
				$list .= '<ol>';
				
				foreach($items as $value)
					$list .= "<li>$value</li>";
				
				$list .= '</ol>';
				break;
				
			case 'unordered':
				$list .= '<ul>';
				
				foreach($items as $value)
					$list .= "<li>$value</li>";
				
				$list .= '</ul>';
				break;
				
			case 'unstyled':
				$list .= "<ul class=\"list-unstyled\" >";
				
				foreach($items as $value)
					$list .= "<li>$value</li>";
				
				$list .= '</ul>';
				break;
				
			case 'inline':
				$list .= "<ul class=\"list-inline\" >";
				
				foreach($items as $value)
					$list .= "<li>$value</li>";
				
				$list .= '</ul>';
				break;
				
			case 'definition':
				$list .= "<dl>";
				
				foreach($items as $key => $value)
					$list .= "<dt>$key</dt><dd>$value</dd>";
				
				$list .= '</dl>';
				break;
				
			case 'horizontal-definition':
				$list .= "<dl class=\"dl-horizontal\" >";
				
				foreach($items as $key => $value)
					$list .= "<dt>$key</dt><dd>$value</dd>";
				
				$list .= '</dl>';
				break;
				
			default :
				$list .= "<ul class=\"list-unstyled\" >";
				
				foreach($items as $value)
					$list .= "<li>$value</li>";
				
				$list .= '</ul>';
				
		}
		
		echo $list;
	}
	
	/**
	 * <p>Displays parsed array of data in table.This is the list of table
	 * types:</p>
	 * <ul>
	 * <li>striped</li>
	 * <li>bordered</li>
	 * <li>hover</li>
	 * <li>condensed</li>
	 * </ul>
	 * <p>This is the list of contextual classes that can be parsed to rows</p>
	 * <ul>
	 * <li>active</li>
	 * <li>success</li>
	 * <li>warning</li>
	 * <li>danger</li>
	 * </ul>
	 * <h4>Exmaple</h4>
	 *
	 * $rows[] = ['data1', 'data2', 'data3'];
	 * $rows['success'] = ['data3', 'data4', 'data5'];
	 * $rows['active'] = ['data6', 'data7', 'data8'];
	 * $rows[] = ['data9', 'data10', 'data11'];
	 *
	 * $header = ['header1','header2','header3'];
	 *
	 * $caption = "Table Display";
	 *
	 * HTML::table($rows, $header, $caption, 'hover bordered');
	 *
	 * @param array $rows Array of row data array.
	 * @param array $headers table headers to display
	 * @param string $caption Table caption to display
	 * @param string $type Type of table to display. Leave out for basic table.
	 */
	 static function table($rows, $headers, $caption, $type = "basic"){
	 	
	 	$table = "";
	 	
	 	$t_classes = ['stripped'=>'table-striped',
	 					'bordered'=>'table-bordered',
	 					'hover'=>'table-hover',
	 					'condensed'=>'table-condensed'
	 				 ];
	 				 
	 	$class = "table";
	 	
	 	$types = explode(' ', $type);
	 	
	 	foreach($types as $t){
	 		
	 		if(!isset($t_classes[$t]))
	 			continue;
	 		
	 		$class .= " ".$t_classes[$t];
	 	}
	 	
	 	$table .= "<table class=\"$class\">";
	 			
	 			$table .= "<caption>$caption</caption>";
	 			
	 			$table .= "<thead><tr>";
	 			
	 			foreach($headers as $value)
	 				$table .= "<th>$value</th>";
	 				
	 			$table .= "</tr></thead>";
	 			
	 			//Arranging the body of the table
	 			$table .= "<tbody>";
	 			
	 			foreach($rows as $context => $row){
	 				
	 				$contx = ['active', 'success' ,'warning' ,'danger'];
	 				
	 				if(in_array($context, $contx))
	 					$table .= "<tr class=\"$context\">";
	 				else
	 					$table .= "<tr>";
	 					
	 				foreach($row as $data){
	 					$table .="<td>$data</td>";
	 				}
	 				
	 				$table .= "</tr>";
	 			}
	 			
	 			$table .= "</tbody>";
	 			
	 			$table .= "</table>";
	 	
	 	echo $table;
	 }
	 
	 /**
	  * <p>Responsible for displaying html form begining tag layous. The different
	  * layouts accepted are :</p>
	  * <ul>
	  * <li>vertical</li>
	  * <li>horizontal</li>
	  * <li>inline</li>
	  * <ul>
	  * <h4>Example:<h4>
	  *
	  * HTML::form_begin('profile','','','inline');
	  *	@param string $layout The layout to use for the form
	  * @param string $name Name/id of the form
	  */
	  static function form_begin($name, $methode='post', $action ="",$layout = ""){
	  	
	  	self::$form_layout = $layout;
	  	
	  	$class = "";
	  	if($layout != "")
	  		$class = " class=\"form-$layout\"";
	  	
	  	echo "<form name=\"$name\" id=\"$name\" methode=\"$methode\" action=\"$action\" role=\"form\"$class><div class=\"form-group\">";
	  }
	  
	  /**
	   * <p>Closes the begining form tags opened by <i>HTML::form_begin()</i></p>
	   */
	  static function form_end(){
	  	
	  	self::$form_layout='';
	  	echo "</div></form>";
	  }
	  
	  /**
	   * <p>Displays text input form control</p>
	   * <h4>Example:<h4>
	   * HTML::text_field('first-name','First Name', ['placeholder'=>'Enter first name']);
	   * @param string $name Name and id of the text input control.
	   * @param array $attributes Attribute/Value pairs to add to the input.
	   * @param string $label Label of the text field.
	   */
	   static function text_field($name, $label = '', $attributes =[]){
		
		echo (self::$form_layout=='horizontal')?'<div class="col-md-12">':'';
		
		if($label != '')
			echo "<label for=\"$name\"",
			(self::$form_layout=='horizontal')?' class="control-label"':'',
			">$label</label>";
			
		echo "<input type=\"text\" id=\"$name\" name=\"$name\"";
		
		foreach($attributes as $key=>$value)
			echo " $key=\"$value\"";
		
		echo " />";
		
		echo (self::$form_layout=='horizontal')?'</div>':'';
	   }
	   
	   /**
	   * <p>Displays text-area form control</p>
	   * <h4>Example:<h4>
	   * HTML::text_area('Comments','comments', ['placeholder'=>'Enter first name']);
	   * @param string $name Name and id of the-area control.
	   * @param array $attributes Attribute/Value pairs to add to the text-area.
	   * @param string $label Label of the text-area.
	   */
	   static function text_area($name, $label = '', $attributes =[]){
		
		echo (self::$form_layout=='horizontal')?'<div class="col-md-12">':'';
		
		if($label != '')
			echo "<label for=\"$name\"",
			(self::$form_layout=='horizontal')?' class="control-label"':'',
			">$label</label>";
			
		echo "<textarea id=\"$name\" name=\"$name\"";
		
		foreach($attributes as $key=>$value)
			echo " $key=\"$value\"";
		
		echo " ></textarea>";
		
		echo (self::$form_layout=='horizontal')?'</div>':'';
	   }
	   
	   /**
	   * <p>Displays a group of checkboxes form control</p>
	   * <h4>Example:<h4>
	   * HTML::checkbox('first-name','First Name', ['1'=>'Option1','2'=>'Option2']);
	   * @param string $name Name and id of the text input control.
	   * @param array $boxes Attribute/Value pairs to add to the input.
	   * @param string $label Label of the text field.
	   * @param string $layout 'checkbox' or 'checkbox-inline'.
	   * @param int $check Count of the checkbox to mark check. '0' mean no check.
	   */
	   static function checkbox($name,$boxes =[], $check = 0, $layout = 'checkbox'){
	   	
	   	$count = 0;
	   	
	   	if(strtolower($layout) != 'checkbox') echo "<div>";
		
		foreach($boxes as $key=>$value){
			
			if(strtolower($layout) == 'checkbox') echo "<div class=\"checkbox\">";
			
			echo (strtolower($layout) != 'checkbox')?"<label class=\"$layout\">":"<label>";
			
			echo "<input type=\"checkbox\" name=\"$name\" id=\"$name$count\" value=\"$key\" ";
			
			if(($count + 1) == $check) echo "checked";
			
			echo ">$value</label>";
			
			if(strtolower($layout) == 'checkbox') echo "</div>";
			
			$count++;
		}
		
		if(strtolower($layout) != 'checkbox') echo "</div>";
		
	  }
	  
	
	/**
	 * <p>Displays an html select form control</p>
	 * <h4>Example:</h4>
	 *
	 * $elements = ['1'=>'Option1','2'=>'Option2','3'=>'Option3','4'=>'Option4'];
	 * HTML::select('sel-opts', 'Select an option', $elements, 3, true);
	 *
	 * @param string $name Name of the select control.
	 * @param string $label The label of this control
	 * @param array $elements value/display option pairs.
	 * @param int $sel count of option to be selected by default.
	 * @param bool mult Multiple selection?
	 */
	 public static function select($name, $label, $elements, $sel =0, $mult = false){
	 	
	 	$count = 1;
	 	
	 	if($label != '') echo "<label for=\"$name\">$label</label>";
	 	echo "<select class=\"form-control\" ", $mult?'multiple':''," >";
	 	
	 		foreach($elements as $key=>$value){
	 			
	 			$s = ($sel == $count)?'selected':'';
	 			
	 			echo "<option value=\"$key\" $s>$value</option>";
	 			
	 			$count++;
	 		}
	 	echo "</select>";
	 }
	 
	 /**
	  * <p>Displays a simple text as a form control</p>
	  * <h4>Example:</h4>
	  *
	  * HTML::text('email','mosbesong@gmail.com','Email');
	  * @param string $name Name and id of the text input control.
	  * @param string $text The text to be displayed.
	  * @param array $attributes Attribute/Value pairs to add to the input.
	  * @param string $label Label of the text field.
	  */
	  static function text($name, $text, $label = '', $attributes =[]){
	
		echo (self::$form_layout=='horizontal')?'<div class="col-md-12">':'';
		
		if($label != '')
			echo "<label for=\"$name\"",
			(self::$form_layout=='horizontal')?' class="control-label"':'',
			">$label</label>";
			
		echo "<p class=\"form-control-static\" id=\"$name\" name=\"$name\"";
		
		foreach($attributes as $key=>$value)
			echo " $key=\"$value\"";
		
		echo " >$text</p>";
		
		echo (self::$form_layout=='horizontal')?'</div>':'';
	  	
	  }
	  
	/**
	 * <p>Displays an html button.</p>
	 * <h4>Example : </h4>
	 *
	 * HTML::button('Start',['class'=>'btn btn-primary active btn-sm']);
	 * HTML::button('Start',['class'=>'btn btn-danger, 'disabled'=>'disabled']);
	 * HTML::button('Start',['class'=>'btn btn-sucess btn-block']);
	 * HTML::button('Start',['class'=>'btn btn-default]);
	 *
	 * @param string $label The label of the button.
	 * @param array $attributes Attribute/value pairs of the button tag
	 */
	static function button($label,$attributes=[]){
		
		echo "<button type=\"button\"";
		
		foreach($attributes as $key=>$value)
			echo " $key=\"$value\"";
		
		echo ">$label</button>";
	}
	
	/**
	 * <P>Displays html image tag</p>
	 * <h4>Example</h4>
	 * HTML::image('some.jpg',['class'=>'img-rounded', 'with'=>300]);
	 * HTML::image('some.jpg',['class'=>'img-circle', 'with'=>300]);
	 * HTML::image('some.jpg',['class'=>'img-thumbnail', 'with'=>300]);
	 * @param string source Source of the image to display.
	 * @param array $attributes Attribute/value pairs of the tag
	 */
	static function image($source, $attributes){
		
		echo "<img src=$source ";
		
		foreach($attributes as $key=>$value)
			echo " $key=\"$value\"";
		
		echo ">";
		
	}
	  
 }

?>