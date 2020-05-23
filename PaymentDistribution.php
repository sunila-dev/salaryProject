<?php
class PaymentDistribution {
    

    private $weekendDays = ['Sat', 'Sun'];
    private $year        = null;
    private $month       = null;

    public function __construct($year, $month)
    {
        $this->year  = $year;
        $this->month = $month;
    }

    public function getDateToPaySalary()
    {
            
        $salaryToBePaidOn = date("Y-m-t", strtotime($this->year . "-" . $this->month . "-1"));
        $dayOfWeek        = date("D", strtotime($salaryToBePaidOn));

        if (!in_array($dayOfWeek, $this->weekendDays)) {
            return $this->formatDate($salaryToBePaidOn);
        }else {
            $lastDayOfMonth = date("d", strtotime($salaryToBePaidOn));
            $temp           = array_search( $dayOfWeek, $this->weekendDays);
                
            $updatedDateSalaryToBePaidOn = $this->year . "-" . $this->month . "-" .($lastDayOfMonth - $temp - 1); // last day of month
        
            return $this->formatDate($updatedDateSalaryToBePaidOn);
        }
    }


    public function getDateToPayBonus()
    {
        $bonusToBePaidOn = date("Y-m-d", strtotime($this->year . "-" . $this->month . "-15"));
        $dayOfWeek       = date("D", strtotime($bonusToBePaidOn));
        
        if (!in_array($dayOfWeek, $this->weekendDays)) 
        {
            return $this->formatDate($bonusToBePaidOn);
        }else{
            
            $temp   = array_search( $dayOfWeek, array_reverse( $this->weekendDays ));
            $updatedDateBonusToBePaidOn = $this->year . "-" . $this->month ."-". (15 + 2 + ($temp+1) ); // next wednesday
        
            return $this->formatDate($updatedDateBonusToBePaidOn); 
        }
        
    }

    // Date format
    private function formatDate($strDate)
    {
        return date("D, d F Y", strtotime($strDate));
    }
    
}
