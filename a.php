<?php 

	function js($x='')
	{
		$a = '';
		for ($i=0; $i <count($x) ; $i++) { 
			$a .= 'assets/'.$x[$i]."</br>";

		}
		return $a;
	}

	echo js(array("a","c","asdas.js"));
 ?>