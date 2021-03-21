<?php



if (!function_exists('date_indo')) {
    /**
     * Returns a indonesian date
     *
     * @param date $date
     * date default system to convert
     *
     * @return string a string in human readable format
     *
     * */
    function date_indo($date)
    {
      if( is_null($date) ){
          return null;
      }
        
          $year  = substr($date, 0,4);
          $month = substr($date, 5,2);
          $day   = substr($date, 8,2);

          switch ($month) {
              case 1:
                  $monthName ='Januari';
                  break;

              case 2:
                  $monthName ='Februari';
                  break;

              case 3:
                  $monthName ='Maret';
                  break;

             case 4:
                  $monthName ='April';
                  break;

             case 5:
                  $monthName ='Mei';
                  break;

             case 6:
                  $monthName ='Juni';
                  break;

             case 7:
                  $monthName ='Juli';
                  break;

             case 8:
                  $monthName ='Agustus';
                  break;

             case 9:
                  $monthName ='September';
                  break;

             case 10:
                  $monthName ='Oktober';
                  break;

             case 11:
                  $monthName ='November';
                  break;

             case 12:
                  $monthName ='Desember';
                  break;
              
              default:
                 $monthName = null;
                  break;
          }
          return $day.' '.$monthName.' '.$year ?? null;
      }
}

if (!function_exists('get_time_from_date')) {

    function get_time_from_date($time)
    {
      return substr($time, 10,6);
    }
}

if (!function_exists('rupiah_format')) {

    function rupiah_format($value)
    {
      return number_format($value,0,',','.');
    }
}

if (!function_exists('percen')) {

    function percen($total,$piece,$round = 2)
    {
      if($total == 0 or $piece == 0)
      {
        return "0%";
      }else{
        return round( (($piece/$total) * 100),2 ).'%';
      }
    }
}



if(!function_exists('get_categories')){

  function get_categories()
  {
    return DB::table('categories')->limit(10)->get();
  }
}

