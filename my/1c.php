<html><body>
<?php

function Connect1C(){
    if (!function_exists('is_soap_fault')){
      print 'Не настроен web сервер. Не найден модуль php-soap.';
      return false;
    }
    try {
      $Клиент1С = new SoapClient('http://176.213.140.14:10368/zkh_rostov/ws/WebСервисLK?wsdl',
                               array('login'          => 'Коркотян А',
                                     'password'       => '1572',
                                     'soap_version'   => SOAP_1_2,
                                     'cache_wsdl'     => WSDL_CACHE_NONE, //WSDL_CACHE_MEMORY, //, WSDL_CACHE_NONE, WSDL_CACHE_DISK or WSDL_CACHE_BOTH
                                     'exceptions'     => true,
                                     'trace'          => 1));
    }catch(SoapFault $e) {
      trigger_error('Ошибка подключения или внутренняя ошибка сервера. Не удалось связаться с базой 1С.', E_ERROR);
      var_dump($e);
    }
    //echo 'Раз<br>';
    if (is_soap_fault(Клиент1С)){
      trigger_error('Ошибка подключения или внутренняя ошибка сервера. Не удалось связаться с базой 1С.', E_ERROR);
      return false;
    }
    return $Клиент1С;
  }
 
  function GetData($idc, $txt){
      $ret1c = 0;
      if (is_object($idc)){
 
        try {
          $par = array('ЛС' => $txt);
          //var_dump($par);
          $ret1c = $idc->ПолучитьЛС($par);
        } catch (SoapFault $e) {
                      echo "АЩИБКА!!! </br>";
            var_dump($e);
        }   
      }
      else{
        echo 'Не удалося подключиться к 1С<br>';
        var_dump($idc);
      }
    return $ret1c;
  }
error_reporting(1); 
 $idc = Connect1C();
// $options = getopt("p_ls:");
 
//var_dump ($options);
// $ls  = $options->ls;
//var_dump ($ls);
// $ret1c = GetData($idc,$argv[1]);
 $ret1c = GetData($idc, "2775633");
  //var_dump($ret1c);
//  $aa=$ret1c->return;
//var_dump ($ret1c);
echo $ret1c->return->ЛС->Наименование."<br>";
echo $ret1c->return->ЛС->УК."<br>";
echo $ret1c->return->ЛС->Квартиросъемщик."<br>";
echo $ret1c->return->ЛС->Адрес."<br>";
 // echo "!!$aa!!";
?>
</body>
</html>