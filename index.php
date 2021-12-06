<style>



	div#bord
	{
		border-style: solid;
		border-width: 40px;
		border-image: radial-gradient(white, black) 1;
		border-radius: 100px;
		background-color: green; /* For browsers that do not support gradients */
		background-image: radial-gradient(lightgreen, green);
		height: 60%;
		width: 80%;
		margin: 100px;
	}

	#p1
	{

	}
	
	#p2
	{

	}
	
	#p3
	{

	}
	
	#p4
	{

	}
	
	#p5
	{

	}
	
	#dealer
	{

	}
	

</style>



<body>
<div id=bord>
<?php
include "functions.php";

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
/*
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
	

	// skriv ut farg och varde
	//echo $farger[$farg].$varde." ";
	echo "<div id=dealer>";
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
	echo "</div";
}
*/

echo "<div id=dealer>";
$dealer = dealer();
echo "</div>";

echo "<div class=player id=p1>";
$c1 = check_hand(5, $sparaVarde, $sparaFarg);
echo "</div>";

echo "<div class=player id=p2>";
$c2 = check_hand(7, $sparaVarde, $sparaFarg);
echo "</div>";

echo "<div class=player id=p3>";
$c3 = check_hand(9, $sparaVarde, $sparaFarg);
echo "</div>";

echo "<div class=player id=p4>";
$c4 = check_hand(11, $sparaVarde, $sparaFarg);
echo "</div>";

echo "<div class=player id=p5>";
$c5 = check_hand(13, $sparaVarde, $sparaFarg);
echo "</div>";


?>


</div>

</body>