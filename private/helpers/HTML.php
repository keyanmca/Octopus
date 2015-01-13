<?php

//private/helpers/HTML.php
/**
 * Helper class for displaying html elements. It uses the twitter bootstrap css
 * and javascript frameworks to formate the displayed content. So make sure you
 * include both bootstrap frameworks to effectively use this helper class.
 */
class HTML {

    /**
     * Keeps track of the lattest form's layout
     * @var string
     * @access private
     */
    private static $form_layout;

    /**
     * <p>
     * Returns bootstrap enhanced ordered list, unordered list, unstyled list,
     * inline list, definition list and horizontal definition list.
     * These are the list of type options :
     * </p>
     * <ol>
     * <li>ordered</li>
     * <li>unordered</li>
     * <li>unstyled</li>
     * <li>inline</li>
     * <li>definition</li>
     * <li>breadcrumb</li>
     * <li>pagination</li>
     * <li>pager</li>
     * <li>horizontal-definition</li>
     * </ol>
     *
     * <h4>Examples</h4>
     * echo HTML::lists(['item1', 'item2', 'item3'], 'ordered');//Draws an orders list
     * echo HTML::lists(['def1'=>'item1', 'def2'=>'item2'], definition);//Draws a definition list
     * echo  HTML::lists(['item1'=>['#','active'], 'item2'=>['#','disabled'], 'item3'=>['#','']], 'pagination');
     * echo  HTML::lists(['&larr Older;'=>['#','previous'], 'Newer &rarr;'=>['#','next']], 'pager');
     *
     * If no second argument is supplied or a wrong list-type is supplied, the
     * list defaults to an unstyled list.
     * @param array $items The list items.
     * @param string $type The type of list to display.
     * @param array $list_attribs name/value pairs of list attributes
     * @return string The html list to be drawn.
     */
    static function lists($items, $type = 'unstyled', $list_attribs = []) {

        $list = "";
        if (!is_array($items))
            throw new Exception("HTML::list first argument must be an array!");

        $attribs = "";

        foreach ($list_attribs as $key => $value)
            $attribs .= "$key=\"$value\" ";

        switch ($type) {

            case 'ordered':
                $list .= "<ol $attribs>";

                foreach ($items as $value)
                    $list .= "<li>$value</li>";

                $list .= '</ol>';
                break;
                
            case 'breadcrumb':
                $list .= "<ol class='breadcrumb' $attribs>";

                foreach ($items as $key=>$value)
                    $list .= "<li><a href='$value'>$key</li>";

                $list .= '</ol>';
                break;

            case 'pagination':
                $list .= "<ul class='pagination pagination-sm' $attribs>";

                foreach ($items as $key=>$value)
                    $list .= "<li class='".$value[1]."'><a href='".$value[0]."'>$key</li>";

                $list .= '</ul>';
                break;
                
            case 'pager':
                $list .= "<ul class='pager' $attribs>";

                foreach ($items as $key=>$value)
                    $list .= "<li class='".$value[1]."'><a href='".$value[0]."'>$key</li>";

                $list .= '</ul>';
                break;
                
            case 'unordered':
                $list .= "<ul $attribs>";

                foreach ($items as $value)
                    $list .= "<li>$value</li>";

                $list .= '</ul>';
                break;

            case 'unstyled':
                $list .= "<ul class=\"list-unstyled\"  $attribs>";

                foreach ($items as $value)
                    $list .= "<li>$value</li>";

                $list .= '</ul>';
                break;

            case 'inline':
                $list .= "<ul class=\"list-inline\"  $attribs>";

                foreach ($items as $value)
                    $list .= "<li>$value</li>";

                $list .= '</ul>';
                break;

            case 'definition':
                $list .= "<dl  $attribes>";

                foreach ($items as $key => $value)
                    $list .= "<dt>$key</dt><dd>$value</dd>";

                $list .= '</dl>';
                break;

            case 'horizontal-definition':
                $list .= "<dl class=\"dl-horizontal\"  $attribs>";

                foreach ($items as $key => $value)
                    $list .= "<dt>$key</dt><dd>$value</dd>";

                $list .= '</dl>';
                break;

            default :
                $list .= "<ul class=\"list-unstyled\"  $attribs>";

                foreach ($items as $value)
                    $list .= "<li>$value</li>";

                $list .= '</ul>';
        }

        return $list;
    }

