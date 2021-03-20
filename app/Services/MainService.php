<?php

namespace App\Services;

use DB;
use Carbon\Carbon;

class MainService
{
	
	public static function getTypeFileBase64($stringBase)
	{
	   $type =  explode('/', (explode(';', $stringBase))[0]);
        	
	  return end($type);
	}

	public static function replaceStringBase64($stringBase)
	{
		$image = str_replace('data:image/png;base64,', '', $stringBase);
		$image = str_replace(' ', '+', $image);
        	

	  return $image;
	}



	public static function GetrandmCode()
	{
		return mt_rand(1000,9999);
	}

// render to json =======================================
	public static function RenderToJSon($view, $params = [])
	{
		$html =  view($view,$params)->render();
		return response()->json($html);
	}
// change time from timestamp format =======================================
	public static function ChangeTime($time)
	{
		return substr($time, 10,6);
	}
// Change Date Indo ========================================
public static function ChangeDateIndo($date)
    {
      if($date == null){
          $day       = null;
          $monthName = null;
          $year      = null;
      }else{
          $year  = substr($date, 0,4);
          $month = substr($date, 5,2);
          $day   = substr($date, 8,2);

          $monthName  = self::MonthName($month);
      }
      return $day.' '.$monthName.' '.$year;

       
    }

//===========================================

  public static  function MonthName($month){
      
    if ($month == 1){
      $monthName ='Januari';
    }else if($month == 2){
      $monthName ='Februari';
    }else if($month == 3){
      $monthName ='Maret';
    }else if($month == 4){
      $monthName ='April';
    }else if($month == 5){
      $monthName ='Mei';
    }else if($month == 6){
      $monthName ='Juni';
    }else if($month == 7){
      $monthName ='Juli';
    }else if($month == 8){
      $monthName ='Agustus';
    }else if($month == 9){
      $monthName ='September';
    }else if($month == 10){
      $monthName ='Oktober';
    }else if($month == 11){
      $monthName ='November';
    }else if($month == 12){
      $monthName ='Desember';
    }
    
  return $monthName;
  }
//===========================================

  public static  function MonthRomawi($month){
      
    if ($month == 1){
      $monthName ='I';
    }else if($month == 2){
      $monthName ='II';
    }else if($month == 3){
      $monthName ='III';
    }else if($month == 4){
      $monthName ='IV';
    }else if($month == 5){
      $monthName ='V';
    }else if($month == 6){
      $monthName ='VI';
    }else if($month == 7){
      $monthName ='VII';
    }else if($month == 8){
      $monthName ='VIII';
    }else if($month == 9){
      $monthName ='IX';
    }else if($month == 10){
      $monthName ='X';
    }else if($month == 11){
      $monthName ='XI';
    }else if($month == 12){
      $monthName ='XII';
    }
    
  return $monthName;
  }


	

}
