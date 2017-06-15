<?php

$Date_jour = date("j.n.Y");

echo("Nous sommes le $Date_jour");
echo date('F');
echo"<br>";

echo jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("m"),1, date("Y")) , 0 );
echo '<br><br>';
echo cal_days_in_month ( CAL_GREGORIAN , date("m") , date("Y"));