    /**
     * <p>Returns an Html table.This is the list of table
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
    static function table($rows, $headers, $caption, $type = "basic") {

        $table = "";

        $t_classes = ['stripped' => 'table-striped',
            'bordered' => 'table-bordered',
            'hover' => 'table-hover',
            'condensed' => 'table-condensed'
        ];

        $class = "table";

        $types = explode(' ', $type);

        foreach ($types as $t) {

            if (!isset($t_classes[$t]))
                continue;

            $class .= " " . $t_classes[$t];
        }

        $table .= "<table class=\"$class\">";

        $table .= "<caption>$caption</caption>";

        $table .= "<thead><tr>";

        foreach ($headers as $value)
            $table .= "<th>$value</th>";

        $table .= "</tr></thead>";

        //Arranging the body of the table
        $table .= "<tbody>";

        foreach ($rows as $context => $row) {

            $contx = ['active', 'success', 'warning', 'danger'];

            if (in_array($context, $contx))
                $table .= "<tr class=\"$context\">";
            else
                $table .= "<tr>";

            foreach ($row as $data) {
                $table .="<td>$data</td>";
            }

            $table .= "</tr>";
        }

        $table .= "</tbody>";

        $table .= "</table>";

        return $table;
    }

    /**
     * <p>returns the html form begining tag layous. The different
     * layouts accepted are :</p>
     * <ul>
     * <li>vertical</li>
     * <li>horizontal</li>
     * <li>inline</li>
     * </ul>
     * <h4>Example:<h4>
     *
     * HTML::form_begin('profile','','','inline');
     * 	@param string $layout The layout to use for the form
     * @param string $name Name/id of the form
     */
    static function form_begin($name, $methode = 'post', $action = "", $layout = "") {

        self::$form_layout = $layout;

        $class = "";
        if ($layout != "")
            $class = " class=\"form-$layout\"";

        return "<form name=\"$name\" id=\"$name\" methode=\"$methode\" action=\"$action\" role=\"form\"$class><div class=\"form-group\">";
    }

    /**
     * <p>Returns the begining form tags opened by <i>HTML::form_begin()</i></p>
     */
    static function form_end() {

        self::$form_layout = '';
        return "</div></form>";
    }

    /**
     * <p>Returna an html text input form control</p>
     * <h4>Example:</h4>
     * HTML::text_field('first-name','First Name', ['placeholder'=>'Enter first name']);
     * @param string $name Name and id of the text input control.
     * @param array $attributes Attribute/Value pairs to add to the input.
     * @param string $label Label of the text field.
     */
    static function text_field($name, $label = '', $attributes = []) {

        $input = (self::$form_layout == 'horizontal') ? '<div class="col-md-12">' : '';

        if ($label != '') {
            $input .= "<label for=\"$name\"";
            $input .= (self::$form_layout == 'horizontal') ? ' class="control-label"' : '';
            $input .= ">$label</label>";
        }

        $input .= "<input type=\"text\" id=\"$name\" name=\"$name\"";

        foreach ($attributes as $key => $value)
            $input .= " $key=\"$value\"";

        $input .= " />";

        $input .= (self::$form_layout == 'horizontal') ? '</div>' : '';

        return $input;
    }

    /**
     * <p>Returns password input form control</p>
     * <h4>Example:</h4>
     * HTML::text_field('first-name','First Name', ['placeholder'=>'Enter first name']);
     * @param string $name Name and id of the password input control.
     * @param array $attributes Attribute/Value pairs to add to the input.
     * @param string $label Label of the password field.
     */
    static function password_field($name, $label = '', $attributes = []) {

        $input = (self::$form_layout == 'horizontal') ? '<div class="col-md-12">' : '';

        if ($label != '') {
            $input .= "<label for=\"$name\"";
            $input .= (self::$form_layout == 'horizontal') ? ' class="control-label"' : '';
            $input .= ">$label</label>";
        }

        $input .= "<input type=\"password\" id=\"$name\" name=\"$name\"";

        foreach ($attributes as $key => $value)
            $input .= " $key=\"$value\"";

        $input .= " />";

        $input .= (self::$form_layout == 'horizontal') ? '</div>' : '';

        return $input;
    }

