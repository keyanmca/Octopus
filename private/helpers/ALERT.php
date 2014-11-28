<?php
//private/helpers/ALERT.php
/**
 * This class is responsible for displaying bootstrap enhanced alerts. be sure
 * to include the bootstrap css and javascript plugins in your html header.
 */
class ALERT{
	
	/**
	 * <p>Returns the HTML code used to display basic alerts.</p>
	 * <h4>Example :</h4>
	 * <pre><code>
	 * echo ALERT::basic('don't do this', 'danger');
	 * </code></pre>
	 *
	 * @param string $text The alert string
	 * @param string $context could be : success, info, warning, danger
	 * @return string
	 */
	static function basic($text,$context='danger'){
		
		return "<div class='alert alert-$context'>$text</div>";
	}
	
	/**
	 * <p>Returns the HTML code used to display dismissal alerts.</p>
	 * <h4>Example :</h4>
	 * <pre><code>
	 * echo ALERT::dismissal('Be careful', 'warning');
	 * </code></pre>
	 *
	 * @param string $text The alert string
	 * @param string $context could be : success, info, warning, danger
	 * @return string
	 */
	static function dismissal($text,$context='danger'){
		
		$alert = "<div class='alert alert-$context' alert-dismissable>";
		$alert .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>$text</div>";
		return $alert;
	}
	
	/**
	 * <p>Returns the HTML code used to display link alerts.</p>
	 * <h4>Example :</h4>
	 * <pre><code>
	 * echo ALERT::link('don\'t do this','#', 'danger');
	 * </code></pre>
	 *
	 * @param string $text The alert string
	 * @param string $context could be : success, info, warning, danger
	 * @return string
	 */
	static function link($text, $link='#', $context='danger'){
		
		$alert = "<div class='alert alert-$context'>";
		$alert .= "<a href='$link' class='alert-link'>$text</a></div>";
		return $alert;
	}
}
?>