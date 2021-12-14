
<body>
<div id=bord>
<?php
include "functions.php";
echo "<link rel='stylesheet' type='text/css' href='mystyle.css' />";
echo "<script type='text/javascript' src='myscripts.js'></script>";

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
	echo "<div class=player id=p1 style='display:inline'>";
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
$dealerValue = playerValuesToArray(1);
print_r($dealerValue);

?>
</body>