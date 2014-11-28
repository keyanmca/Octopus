<?php
/** Initialises the application */
final class Application{
	
	/**
	 * @var arrat
	 */
	 var $configs;
	 
	 const DEFAULT_TEMPLATE = 'index';
	 
	 const DEFAULT_LAYOUT = 'index';
	
	public function __construct($root_dir){
		
		$this -> configs = parse_ini_file($root_dir.'private/config/config.ini');
		$this -> configs['root_dir'] = $root_dir;
		
		session_start();
		
		$this -> run_page();
		
		foreach($_GET as $value){
			
			$value = htmlentities($value);
			$value = htmlspecialchars($value);
		}
		
		foreach($_POST as $value){
			
			$value = htmlentities($value);
			$value = htmlspecialchars($value);
		}
	}
	
	/**
	 * Figures out the page template and layout to launch.
	 * @return string The page script.
	 */
	 private function run_page(){
	 	
	 	$page = self::DEFAULT_LAYOUT;
	 	
	 	if(isset($_GET['page']) && !ereg('^[a-z]+[0-9]*$', $_GET['page']))
	 		exit("Bad page Request!");
	 	
	 	if(isset($_GET['page']))
	 		$page = $_GET['page'];
	 		
	 		
	 	if(!$this -> has_layout($page))
	 		exit("$page is not a valide page !");
	 			
	 	if($this -> has_script($page))
	 		include $this -> get_script($page);
	 				
	 	$layout = "";
	 			
	 	//Execute the page layout and keep its content;
	 	ob_start();
	 	require($this -> configs['root_dir'].$this -> configs['layouts_dir'].$page.'.phtml');
	 	$layout = ob_get_clean();
	 	
	 	include $this -> get_template($page);
	 }
	 
	 /**
	  * Returns true if the given script exist. False otherwise.
	  * @return bool
	  * @param string $page The name of the script.
	  */
	 private function has_script($page){
	 	
	 	if(!file_exists($this -> configs['root_dir'].$this -> configs['scripts_dir'].$page.'.php'))
	 		return false;
	 	return true;
	 }
	 
	 /**
	  * Returns the path to the given script
	  * @return string
	  * @param string $page the name of the script.
	  */
	 private function get_script($page){
	 	
	 	return $this -> configs['root_dir'].$this -> configs['scripts_dir'].$page.'.php';
	 }
	 
	 /**
	  * Returns true if the given layout exist. False otherwise.
	  * @return bool
	  * @param string $page The name of the layout.
	  */
	 private function has_layout($page){
	 	
	 	if(!file_exists($this -> configs['root_dir'].$this -> configs['layouts_dir'].$page.'.phtml'))
	 		return false;
	 	return true;
	 }
	 
	 /**
	  * Returns the path to the given template
	  * @return string
	  * @param string $page The name of the template.
	  */
	 private function get_template($page){
	 	
	 	return $this -> configs['root_dir'].$this -> configs['templates_dir'].$page.'.phtml';
	 }
	
	
	
	private function __distruct(){}
	
	
}
?>