<?php


function check_hand($k1, $sparaVarde, $sparaFarg)
{
	global $firstPointAssign;
	global $secondPointAssign;
	global $vardeSpecial;
	global $fargerny;
	global $varde;
	global $farg;
	global $kortlek;
		
	for($k = 0; $k < 2; $k++)
	{
		// ta reda pa kortets varde
		$varde = $kortlek[$k1 + $k] % 13;
		
		// ta reda pa kortets farg
		$farg = ($kortlek[$k1 + $k] - $varde)/13;
		
		//spara värdena i arrayer
		
		$sparaVarde[5 + $k] = $varde;
		$sparaFarg[5 + $k] = $farg;
		
		$p = (($k1+1)/2) - 2;
		
		
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
	}

	$firstPointAssign = firstPointAssign($sparaVarde);
	$secondPointAssign = secondPointAssign($sparaVarde, $sparaFarg);
	
	
	if($firstPointAssign < $secondPointAssign)
	{
		echo "Player ".$p.": ";
		echo $secondPointAssign;
	}
	elseif($firstPointAssign > $secondPointAssign)
	{
		echo "Player ".$p.": ";
		echo $firstPointAssign;
	}
	else
	{
		echo "Player ".$p.": ";
		echo "0";
	}

	
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

function dealer()
{
	global $vardeSpecial;
	global $fargerny;
	global $varde;
	global $farg;
	global $kortlek;
	global $sparaVarde;
	global $sparaFarg;
		
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
	}
}



?>