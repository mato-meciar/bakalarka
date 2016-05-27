<?php
require_once dirname(dirname(__FILE__)) . "/models/DBtables/Project.php";
require_once dirname(dirname(__FILE__)) . "/models/DBtables/Group.php";

define("SKILL_MATCH", 4);
define("PREF_MATCH_1", 3);
define("PREF_MATCH_2", 7);
define("PREF_MATCH_3", 10);
define("PREF_MATCH_4", 25);
define("IMPORTANT_MATCH", 100);
define("TOURNAMENT_SIZE", 5);
define("GENERATIONS", 100);
define("POPULATION_SIZE", 50);
define("ALPHABET", 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-+,. ');

function remove_accents($string) {
	if (!preg_match('/[\x80-\xff]/', $string))
		return $string;

	$chars = array(
		// Decompositions for Latin-1 Supplement
		chr(195) . chr(128) => 'A', chr(195) . chr(129) => 'A',
		chr(195) . chr(130) => 'A', chr(195) . chr(131) => 'A',
		chr(195) . chr(132) => 'A', chr(195) . chr(133) => 'A',
		chr(195) . chr(135) => 'C', chr(195) . chr(136) => 'E',
		chr(195) . chr(137) => 'E', chr(195) . chr(138) => 'E',
		chr(195) . chr(139) => 'E', chr(195) . chr(140) => 'I',
		chr(195) . chr(141) => 'I', chr(195) . chr(142) => 'I',
		chr(195) . chr(143) => 'I', chr(195) . chr(145) => 'N',
		chr(195) . chr(146) => 'O', chr(195) . chr(147) => 'O',
		chr(195) . chr(148) => 'O', chr(195) . chr(149) => 'O',
		chr(195) . chr(150) => 'O', chr(195) . chr(153) => 'U',
		chr(195) . chr(154) => 'U', chr(195) . chr(155) => 'U',
		chr(195) . chr(156) => 'U', chr(195) . chr(157) => 'Y',
		chr(195) . chr(159) => 's', chr(195) . chr(160) => 'a',
		chr(195) . chr(161) => 'a', chr(195) . chr(162) => 'a',
		chr(195) . chr(163) => 'a', chr(195) . chr(164) => 'a',
		chr(195) . chr(165) => 'a', chr(195) . chr(167) => 'c',
		chr(195) . chr(168) => 'e', chr(195) . chr(169) => 'e',
		chr(195) . chr(170) => 'e', chr(195) . chr(171) => 'e',
		chr(195) . chr(172) => 'i', chr(195) . chr(173) => 'i',
		chr(195) . chr(174) => 'i', chr(195) . chr(175) => 'i',
		chr(195) . chr(177) => 'n', chr(195) . chr(178) => 'o',
		chr(195) . chr(179) => 'o', chr(195) . chr(180) => 'o',
		chr(195) . chr(181) => 'o', chr(195) . chr(182) => 'o',
		chr(195) . chr(182) => 'o', chr(195) . chr(185) => 'u',
		chr(195) . chr(186) => 'u', chr(195) . chr(187) => 'u',
		chr(195) . chr(188) => 'u', chr(195) . chr(189) => 'y',
		chr(195) . chr(191) => 'y',
		// Decompositions for Latin Extended-A
		chr(196) . chr(128) => 'A', chr(196) . chr(129) => 'a',
		chr(196) . chr(130) => 'A', chr(196) . chr(131) => 'a',
		chr(196) . chr(132) => 'A', chr(196) . chr(133) => 'a',
		chr(196) . chr(134) => 'C', chr(196) . chr(135) => 'c',
		chr(196) . chr(136) => 'C', chr(196) . chr(137) => 'c',
		chr(196) . chr(138) => 'C', chr(196) . chr(139) => 'c',
		chr(196) . chr(140) => 'C', chr(196) . chr(141) => 'c',
		chr(196) . chr(142) => 'D', chr(196) . chr(143) => 'd',
		chr(196) . chr(144) => 'D', chr(196) . chr(145) => 'd',
		chr(196) . chr(146) => 'E', chr(196) . chr(147) => 'e',
		chr(196) . chr(148) => 'E', chr(196) . chr(149) => 'e',
		chr(196) . chr(150) => 'E', chr(196) . chr(151) => 'e',
		chr(196) . chr(152) => 'E', chr(196) . chr(153) => 'e',
		chr(196) . chr(154) => 'E', chr(196) . chr(155) => 'e',
		chr(196) . chr(156) => 'G', chr(196) . chr(157) => 'g',
		chr(196) . chr(158) => 'G', chr(196) . chr(159) => 'g',
		chr(196) . chr(160) => 'G', chr(196) . chr(161) => 'g',
		chr(196) . chr(162) => 'G', chr(196) . chr(163) => 'g',
		chr(196) . chr(164) => 'H', chr(196) . chr(165) => 'h',
		chr(196) . chr(166) => 'H', chr(196) . chr(167) => 'h',
		chr(196) . chr(168) => 'I', chr(196) . chr(169) => 'i',
		chr(196) . chr(170) => 'I', chr(196) . chr(171) => 'i',
		chr(196) . chr(172) => 'I', chr(196) . chr(173) => 'i',
		chr(196) . chr(174) => 'I', chr(196) . chr(175) => 'i',
		chr(196) . chr(176) => 'I', chr(196) . chr(177) => 'i',
		chr(196) . chr(178) => 'IJ', chr(196) . chr(179) => 'ij',
		chr(196) . chr(180) => 'J', chr(196) . chr(181) => 'j',
		chr(196) . chr(182) => 'K', chr(196) . chr(183) => 'k',
		chr(196) . chr(184) => 'k', chr(196) . chr(185) => 'L',
		chr(196) . chr(186) => 'l', chr(196) . chr(187) => 'L',
		chr(196) . chr(188) => 'l', chr(196) . chr(189) => 'L',
		chr(196) . chr(190) => 'l', chr(196) . chr(191) => 'L',
		chr(197) . chr(128) => 'l', chr(197) . chr(129) => 'L',
		chr(197) . chr(130) => 'l', chr(197) . chr(131) => 'N',
		chr(197) . chr(132) => 'n', chr(197) . chr(133) => 'N',
		chr(197) . chr(134) => 'n', chr(197) . chr(135) => 'N',
		chr(197) . chr(136) => 'n', chr(197) . chr(137) => 'N',
		chr(197) . chr(138) => 'n', chr(197) . chr(139) => 'N',
		chr(197) . chr(140) => 'O', chr(197) . chr(141) => 'o',
		chr(197) . chr(142) => 'O', chr(197) . chr(143) => 'o',
		chr(197) . chr(144) => 'O', chr(197) . chr(145) => 'o',
		chr(197) . chr(146) => 'OE', chr(197) . chr(147) => 'oe',
		chr(197) . chr(148) => 'R', chr(197) . chr(149) => 'r',
		chr(197) . chr(150) => 'R', chr(197) . chr(151) => 'r',
		chr(197) . chr(152) => 'R', chr(197) . chr(153) => 'r',
		chr(197) . chr(154) => 'S', chr(197) . chr(155) => 's',
		chr(197) . chr(156) => 'S', chr(197) . chr(157) => 's',
		chr(197) . chr(158) => 'S', chr(197) . chr(159) => 's',
		chr(197) . chr(160) => 'S', chr(197) . chr(161) => 's',
		chr(197) . chr(162) => 'T', chr(197) . chr(163) => 't',
		chr(197) . chr(164) => 'T', chr(197) . chr(165) => 't',
		chr(197) . chr(166) => 'T', chr(197) . chr(167) => 't',
		chr(197) . chr(168) => 'U', chr(197) . chr(169) => 'u',
		chr(197) . chr(170) => 'U', chr(197) . chr(171) => 'u',
		chr(197) . chr(172) => 'U', chr(197) . chr(173) => 'u',
		chr(197) . chr(174) => 'U', chr(197) . chr(175) => 'u',
		chr(197) . chr(176) => 'U', chr(197) . chr(177) => 'u',
		chr(197) . chr(178) => 'U', chr(197) . chr(179) => 'u',
		chr(197) . chr(180) => 'W', chr(197) . chr(181) => 'w',
		chr(197) . chr(182) => 'Y', chr(197) . chr(183) => 'y',
		chr(197) . chr(184) => 'Y', chr(197) . chr(185) => 'Z',
		chr(197) . chr(186) => 'z', chr(197) . chr(187) => 'Z',
		chr(197) . chr(188) => 'z', chr(197) . chr(189) => 'Z',
		chr(197) . chr(190) => 'z', chr(197) . chr(191) => 's'
	);

	$string = strtr($string, $chars);

	return $string;
}

class ProjectsCharacteristics {
	static $characteristics;
	static $projectsList;
	static $mapping;
	static $len;

	function __construct() {
		self::$projectsList = Project::getProjectListOrderById();
		for ($i = 0; $i < sizeof(self::$projectsList); ++$i) {
			self::$characteristics[$i] = remove_accents(self::$projectsList[$i]['oblast'] . "," . self::$projectsList[$i]['platforma'] . "," . self::$projectsList[$i]['technologie']);
//			self::$mapping[self::$projectsList[$i]['id']] = $i;
			self::$mapping[$i] = self::$projectsList[$i]['id'];
		}
		self::$len = sizeof(self::$characteristics);
	}

	static function isImportant($index) {
		if (self::$projectsList[$index]['dolezity'] == 1) {
			return true;
		} else {
			return false;
		}
	}

	static function getId($index) {
		if ($index < self::$len) {
			if (isset(self::$mapping[$index])) {
				return self::$mapping[$index];
			}
		} else {
			return null;
		}
	}

	static function getProjectId($index) {
//		return self::$projectsList[$index]['id'];
		return self::$mapping[$index];
	}

	function getCharacteristics($index) {
		if ($index < sizeof(self::$characteristics)) {
			return self::$characteristics[$index];
		} else {
			return null;
		}
	}

	function getProjectCount() {
		return sizeof(self::$characteristics);
	}

	function __toString() {
		$result = '';
		for ($i = 0; $i < sizeof(self::$characteristics); ++$i) {
			$result .= self::$characteristics[$i] . "<br>";
		}
		return $result;
	}
}

class GroupCharacteristics {
	static $characteristics;
	static $preferences;
	static $groupsList;

	function __construct() {
		self::$groupsList = Group::getGroupListOrderById();
		for ($i = 0; $i < sizeof(self::$groupsList); ++$i) {
			self::$characteristics[$i] = remove_accents(self::$groupsList[$i]['schopnosti']);
			self::$preferences[$i] = remove_accents(self::$groupsList[$i]['preferencie']);
		}
	}

	static function getGroupId($char) {
		$index = strpos(ALPHABET, $char);
		if (($index < sizeof(self::$groupsList)) && ($index !== false)) {
			return self::$groupsList[$index]['id'];
		} else {
			return null;
		}
	}

//	function getGroupCharacteristics($index) {
//		if ($index < sizeof(self::$characteristics)) {
//			return self::$characteristics[$index];
//		} else {
//			return null;
//		}
//	}

	function getGroupCount() {
		return sizeof(self::$characteristics);
	}

	function getGroupCharacteristics($char) {
		$index = strpos(ALPHABET, $char);
		if (($index !== false) && ($index < sizeof(self::$characteristics))) {
			return self::$characteristics[$index];
		} else {
			return null;
		}
	}

	function getGroupPreferences($char) {
		$index = strpos(ALPHABET, $char);
		if ($index !== false && $index < sizeof(self::$preferences)) {
			return self::$preferences[$index];
		} else {
			return null;
		}
	}

	function __toString() {
		$result = '';
		foreach (self::$preferences as $key => $preference) {
			$result .= "id " . $key . ", pref ";
			foreach ($preference as $k => $pref) {
				$result .= $k . ": " . $pref . " ";
			}
			$result .= "<br>";
		}
		return $result;
	}
}

class Permutation {
	static $projectsCharacteristics;
	static $groupCheracteristics;
	var $permutation;
	var $fitness;

	function __construct($init = "") {
		if (!isset(self::$projectsCharacteristics)) {
			self::$projectsCharacteristics = new ProjectsCharacteristics();
		}
		if (!isset(self::$groupCheracteristics)) {
			self::$groupCheracteristics = new GroupCharacteristics();
		}
		if ($init == "") {
			$this->permutation = str_shuffle(substr(ALPHABET, 0, self::$projectsCharacteristics->getProjectCount()));
//			$this->permutation = substr(str_shuffle(substr(ALPHABET, 0, self::$projectsCharacteristics->getProjectCount())), 0, self::$groupCheracteristics->getGroupCount());
		} else {
			$this->permutation = $init;
		}
		$this->fitness = 0;
	}

	function mutate() {
		$randomIndex1 = mt_rand(0, strlen($this->permutation) - 1);
		do {
			$randomIndex2 = mt_rand(0, strlen($this->permutation) - 1);
		} while ($randomIndex1 == $randomIndex2);
		$old = $this->permutation[$randomIndex1];
		$this->permutation[$randomIndex1] = $this->permutation[$randomIndex2];
		$this->permutation[$randomIndex2] = $old;
	}

	function __toString() {
		return $this->permutation;
	}

	function getString() {
		return $this->permutation;
	}

	function getFitness() {
		return $this->fitness;
	}

	function equals($other) {
		return $this->permutation == $other->getString();
	}

	function fitness() {
		$this->fitness = 0;
		for ($i = 0; $i < strlen($this->permutation); ++$i) {
			if (self::$groupCheracteristics->getGroupCharacteristics($this->permutation[$i]) != null) {
				if (ProjectsCharacteristics::isImportant($i)) {
					$this->fitness += IMPORTANT_MATCH;
				}
			}
			foreach (explode(',', self::$projectsCharacteristics->getCharacteristics($i)) as $skill) {
				if (in_array($skill, explode(',', self::$groupCheracteristics->getGroupCharacteristics($this->permutation[$i])))) {
					$this->fitness += SKILL_MATCH;
				}
			}

			foreach (explode(";", self::$groupCheracteristics->getGroupPreferences($this->permutation[$i])) as $preference) {
				$tmp = explode(":", $preference);
				if (!empty($tmp)) {
					if ($tmp[0] == self::$projectsCharacteristics->getId($i)) {
						switch ($tmp[1]) {
							case 1:
								$this->fitness += PREF_MATCH_1;
								break;
							case 2:
								$this->fitness += PREF_MATCH_2;
								break;
							case 3:
								$this->fitness += PREF_MATCH_3;
								break;
							case 4:
								$this->fitness += PREF_MATCH_4;
								break;
						}
					}
				}
			}
		}
	}

	function fitnessOfOne($index) {
		$fitness = 0;
		foreach (explode(',', self::$groupCheracteristics->getGroupCharacteristics($index)) as $skill) {
			if (in_array($skill, explode(',', self::$projectsCharacteristics->getCharacteristics($this->permutation[$index])))) {
				$fitness += SKILL_MATCH;
			}
		}
		$position = strpos(self::$groupCheracteristics->getGroupPreferences($index), ";" . self::$projectsCharacteristics->getId($this->permutation[$index]) . ":");
		if ($position != false) {
			$value = explode(':', explode(';', (substr(self::$groupCheracteristics->getGroupPreferences($index), $position + 1)))[0])[1];
			switch ($value) {
				case 1:
					$fitness += PREF_MATCH_1;
					break;
				case 2:
					$fitness += PREF_MATCH_2;
					break;
				case 3:
					$fitness += PREF_MATCH_3;
					break;
				case 4:
					$fitness += PREF_MATCH_4;
					break;
			}
		}
//		var_dump("fitness of " . $index . " ".$fitness);
		return $fitness;
	}
}

class Population {
	static $permSize;
	var $popSize = POPULATION_SIZE;
	var $population;
	var $best;

	function __construct() {
		for ($i = 0; $i < $this->popSize; ++$i) {
			$this->population[$i] = new Permutation();
			self::$permSize = strlen($this->population[$i]);
		}
		$this->compute();
//		var_dump($this->best);
	}

	function compute() {
		$currentGeneration = 0;
		for ($i = 0; $i < $this->popSize; ++$i) {
			$this->population[$i]->fitness();
			if (empty($this->best) || $this->population[$i]->getFitness() > $this->best->getFitness()) {
				$this->best = $this->population[$i];
			}
		}
		while ($currentGeneration < GENERATIONS) {
			do {
				$parent1 = $this->selectParent();
				$parent2 = $this->selectParent([$parent1]);
				$children = $this->crossover($this->population[$parent1], $this->population[$parent2]);
				$children[0]->mutate();
				$children[1]->mutate();
			} while ($children[0]->equals($this->population[$parent1]) || $children[0]->equals($this->population[$parent2]) || $children[1]->equals($this->population[$parent1]) || $children[1]->equals($this->population[$parent2]));
			$children[0]->fitness();
			if ($children[0]->getFitness() > $this->best->getFitness()) {
				$this->best = $children[0];
			}
			$children[1]->fitness();
			if ($children[1]->getFitness() > $this->best->getFitness()) {
				$this->best = $children[1];
			}

			$randomIndex1 = mt_rand(0, self::$permSize - 1);
			do {
				$randomIndex2 = mt_rand(0, self::$permSize - 1);
			} while ($randomIndex1 == $randomIndex2);
			$this->population[$randomIndex1] = $children[0];
			$this->population[$randomIndex2] = $children[1];
			++$currentGeneration;
		}
//		var_dump($this->best);
//		for ($i = 0; $i < self::$permSize; ++$i) {
//			$this->best->fitnessOfOne($i);
//		}

	}

	function selectParent($alreadySelected = array()) {
		$candidates = array();
		for ($i = 0; $i < TOURNAMENT_SIZE; ++$i) {
			array_push($candidates, $this->getRandomIndex(array_merge($candidates, $alreadySelected)));
		}
		$best = $candidates[0];
		for ($i = 1; $i < TOURNAMENT_SIZE; ++$i) {
			$next = $candidates[$i];
			if ($this->population[$next]->getFitness() > $this->population[$best]->getFitness()) {
				$best = $next;
			}
		}
		return $best;
	}

	function getRandomIndex($alreadyThere = array()) {
		do {
			$randomIndex = mt_rand(0, $this->popSize - 1);
		} while (array_search($randomIndex, $alreadyThere) !== false);
		return $randomIndex;
	}

	function crossover($fatherP, $motherP) {
		$father = $this->encodePermutation($fatherP->getString());
		$mother = $this->encodePermutation($motherP->getString());
		$crossoverPoint = mt_rand(1, self::$permSize - 1);  // no clones

		$child1 = $this->inversion($mother);
		$tmp = $child1;
		$child2 = $this->inversion($father);

		for ($i = $crossoverPoint; $i < self::$permSize; ++$i) {
			$child1[$i] = $child2[$i];
			$child2[$i] = $tmp[$i];
		}

		$child1 = $this->decodePermutation($this->generatePermutation($child1));
		$child2 = $this->decodePermutation($this->generatePermutation($child2));
		return [new Permutation($child1), new Permutation($child2)];
	}

	function encodePermutation($input) {
		$result = array();
		for ($i = 0; $i < strlen($input); ++$i) {
			$result[$i] = array_search($input[$i], str_split(ALPHABET));
		}
		return $result;
	}

	function inversion($permutation) {
		$inv = array();
		for ($i = 0; $i < sizeof($permutation); ++$i) {
			$inv[$i] = 0;
			$m = 0;
			while ($permutation[$m] != $i) {
				if ($permutation[$m] > $i) {
					++$inv[$i];
				}
				++$m;
			}
		}
		return $inv;
	}

	function decodePermutation($input) {
		$result = array();
		for ($i = 0; $i < sizeof($input); ++$i) {
			$result[$i] = ALPHABET[$input[$i]];
		}
		return implode($result);
	}

	function generatePermutation($inversion) {
		$pos = array_fill(0, sizeof($inversion), 0);
		$perm = array_fill(0, sizeof($inversion), 0);
		for ($i = sizeof($inversion) - 1; $i >= 0; --$i) {
			for ($m = $i; $m < sizeof($inversion); ++$m) {
				if ($pos[$m] >= $inversion[$i]) {
					++$pos[$m];
				}
				$pos[$i] = $inversion[$i];
			}
		}
		for ($i = 0; $i < sizeof($inversion); ++$i) {
			$perm[$pos[$i]] = $i;
		}
		return $perm;
	}

	function getAssignment() {
		$result = array();
		foreach (str_split($this->best->permutation) as $key => $value) {
			if (GroupCharacteristics::getGroupId($value) != null) {
				$result[ProjectsCharacteristics::getProjectId($key)] = GroupCharacteristics::getGroupId($value);
			}
		}
		return $result;
	}

	function has_dupes($array) {
		return count($array) !== count(array_unique($array));
	}

	function mt_randf($min, $max) {
		return $min + abs($max - $min) * mt_rand(0, mt_getrandmax()) / mt_getrandmax();
	}


}

//$time_start = microtime(true);
//$pop = new Population();
//foreach ($pop->population as $permutation) {
//	$permutation->fitness();
//}
//var_dump($pop);
//$children = $pop->crossover($pop->population[0], $pop->population[1]);
//var_dump($pop, $children);
//$time_end = microtime(true);
//var_dump($execution_time = ($time_end - $time_start), $pop->best);
//
//$assignment = array();
//foreach (str_split($pop->best->permutation) as $key => $value) {
//	if (GroupCharacteristics::getGroupId($value) != null) {
//		$result[ProjectsCharacteristics::getProjectId($key)] = GroupCharacteristics::getGroupId($value);
//	}
//}
//var_dump($result);
