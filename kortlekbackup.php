<?php

//
function firstPointAssign()
{
	global $sparaVarde;
	global $sparaFarg;
	
	$point = 0;
// --------kåk--------
// den som räknar trissen------------------------------------------------------
	for($i = 0; $i < 6; $i++)
	{
		for($f = $i+1; $f < 7; $f++)
		{
			for($e = $f+1; $e < 7; $e++)
			{
				if($sparaVarde[$i] == $sparaVarde[$f] && $sparaVarde[$i] == $sparaVarde[$e])
				{	
// den som räknar paret--------------------------------------------------------
					for($m = 0; $m < 6; $m++)
					{
						for($n = $m+1; $n < 7; $n++)
						{
							if($sparaVarde[$m] == $sparaVarde[$n] && $sparaVarde[$m] != $sparaVarde[$i])
							{
								$point = $point + 6;
							}
						}
					}
				}
			}
		}
	}
	
	if($point == 6)
	{
	return $point;
	}
// --------fyrtal--------	
	for($i = 0; $i < 6; $i++)
	{
		for($f = $i+1; $f < 7; $f++)
		{
			for($e = $f+1; $e < 7; $e++)
			{
				for($k = $e+1; $k < 7; $k++)
				{
					if($sparaVarde[$i] == $sparaVarde[$f] && $sparaVarde[$i] == $sparaVarde[$e] && $sparaVarde[$i] == $sparaVarde[$k])
					{
						$point = $point + 7;
						if($point > 7)
						{
							$point = 7;
						}

					}
				}
			}
		}
	}
	
	if($point == 7)
	{
	return $point;
	}	
// --------triss--------
	for($i = 0; $i < 6; $i++)
	{
		for($f = $i+1; $f < 7; $f++)
		{
			for($e = $f+1; $e < 7; $e++)
			{
				if($sparaVarde[$i] == $sparaVarde[$f] && $sparaVarde[$i] == $sparaVarde[$e])
				{
					$point = $point + 3;
					if($point > 3)
					{
						$point = 3;
					}

				}
			}
		}
	}
	
	if($point == 3)
	{
	return $point;
	}
// --------par--------
	for($i = 0; $i < 6; $i++)
	{
		for($f = $i+1; $f < 7; $f++)
		{
			if($sparaVarde[$i] == $sparaVarde[$f])
			{
				$point = $point + 1;
				if($point > 2)
				{
					$point = 2;
				}
			}
		}
	}	
	
	if($point >= 1)
	{
		return $point;
	}
	else
	{
		return 0;
	}
}

function secondPointAssign()
{
	global $sparaVarde;
	global $sparaFarg;
	
	$point = 0;
	$secondPoint = 0; // denhär är BARA en extra som inte ska användas för NÅGON return
	$flushPoint = 0; // kollar om det är en flush för att senare användas till royalmm...
	
	
// ------------färg------------
	
	sort($sparaFarg);
	for($i = 0; $i < 6; $i++)
	{
		for($e = $i+1; $e < 7; $e++)
		{
			for($f = $e+1; $f < 7; $f++)
			{
				if($sparaFarg[$i] == $sparaFarg[$e] && $sparaFarg[$i] == $sparaFarg[$f])
				{
					$point = $point + 1;
				}
			}
		}
		if($point > 4)
		{
			$point = 0;
			$secondPoint = 1;
			$flushPoint = 5;
		}
		else
		{
			$point = 0;
		}
	}
	
	$point = 0; // för säkerhetsskull...
	
// ------------stege------------

	sort($sparaVarde);
	for($i = 0; $i < 6; $i++)
	{
		if($sparaVarde[$i] + 1 == $sparaVarde[$i+1])
		{
			$point = $point + 1;
		}
		elseif($sparaVarde[$i] != $sparaVarde[$i+1])
		{
			$point = 0;
		}
	}
	
	if($point == 0)
	{
		for($i = 0; $i < 7; $i++)
		{
			if($sparaVarde[$i] == 0)
			{
				$sparaVarde[$i] = 14;
			}
		}
		for($i = 0; $i < 6; $i++)
		{
			if($sparaVarde[$i] + 1 == $sparaVarde[$i+1])
			{
				$point = $point + 1;
				$straightRoyal = 1;
			}
			elseif($sparaVarde[$i] != $sparaVarde[$i+1])
			{
				$point = 0;
				$straightRoyal = 0;
			}
		}
		if($point > 3)
		{
			$point = 4;
		}
		else
		{
			$point = 0;
		}
	}

	// straightflush eller straighroyalflush
	if($flushPoint == 5 && $point == 4 && $straighRoyal == 1)
	{
		return 10;
	}
	elseif($flushPoint == 5 && $point == 4)
	{
		return 9;
	}
	elseif($flushPoint > $point)
	{
		return 5;
	}
	elseif($flushPoint < $point && $point == 4)
	{
		return 4;
	}
	else
	{
	return 0;
	}
}


