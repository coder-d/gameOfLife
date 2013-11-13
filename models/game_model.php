<?php

class Game_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
/**
 * This function generates an HTML Table representation of the 2D World array.
 * @param Array $w: 2D Array of the World to display
 * @return String $html
 */
public function display_world($w) {
	# Local Variables
	$html = "";
	$contents = "";
	
	# Generate Cells and Rows based on the World 2D Array
	foreach ($w as $row) {
		$contents .= "<tr>";
		foreach ($row as $cell) {
			$contents .= ($cell)? "<td style='background-color:black'>&nbsp;</td>" : "<td>&nbsp;</td>";
		}
		$contents .= "</tr>\n";
	}
	
	# Compile the HTML Table representation
	$html = "
		<table cellpadding='0' cellspacing='0' border='0'>
			{$contents}
		</table>";
	
	# Return the HTML Table representation of the World
	return $html;
}


/**
 * Calculates the next 'tick' or iteration of the World's evolution.
 * @param Array $w: 2D Array of the World to evolve
 * @return Array $a: The next step in the World's evolution
 */
public function calc_new_world($w) {
	# Global Variables
	global $size, $rule1, $rule2;
	
	# Local Variables
	$i = 0;
	$j = 0;
	$a = array();
	
	# Cycle through cells (i = row | j = column)
	for ($i=0; $i < $size; $i++) {
		for ($j = 0; $j < $size; $j++) {
			# Count how many neighbours the current cell has
			
			!empty($w[$j - 1][$i + 0]) ? $one=$w[$j - 1][$i + 0] : $one=null;
			
			!empty($w[$j + 1][$i + 0])? $two=$w[$j + 1][$i + 0] :$two=null;
			
			!empty($w[$j + 0][$i - 1])? $three=$w[$j + 0][$i - 1] : $three=null;
			
			!empty($w[$j + 0][$i + 1])? $four=$w[$j + 0][$i + 1]: $four=null;
			
			!empty($w[$j - 1][$i - 1])? $five=$w[$j - 1][$i - 1] : $five=null;
			
			!empty($w[$j - 1][$i + 1])? $six=$w[$j - 1][$i + 1] : $six=null;
			
			!empty($w[$j + 1][$i - 1])? $seven=$w[$j + 1][$i - 1]:$seven=null;
			
			!empty($w[$j + 1][$i + 1])? $eight=$w[$j + 1][$i + 1]: $eight=null;

			
			$neighbours	= $one+$two+$three+$four+$five+$six+$seven+$eight;
			
			# Rule 1: If the current cell has $rule1 number of neighbours, and is alive, it will stay alive
			# Rule 2: If the current cell has $rule2 number of neighbours, and is dead, it will become alive
			if ($neighbours == $rule1 || $neighbours == $rule2) {
				$a[$j][$i] = 1;
			}
			# Rule 3: If it has more neighbours than $rule2 or less neighbours than $rule1, it will die 
			else {
				$a[$j][$i] = 0;
			}
		}
	}
	
	# Return the new World
	return $a;
}

/**
 * Generate an initial, random chaos as a starting state for the world.
 */
public function start_world() {
	# Global Variables
	global $world, $size, $rand_sample, $rand_alpha;
	
	# CInitialize the World 2D array with cells that are randomly dead or alive
	for ($x = 0; $x < $size; $x++) {
		for ($y = 0; $y < $size; $y++) {
			$world[$x][$y] = (rand(0,$rand_sample) > $rand_alpha)? 1 : 0;
		}
	}
}

}
?>