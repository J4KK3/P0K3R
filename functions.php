<?php


function check_hand($k1, $sparaVarde, $sparaFarg)
{

	global $vardeSpecial;
	global $fargerny;
	global $varde;
	global $farg;
	global $kortlek;
	global $sparaPoint;
	
	$playerNumber = (($k1+1)/2) - 2;
	
	/*
	if($k1 == 5)
	{
		$playerNumber = 1;
	}
	elseif($k1 == 7)
	{
		$playerNumber = 2;
	}
	elseif($k1 == 9)
	{
		$playerNumber = 3;
	}
	elseif($k1 == 11)
	{
		$playerNumber = 4;
	}
	elseif($k1 == 13)
	{
		$playerNumber = 5;
	}
*/
	
	$playerDSF = "dsf/p".$playerNumber.".txt";
	
	if(!file_exists($playerDSF))
	{
		$playerDSF = "dsf/p".$playerNumber.".txt";
	}	
	
	$fopenPlayer = fopen($playerDSF, "w");
		
	for($k = 0; $k < 2; $k++)
	{
		// ta reda pa kortets varde
		$varde = $kortlek[$k1 + $k] % 13;
		
		// ta reda pa kortets farg
		$farg = ($kortlek[$k1 + $k] - $varde)/13;
		
		//spara värdena i arrayer
		
		$sparaVarde[5 + $k] = $varde;
		$sparaFarg[5 + $k] = $farg;
		
// delar ut bilder beroende på kortens värde
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
		fprintf($fopenPlayer, "%s\r\n%s\r\n", $varde, $farg);
	}
	fclose($fopenPlayer);


/*
//skickar in värde i pointAssign funktioner och jämnför dom.
	$firstPointAssign = firstPointAssign($sparaVarde);
	$secondPointAssign = secondPointAssign($sparaVarde, $sparaFarg);
	
	//array för att spara poäng för varje spelare.
	
	if($firstPointAssign < $secondPointAssign)
	{
		echo "Player ".$playerNumber.": ";
		echo $secondPointAssign;
		$sparapoint[$playerNumber - 1] = $secondPointAssign;
	}
	elseif($firstPointAssign > $secondPointAssign)
	{
		echo "Player ".$playerNumber.": ";
		echo $firstPointAssign;
		$sparapoint[$playerNumber - 1] = $firstPointAssign;
	}
	else
	{
		echo "Player ".$playerNumber.": ";
		echo "0";
		$sparapoint[$playerNumber - 1] = 0;
	}
	
*/
}

function firstPointAssign($sparaVarde)
{
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
		echo"<script>console.log('kåk')</script>";
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
		echo"<script>console.log('par')</script>";
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
		echo"<script>console.log('triss')</script>";
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
		echo"<script>console.log('par')</script>";
		return $point;
	}
	else
	{
		return 0;
	}
}

function secondPointAssign($sparaVarde, $sparaFarg)
{
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
	if($flushPoint == 5 && $point == 4 && $straightRoyal == 1)
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

function dealer()
{
	global $vardeSpecial;
	global $fargerny;
	global $varde;
	global $farg;
	global $kortlek;
	global $sparaVarde;
	global $sparaFarg;
	
	$dealerDSF = "dsf/dealer.txt";

	if(!file_exists($dealerDSF))
	{
		$dealerDSF = "dsf/dealer.txt";
	}

	$fopenDealer = fopen($dealerDSF, "w");
	
	for($k = 0; $k < 5; $k++)
	{
		// ta reda pa kortets varde
		$varde = $kortlek[$k] % 13;
		
		// ta reda pa kortets farg
		$farg = ($kortlek[$k] - $varde)/13;
		
		//spara värdena i arrayer
		
		$sparaVarde[$k] = $varde;
		$sparaFarg[$k] = $farg;
				
		
		
// delar ut bilder beroende på kortens värde
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
		
		fprintf($fopenDealer, "%s\r\n%s\r\n", $varde, $farg);
	
	}
	
	fclose($fopenDealer);
	
}

function playerValuesToArray($in)
{
	$playerValue = array();
	
	$txtfile = "dsf/p".$in.".txt";
	$fopenplayer = fopen($txtfile, "r");
	$playerValue[0] = fgets($fopenplayer);
	fgets($fopenplayer);
	$playerValue[1] = fgets($fopenplayer);
	fclose($fopenplayer);
	
	return $playerValue;
}

function playerColorToArray($in)
{
	$playerColor = array();
	
	$txtfile = "dsf/p".$in.".txt";
	$fopenplayer = fopen($txtfile, "r");
	fgets($fopenplayer);
	$playerColor[0] = fgets($fopenplayer);
	fgets($fopenplayer);
	$playerColor[1] = fgets($fopenplayer);
	fclose($fopenplayer);
	
	return $playerColor;
}

function dealerValuesToArray()
{
	$dealerValue = array();
	
	$txtfile = "dsf/dealer.txt";
	$fopendealer = fopen($txtfile, "r");
	
	for($i = 0; $i <= 10; $i = $i + 2)
	{
		$dealerValue[$i/2] = fgets($fopendealer);
		fgets($fopendealer);
	}		
	fclose($fopendealer);
	
	return $dealerValue;
}

function dealerColorToArray()
{
	$dealerColor = array();
	
	$txtfile = "dsf/dealer.txt";
	$fopendealer = fopen($txtfile, "r");
	
	for($i = 0; $i <= 10; $i = $i + 2)
	{
		fgets($fopendealer);
		$dealerColor[$i/2] = fgets($fopendealer);
	}		
	fclose($fopendealer);
	
	return $dealerColor;
}


?>