// en kortlek
$kortlek = array();

for($k = 0; $k < 52; $k++)
{
	$kortlek[$k] = $k;
}


// kortens fyra farger
$farger = array('h', 's', 'r', 'k');
$fargerny = array('_of_hearts', '_of_spades', '_of_diamonds', '_of_clubs');
$vardeSpecial = array();
$vardeSpecial[10] = "jack";
$vardeSpecial[11] = "queen";
$vardeSpecial[12] = "king";

// sparar allt så det kan användas igen.
$sparaVarde = array();
$sparaFarg = array();
$sparaVardeDealer = array();
$sparaFargDealer = array();
$sparaSparaVarde = array();


// blanda kortleken
shuffle($kortlek);

// ta de fem forsta korten
for($k = 0; $k < 5; $k++)
{
	// ta reda pa kortets varde
	$varde = $kortlek[$k] % 13;
	
	// ta reda pa kortets farg
	$farg = ($kortlek[$k] - $varde)/13;
	//$farg = 2;
	//spara i arrayer
	$sparaVarde[$k] = $varde;
	$sparaFarg[$k] = $farg;
	$sparaVardeDealer[$k] = $varde+1;
	$sparaFargDealer[$k] = $farg;
	

	// skriv ut farg och varde
	//echo $farger[$farg].$varde." ";
	if($varde == 0)
	{
		$bildadress = "ace".$fargerny[$farg].".png";
		echo "<img width=100px; src=cards/".$bildadress.">";
	}
	elseif($varde < 10)
	{
		$bildadress = ($varde+1).$fargerny[$farg].".png";
		echo "<img width=100px; src=cards/".$bildadress.">";
	}
	else
	{
		$bildadress = ($vardeSpecial[$varde]).$fargerny[$farg].".png";
		echo "<img width=100px; src=cards/".$bildadress.">";
	}
}
echo "<p>";

