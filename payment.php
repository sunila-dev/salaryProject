<?php

require_once "PaymentDistribution.php";

if (!isset($argv[1])) {
    printf("You need to give a filename to write results\n");
    exit;
}

$fileName = $argv[1];

if(!isset($argv[2])) {
    printf("It will show results for 12 months by default\n");
    $numberOfMonths = 12;
    
}else{
	$numberOfMonths = $argv[2];
}

$fp = fopen($fileName, "w");

$headers = ["Month", "Salary Date", "Bonus Date"];
fputcsv($fp, $headers); // Setting heards in output file

for( $i=1; $i <= $numberOfMonths; $i++) {

    $year      = date("Y", strtotime("$i month")); // Year 
    $month     = date("m", strtotime("$i month")); // month number
    $monthName = date("F", strtotime("$i month")); // month name
   
    $sd = new PaymentDistribution($year, $month);
   
    $salary = $sd->getDateToPaySalary();
    $bonus = $sd->getDateToPayBonus();

   fputcsv($fp, [$monthName ." - ". $year, $salary, $bonus]);
}

fclose($fp);
