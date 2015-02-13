<!DOCTYPE html>
<html>
    <head>
		<style>
		th, td {
			border: 2 px; 
			background-color: #DCE8DC;
			padding: 6px;
			font-size: small; 
			font-family: sans-serif; 
			text-align: center;
			color: #333366; 
		} 
		</style>
        <meta charset="UTF-8">
    </head>
    <body>


<?php
require 'vendor/autoload.php';

$sett=new Settle;  // создание экземпляра нас. пункта
$sett->name = "Харьков";
$sett->koord = "50°00'N 36°13'E";
$sett->year_osn = "1654";

$name_street=array("Пушкинская","Рымарская","Героев Труда","Гагарина","Светлая","Виноградная");
for ($y=0; $y<=2; ++$y) {
	$sett->streets[$y]=new Street;  // создание экземпляра улицы
	do { // два цикла для поиска уникального названия улицы для массива объектов улиц
		$new_str=$name_street[rand (0,5)];
		if ($y==0) $prii=true; // для первой улицы проверка на уникальность не выполняется
		for ($k=0; $k<$y; ++$k) {
			if ($new_str==$sett->streets[$k]->name) {$prii=false; break;}
			$prii=true; // нашли улицу, которой еще не было в массиве объектов улиц
		}
	}
	while (!$prii);
	$sett->streets[$y]->name = $new_str;
	$sett->streets[$y]->lenth_st = (float) (rand (50,200) . "." . rand (1,99));
	$sett->streets[$y]->start_st = "50°". rand (0,60) . "'N 36°" . rand (0,60) . "'E ";
	$sett->streets[$y]->end_st = "50°". rand (0,60) . "'N 36°" . rand (0,60) . "'E ";
	for ($j=0; $j<=2; ++$j) {			
		$sett->streets[$y]->doma[$j] = new House;  // создание экземпляра дома
		$sett->streets[$y]->doma[$j]->num = rand (1,200);
		$sett->streets[$y]->doma[$j]->kol_floor = rand (5,16);
		$sett->streets[$y]->doma[$j]->kol_pod = rand (2,6);
		$sett->streets[$y]->doma[$j]->sq_pril = (float) (rand (50,200) . "." . rand (1,99));
			for ($i=0; $i<=3; ++$i) {
				$sett->streets[$y]->doma[$j]->kvart[$i] = new Flat; // создание экземпляра квартиры
				$sett->streets[$y]->doma[$j]->kvart[$i]->num = rand (1,200);
				$sett->streets[$y]->doma[$j]->kvart[$i]->kol_room = rand (1,5);
				$sett->streets[$y]->doma[$j]->kvart[$i]->sq_fl = (float) (rand (30,150) . "." . rand (1,9));
				$sett->streets[$y]->doma[$j]->kvart[$i]->floor_fl = rand (1,$sett->streets[$y]->doma[$j]->kol_floor);
				$sett->streets[$y]->doma[$j]->kvart[$i]->kol_gil = rand (0,10);
				$sett->streets[$y]->doma[$j]->kvart[$i]->balk = "есть";
				$sett->streets[$y]->doma[$j]->kvart[$i]->kol_balk = rand (1,2);
				$sett->streets[$y]->doma[$j]->kvart[$i]->type_otopl = "водян.";
			}
	}
}
$sett->show();
echo "<p>Коммунальные услуги " . $sett->ras_kp() . "</p>";
echo "<p>Количество населения " . $sett->ras_nass() . "</p>";
echo "<p><b>Бюджет</b></p>";
$sett->ras_budg();
$sett->show_streets(); //выводим таблицу улиц
foreach ($sett->streets as $str) { //выводим для каждой улицы таблицу домов
	echo "<h3>Улица $str->name</h3>";
	$str->show_doma();
	foreach ($str->doma as $dm) { //выводим для каждого дома таблицу квартир
		$dm->show_kvart(); 
		}
	}


/*
	
*/	

?>