// ta ytterligare tva kort
for($k = 5; $k < 7; $k++)
{
	// ta reda pa kortets varde
	$varde = $kortlek[$k] % 13;
	
	// ta reda pa kortets farg
	$farg = ($kortlek[$k] - $varde)/13;
	
	//spara värdena i arrayer
	
	$sparaVarde[$k] = $varde;
	$sparaFarg[$k] = $farg;
	$sparaVardeP1[$k-5] = $varde+1;
	$sparaFargP1[$k-5] = $farg;
	
	
	// skriv ut farg och varde
	//echo $farger[$farg].$varde." ";

	if($varde == 0)
		{
			$bildadress = "ace".$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		elseif($varde < 10)
		{
			$bildadress = ($varde+1).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		else
		{
			$bildadress = ($vardeSpecial[$varde]).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
			
		}
}

$sparaSparaVarde = $sparaVarde;
// print_r($sparaSparaVarde);

// skriver ut det högst poänget (tillfälligt)
$firstPointAssignP1 = firstPointAssign();
$secondPointAssignP1 = secondPointAssign();

if($firstPointAssignP1 < $secondPointAssignP1)
{
	echo "Player 1: ";
	echo $secondPointAssignP1;
}
elseif($firstPointAssignP1 > $secondPointAssignP1)
{
	echo "Player 1: ";
	echo $firstPointAssignP1;
}
else
{
	echo "Player 1: ";
	echo "0";
}

//spelare 2
$sparaVarde = $sparaSparaVarde;
// print_r($sparaVarde);

for($k = 7; $k < 9; $k++)
{
	// ta reda pa kortets varde
	$varde = $kortlek[$k] % 13;
	
	// ta reda pa kortets farg
	$farg = ($kortlek[$k] - $varde)/13;
	
	//spara värdena i arrayer
	
	$sparaVarde[$k-2] = $varde;
	$sparaFarg[$k-2] = $farg;
	$sparaVardeP1[$k-5] = $varde+1;
	$sparaFargP1[$k-5] = $farg;
	
	
	// skriv ut farg och varde
	//echo $farger[$farg].$varde." ";

	if($varde == 0)
		{
			$bildadress = "ace".$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		elseif($varde < 10)
		{
			$bildadress = ($varde+1).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		else
		{
			$bildadress = ($vardeSpecial[$varde]).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
			
		}
}

$firstPointAssignP2 = firstPointAssign();
$secondPointAssignP2 = secondPointAssign();


if($firstPointAssignP2 < $secondPointAssignP2)
{
	echo "Player 2: ";
	echo $secondPointAssignP2;
}
elseif($firstPointAssignP2 > $secondPointAssignP2)
{
	echo "Player 2: ";
	echo $firstPointAssignP2;
}
else
{
	echo "Player 2: ";
	echo "0";
}


//spelare 3
$sparaVarde = $sparaSparaVarde;
// print_r($sparaVarde);

for($k = 9; $k < 11; $k++)
{
	// ta reda pa kortets varde
	$varde = $kortlek[$k] % 13;
	
	// ta reda pa kortets farg
	$farg = ($kortlek[$k] - $varde)/13;
	
	//spara värdena i arrayer
	
	$sparaVarde[$k-4] = $varde;
	$sparaFarg[$k-4] = $farg;
	$sparaVardeP1[$k-5] = $varde+1;
	$sparaFargP1[$k-5] = $farg;
	
	
	// skriv ut farg och varde
	//echo $farger[$farg].$varde." ";

	if($varde == 0)
		{
			$bildadress = "ace".$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		elseif($varde < 10)
		{
			$bildadress = ($varde+1).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		else
		{
			$bildadress = ($vardeSpecial[$varde]).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
			
		}
}

$firstPointAssignP3 = firstPointAssign();
$secondPointAssignP3 = secondPointAssign();


if($firstPointAssignP3 < $secondPointAssignP3)
{
	echo "Player 3: ";
	echo $secondPointAssignP3;
}
elseif($firstPointAssignP3 > $secondPointAssignP3)
{
	echo "Player 3: ";
	echo $firstPointAssignP3;
}
else
{
	echo "Player 3: ";
	echo "0";
}

//spelare 4
$sparaVarde = $sparaSparaVarde;
// print_r($sparaVarde);

for($k = 11; $k < 13; $k++)
{
	// ta reda pa kortets varde
	$varde = $kortlek[$k] % 13;
	
	// ta reda pa kortets farg
	$farg = ($kortlek[$k] - $varde)/13;
	
	//spara värdena i arrayer
	
	$sparaVarde[$k-6] = $varde;
	$sparaFarg[$k-6] = $farg;
	$sparaVardeP1[$k-9] = $varde+1;
	$sparaFargP1[$k-5] = $farg;
	
	
	// skriv ut farg och varde
	//echo $farger[$farg].$varde." ";

	if($varde == 0)
		{
			$bildadress = "ace".$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		elseif($varde < 10)
		{
			$bildadress = ($varde+1).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		else
		{
			$bildadress = ($vardeSpecial[$varde]).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
			
		}
}

$firstPointAssignP4 = firstPointAssign();
$secondPointAssignP4 = secondPointAssign();


if($firstPointAssignP4 < $secondPointAssignP4)
{
	echo "Player 4: ";
	echo $secondPointAssignP4;
}
elseif($firstPointAssignP4 > $secondPointAssignP4)
{
	echo "Player 4: ";
	echo $firstPointAssignP4;
}
else
{
	echo "Player 4: ";
	echo "0";
}


//spelare 5

$sparaVarde = $sparaSparaVarde;
// print_r($sparaVarde);

for($k = 13; $k < 15; $k++)
{
	// ta reda pa kortets varde
	$varde = $kortlek[$k] % 13;
	
	// ta reda pa kortets farg
	$farg = ($kortlek[$k] - $varde)/13;
	
	//spara värdena i arrayer
	
	$sparaVarde[$k-8] = $varde;
	$sparaFarg[$k-8] = $farg;
	$sparaVardeP1[$k-13] = $varde+1;
	$sparaFargP1[$k-13] = $farg;
	
	
	// skriv ut farg och varde
	//echo $farger[$farg].$varde." ";

	if($varde == 0)
		{
			$bildadress = "ace".$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		elseif($varde < 10)
		{
			$bildadress = ($varde+1).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
		}
		else
		{
			$bildadress = ($vardeSpecial[$varde]).$fargerny[$farg].".png";
			echo "<img width=100px; src=cards/".$bildadress.">";
			
		}
}

$firstPointAssignP5 = firstPointAssign();
$secondPointAssignP5 = secondPointAssign();


if($firstPointAssignP5 < $secondPointAssignP5)
{
	echo "Player 5: ";
	echo $secondPointAssignP5;
}
elseif($firstPointAssignP5 > $secondPointAssignP5)
{
	echo "Player 5: ";
	echo $firstPointAssignP5;
}
else
{
	echo "Player 5: ";
	echo "0";
}
?>