    /**
     * <p>Returns text-area form control</p>
     * <h4>Example:</h4>
     * HTML::text_area('Comments','comments', ['placeholder'=>'Enter first name']);
     * @param string $name Name and id of the-area control.
     * @param array $attributes Attribute/Value pairs to add to the text-area.
     * @param string $label Label of the text-area.
     */
    static function text_area($name, $label = '', $attributes = []) {

        $area = (self::$form_layout == 'horizontal') ? '<div class="col-md-12">' : '';

        if ($label != '') {
            $area .= "<label for=\"$name\"";
            $area .= (self::$form_layout == 'horizontal') ? ' class="control-label"' : '';
            $area .= ">$label</label>";
        }

        $area .= "<textarea id=\"$name\" name=\"$name\"";

        foreach ($attributes as $key => $value)
            $area .= " $key=\"$value\"";

        $area .= " ></textarea>";

        $area .= (self::$form_layout == 'horizontal') ? '</div>' : '';

        return $area;
    }

    /**
     * <p>Returns a group of checkboxes form control</p>
     * <h4>Example:</h4>
     * HTML::checkbox('first-name','First Name', ['1'=>'Option1','2'=>'Option2']);
     * @param string $name Name and id of the text input control.
     * @param array $boxes Attribute/Value pairs to add to the input.
     * @param string $label Label of the text field.
     * @param string $layout 'checkbox' or 'checkbox-inline'.
     * @param int $check Count of the checkbox to mark check. '0' mean no check.
     */
    static function checkbox($name, $boxes = [], $check = 0, $layout = 'checkbox') {

        $count = 0;

        $box = "";

        if (strtolower($layout) != 'checkbox')
            $box .= "<div>";

        foreach ($boxes as $key => $value) {

            if (strtolower($layout) == 'checkbox')
                $box .= "<div class=\"checkbox\">";

            $box .= (strtolower($layout) != 'checkbox') ? "<label class=\"$layout\">" : "<label>";

            $box .= "<input type=\"checkbox\" name=\"$name\" id=\"$name$count\" value=\"$key\" ";

            if (($count + 1) == $check)
                $box .= "checked";

            echo ">$value</label>";

            if (strtolower($layout) == 'checkbox')
                $box .= "</div>";

            $count++;
        }

        if (strtolower($layout) != 'checkbox')
            $box .= "</div>";

        return $box;
    }

    /**
     * <p>Returns an html select form control</p>
     * <h4>Example:</h4>
     *
     * $elements = ['1'=>'Option1','2'=>'Option2','3'=>'Option3','4'=>'Option4'];
     * HTML::select('sel-opts', 'Select an option', $elements, 3, true);
     *
     * @param string $name Name of the select control.
     * @param string $label The label of this control
     * @param array $elements value/display option pairs.
     * @param mixt $sel value of option to be selected by default.
     * @param array $attribs Associative array of select tag key/value pairs.
     * @param bool mult Multiple selection?
     */
    public static function select($name, $label, $elements, $sel = null, $attribs=[], $mult = false) {

        $select = "";
        
        //prepare attributes
        $attributes = " ";
        foreach($attribs as $k=>$v){
        	$attributes .= " $k='$v' ";
        }
        $attributes .= " ";

        if ($label != '')
            $select .= "<label for=\"$name\">$label</label>";
        $select .= "<select class=\"form-control\" name=\"$name\" id=\"$name\" $attributes";
        $select .= $mult ? 'multiple' : '';
        $select .= " >";

        foreach ($elements as $key => $value) {

            $s = ($sel != null && $sel == $key) ? 'selected' : '';

            $select .= "<option value=\"$key\" $s>$value</option>";
        }
        $select .= "</select>";

        return $select;
    }

    /**
     * <p>Returns a simple text as a form control</p>
     * <h4>Example:</h4>
     *
     * HTML::text('email','mosbesong@gmail.com','Email');
     * @param string $name Name and id of the text input control.
     * @param string $text The text to be displayed.
     * @param array $attributes Attribute/Value pairs to add to the input.
     * @param string $label Label of the text field.
     */
    static function text($name, $text, $label = '', $attributes = []) {

        $input = (self::$form_layout == 'horizontal') ? '<div class="col-md-12">' : '';

        if ($label != '') {
            $input .= "<label for=\"$name\"";
            $input .= (self::$form_layout == 'horizontal') ? ' class="control-label"' : '';
            $input .= ">$label</label>";
        }

        $input .= "<p class=\"form-control-static\" id=\"$name\" name=\"$name\"";

        foreach ($attributes as $key => $value)
            $input .= " $key=\"$value\"";

        $input .= " >$text</p>";

        $input .= (self::$form_layout == 'horizontal') ? '</div>' : '';

        return $input;
    }

