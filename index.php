<style>

	div#bord
	{
		border-style: solid;
		border-width: 40px;
		border-radius: 100px;
		background-color: green; /* For browsers that do not support gradients */
		background-image: radial-gradient( lightgreen 1%, green 60%);
		height: 60%;
		width: 80%;
		margin: 100px;
	}
	
	#p1
	{
		position: absolute;
		top:56.5%;
		left: 10%;	
	}
	
	#p2
	{
		position: absolute;
		left: 25%;
		top:56.5%;
	}
	
	#p3
	{
		position: absolute;
		left: 40%;
		top:56.5%;
	}
	
	#p4
	{
		position: absolute;
		left: 55%;
		top:56.5%;
	}
	
	#p5
	{
		position: absolute;
		left: 70%;
		top:56.5%;
	}
	
	#dealer
	{
		position: absolute;
		left: 33%;
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
$sparaPoint = array();


// blanda kortleken
shuffle($kortlek);


echo "<div id=dealer>";
$dealer = dealer();
echo "</div>";


echo "<div id=container>";
	echo "<div class=player id=p1>";
	check_hand(5, $sparaVarde, $sparaFarg);
	echo "</div>";

	echo "<div class=player id=p2>";
	check_hand(7, $sparaVarde, $sparaFarg);
	echo "</div>";

	echo "<div class=player id=p3>";
	check_hand(9, $sparaVarde, $sparaFarg);
	echo "</div>";

	echo "<div class=player id=p4>";
	check_hand(11, $sparaVarde, $sparaFarg);
	echo "</div>";

	echo "<div class=player id=p5>";
	check_hand(13, $sparaVarde, $sparaFarg);
	echo "</div>";
echo "</div>";




?>
</div>
<?php
$dealerValue = dealerValuesToArray();
print_r($dealerValue);

?>
</body>