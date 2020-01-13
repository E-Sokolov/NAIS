<?php
class Export{
    function ExcelCallsGenerate(){
      require_once(HOME.'/core/PHPExcel/PHPExcel.php');
    
        require_once(HOME.'/core/PHPExcel/PHPExcel/Writer/Excel5.php');
        $xls = new PHPExcel();
       
 $page = $xls->setActiveSheetIndex(0);
        $page -> getColumnDimension('A') -> setWidth(5);
        $page -> getColumnDimension('B') -> setWidth(10);
        $page -> getColumnDimension('C') -> setWidth(15);
        $page -> getColumnDimension('D') -> setWidth(20);
        $page -> getColumnDimension('E') -> setWidth(10);
        $page -> getColumnDimension('F') -> setWidth(30);
        $page -> getColumnDimension('G') -> setWidth(10);
        $page -> getColumnDimension('H') -> setWidth(50);
        $page -> getColumnDimension('I') -> setWidth(50);
        $page -> getColumnDimension('J') -> setWidth(20);
        $page -> getColumnDimension('K') -> setWidth(20);
        $page -> getColumnDimension('L') -> setWidth(5);
        $page -> getColumnDimension('M') -> setWidth(70);
        
        $page->getDefaultStyle()->getFont()->setName('Times New Roman');
        $page->getDefaultStyle()->getFont()->setSize(12);
        
        $Db = Db::getConnect($_SESSION['filial']);
        $callsList = array();
        $first_date = date("Y-m-d", strtotime($_POST['first_date']));
        $last_date = date("Y-m-d", strtotime($_POST['last_date']));
        $where = " WHERE date BETWEEN '".$first_date."' AND '".$last_date."'";
        $callsList = Calls::getCallsList(" * ",$where);
        $clientTypeList = array();
        $clientTypeList = Calls::getClientTypeList();
        $resource = array();
        $resource = Calls::getResource();
        $ingeneer = array();
        $ingeneer = User::getUser(' WHERE dep=\'ing\'');
        $i = 1;
        foreach($callsList as $call){
            $call = preg_replace("/(?:<|&lt;).+?(?:>|&gt;)/", "", $call);
            $page->setCellValue("A".$i, $call['region']);
            if($call['status'] == 1){
                $page->setCellValue("B".$i,'Виконано');
            }else{
                $page->setCellValue("B".$i,'Актуальне');
            }
            $page->setCellValue("C".$i, date("d.m.Y", strtotime($call['date'])));
            $page->setCellValue("D".$i, $call['type']);
            $page->setCellValue("E".$i, $clientTypeList[$call['client_type']]['type']);
            $page->setCellValue("F".$i, $call['client']);
            $page->setCellValue("G".$i, $resource[$call['resource']]['resource']);
            $page->setCellValue("H".$i, $call['description']);
            $page->setCellValue("I".$i, $call['what_to_do']);
            $page->setCellValue("J".$i, $ingeneer[$call['ingeneer']]['short_name']);
            if($call['date_success'] != Null){
                $page->setCellValue("K".$i, date("d.m.Y", strtotime($call['date_success'])));
            }
            $page->setCellValue("L".$i, $call['trip']);
            $page->setCellValue("M".$i, $call['etc_data']);
            $i++;
        }
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        $objWriter = new PHPExcel_Writer_Excel5($xls);
 	$objWriter->save(mb_convert_encoding(HOME.'/views/export/calls.xls', "Windows-1251"));
	
        return true;
    }
    function MailExportGenerate($id){
        require_once(HOME.'/core/PHPExcel/PHPExcel.php');
        
        require_once(HOME.'/core/PHPExcel/PHPExcel/Writer/Excel5.php');
        $xls = new PHPExcel();
        $page = $xls->setActiveSheetIndex(0);
        $page -> getColumnDimension('A') -> setWidth(5);
        $page -> getColumnDimension('B') -> setWidth(30);
        $page -> getColumnDimension('C') -> setWidth(30);
        $page -> getColumnDimension('D') -> setWidth(20);
        $page -> getColumnDimension('E') -> setWidth(20);
        $page -> getColumnDimension('F') -> setWidth(15);
        $page -> getColumnDimension('G') -> setWidth(50);
        $page -> getColumnDimension('H') -> setWidth(15);
        $page -> getColumnDimension('I') -> setWidth(50);
        
        $page->getDefaultStyle()->getFont()->setName('Times New Roman');
        $page->getDefaultStyle()->getFont()->setSize(12);
        $Db = Db::getConnect($_SESSION['filial']);
        $MailList = array();

        $MailList = Mail::getMailByType($id);
        $MailTypeList = array();
        $MailTypeList = Mail::getMailTypeList();
        $i = 1;

        foreach($MailList as $Mail){
            $Mail = preg_replace("/(?:<|&lt;).+?(?:>|&gt;)/", "", $Mail);
            $page->setCellValue("A".$i, $i);
            $page->setCellValue("B".$i, $Mail['client']);
            $page->setCellValue("C".$i, $Mail['fio']);
            $page->setCellValue("D".$i, $Mail['email']);
            if($Mail['date1'] != '0000-00-00'){
                $page->setCellValue("E".$i, date("d.m.Y",strtotime($Mail['date1'])));
            }else{
                $page->setCellValue("E".$i, '');
            }
            $page->setCellValue("F".$i, $Mail['coment1']);
            if($Mail['date2'] != 0000-00-00){
                $page->setCellValue("G".$i, date("d.m.Y",strtotime($Mail['date2'])));
            }else{
                $page->setCellValue("G".$i, '');
            }
            $page->setCellValue("H".$i, $Mail['coment2']);
            $i++;
        }
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=отчёт.xls" );
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
         return true;
    }
    function maintenanceExportGenerate(){
        require_once(HOME.'/core/PHPExcel/PHPExcel.php');
        require_once(HOME.'/core/PHPExcel/PHPExcel/Writer/Excel5.php');
        $xls = new PHPExcel();
        $page = $xls->setActiveSheetIndex(0);
        $page -> getColumnDimension('A') -> setWidth(20);
        $page -> getColumnDimension('B') -> setWidth(15);
        $page -> getColumnDimension('C') -> setWidth(60);
        $page -> getColumnDimension('D') -> setWidth(20);
        $page -> getColumnDimension('E') -> setWidth(40);
        $page -> getColumnDimension('F') -> setWidth(50);
        $page -> getColumnDimension('G') -> setWidth(10);
        $page -> getColumnDimension('H') -> setWidth(10);
        $page -> getColumnDimension('I') -> setWidth(60);
        $page->getDefaultStyle()->getFont()->setName('Times New Roman');
        $page->getDefaultStyle()->getFont()->setSize(12);
        $Db = Db::getConnect($_SESSION['filial']);
        $MaintenanceList = array();
        $date1 = date("Y-m-d",strtotime($_POST['first_date']));
        $date2 = date("Y-m-d",strtotime($_POST['last_date']));
        $MaintenanceList = Maintenance::getData(' * ',' WHERE date BETWEEN \''.$date1.'\' AND \''.$date2.'\'');
        $User = User::getUser(' WHERE dep=\'ing\'');
        $clientTypeList = Calls::getClientTypeList();
        $i = 1;
        foreach($MaintenanceList as $item){
            $item = preg_replace("/(?:<|&lt;).+?(?:>|&gt;)/", "", $item);
            $page->setCellValue("A".$i, date("d.m.Y", strtotime($item['date'])));
            $page->setCellValue("B".$i, $clientTypeList[$item['client_type']]['type']);
            $page->setCellValue("C".$i, $item['client']);
            $page->setCellValue("D".$i, $item['type']);
            $page->setCellValue("E".$i, $User[$item['ingeneer']]['short_name']);
            $page->setCellValue("F".$i, $item['place']);
            $page->setCellValue("G".$i, $item['time']);
            $page->setCellValue("H".$i, $item['price']);
            $page->setCellValue("I".$i, $item['note']);
            $i++;
        }
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save(mb_convert_encoding(HOME.'/views/export/maintenance.xls', "Windows-1251"));
         return true;
    }
}
?>