    /**
     * <p>Returns an html button.</p>
     * <h4>Example : </h4>
     *
     * HTML::button('Start',['class'=>'btn btn-primary active btn-sm']);
     * HTML::button('Start',['class'=>'btn btn-danger, 'disabled'=>'disabled']);
     * HTML::button('Start',['class'=>'btn btn-sucess btn-block']);
     * HTML::button('Start',['class'=>'btn btn-default']);
     *
     * @param string $label The label of the button.
     * @param array $attributes Attribute/value pairs of the button tag
     */
    static function button($label, $attributes = [], $glyphicon = "") {

        $button = "";

        $glif = "";
        if ($glyphicon != "")
            $glif = "<span class=\"glyphicon $glyphicon\"></span>";

        $button .= "<button type=\"button\"";

        foreach ($attributes as $key => $value)
            $button .= " $key=\"$value\"";

        $button .= ">{$glif}{$label}</button>";

        return $button;
    }

    /**
     * <P>Returns html image tag</p>
     * <h4>Example</h4>
     * HTML::image('some.jpg',['class'=>'img-rounded', 'with'=>300]);
     * HTML::image('some.jpg',['class'=>'img-circle', 'with'=>300]);
     * HTML::image('some.jpg',['class'=>'img-thumbnail', 'with'=>300]);
     * @param string source Source of the image to display.
     * @param array $attributes Attribute/value pairs of the tag
     */
    static function image($source, $attributes) {

        $img = "<img src=$source ";

        foreach ($attributes as $key => $value)
            $img .= " $key=\"$value\"";

        $img .= ">";
    }

    /**
     * <p>Returns an arbitrary input form controls</p>
     * <h4>Example:</h4>
     * HTML::text_field('first-name','First Name', ['placeholder'=>'Enter first name']);
     * @param string $type Value of the type attribute of the input control
     * @param string $name Name and id of the text input control.
     * @param array $attributes Attribute/Value pairs to add to the input.
     * @param string $label Label of the text field.
     */
    static function input($type, $name, $label = '', $attributes = []) {

        $input = (self::$form_layout == 'horizontal') ? '<div class="col-md-12">' : '';

        if ($label != '') {
            $input .= "<label for=\"$name\"";
            $input .= (self::$form_layout == 'horizontal') ? ' class="control-label"' : '';
            $input .= ">$label</label>";
        }

        $input .= "<input type=\"$type\" id=\"$name\" name=\"$name\"";

        foreach ($attributes as $key => $value)
            $input .= " $key=\"$value\"";

        $input .= " />";

        $input .= (self::$form_layout == 'horizontal') ? '</div>' : '';

        return $input;
    }
    
    /**
     * <p>Returns the HTML code for displaying a bootstrap enhanced label.
     * Some types are :</p>
     * <ul>
     * <li>default</li>
     * <li>primary</li>
     * <li>success</li>
     * <li>info</li>
     * <li>warning</li>
     * <li>danger</li>
     * </ul>
     * <h4>Example :</h4>
     * echo HTML::label('Default Label','default');
     * @param string $text The text of the label
     * @param string $type Type of label
     * @return string
     */
    static function label($text,$type='default'){
    	
    	return "<span class='label label-$type'>$text</span>";
    }
    
    /**
     * <p>Returns the HTML code for displaying a bootstrap enhanced badge</p>.
     * <h4>Example :</h4>
     * HTML::badge("50","left");
     * @param string $text The badge text;
     * @param string $direction Pull to the left or right. Defaults to none.
     * @return string.
     */
    static function badge($text, $direction=""){
    	
    	$class = ($direction=="")?"":"pull-$direction";
    	return "<span class='badge $class'>$text</span>";
    }
    
    /**
     * <p>Return the HTML code for displaying a bootstrap enhanced thumbnail</p>
     * <h4>Example :</h4>
     * echo HTML::thumbnail('somePicture.jpg', '#','someText');
     * @param string $source The source URL of the image.
     * @param string $link The URL to link to associate the thumbnail to
     * @param string $text Altenative text to display on thumbnail.
     * @return string
     */
    static function thumbnail($source, $link='#', $text=''){
    	
    	return "<div class='col-sm-6 col-md-3'><a href='$link' class='thumbnail'><img src='$source' alt='$text'></a></div>";
    }

}

?>