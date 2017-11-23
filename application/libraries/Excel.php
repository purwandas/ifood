<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";
require_once APPPATH.'/third_party/PHPExcel/Cell/AdvancedValueBinder.php';

class Excel extends PHPExcel {
  private $excel;
    public function __construct() {
        parent::__construct();
        PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
    }
    public function downloadReportOutOfStock($data,$val)
        {
           $this->excel = new PHPExcel();

           $this->excel->setActiveSheetIndex(0);
           $this->excel->getActiveSheet()->setTitle('Out Of Stock Report');

           $this->excel->getActiveSheet()->setCellValue('A1', 'CABANG');
           
           $this->excel->getActiveSheet()->setCellValue('B1', 'KOTA');
           
           $this->excel->getActiveSheet()->setCellValue('C1', 'CUSTOMER ID');
           
           $this->excel->getActiveSheet()->setCellValue('D1', 'NAMA TOKO');
           
           $this->excel->getActiveSheet()->setCellValue('E1', 'NAMA BA');

           $this->excel->getActiveSheet()->setCellValue('F1', 'TANGGAL');

           $this->excel->getActiveSheet()->setCellValue('G1', 'LIST OUT OF STOCK');

           $this->excel->getActiveSheet()->setCellValue('H1', 'TIPE');

           $this->excel->getActiveSheet()->setCellValue('I1', 'KETERANGAN');

           // $this->excel->getActiveSheet()->setCellValue('J1', 'TIME ELAPSED');

           // $this->excel->getActiveSheet()->fromArray($result);
           $this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
           $this->excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '#aed8fc')
                ),
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#000000'),
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              ),
            )
            );
            // $this->excel->getDefaultStyle()->getAlignment()->setWrapText(true);
            $this->excel->getDefaultStyle()
              ->getAlignment()
              ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
              ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $no_col = 2;
            foreach ($val as $datatable) {
              // echo $datatable[]['dayAgo'];
              $this->excel->getActiveSheet()->setCellValue('N1', 'Data OOS');
              // $this->excel->getActiveSheet()->mergeCells('M1:O1');
              $this->excel->getActiveSheet()->setCellValue("A".$no_col, $datatable->namaCabang);

              $this->excel->getActiveSheet()->setCellValue("B".$no_col, $datatable->nama_kota);

              $this->excel->getActiveSheet()->setCellValue("C".$no_col, $datatable->store_id);

              $this->excel->getActiveSheet()->setCellValue("D".$no_col, $datatable->namaToko);

              $this->excel->getActiveSheet()->setCellValue("E".$no_col, $datatable->namaBa);

              $this->excel->getActiveSheet()->setCellValue("F".$no_col, $datatable->date);

              $this->excel->getActiveSheet()->setCellValue("G".$no_col,$datatable->nama_produk); 
            
              $this->excel->getActiveSheet()->setCellValue("H".$no_col,$datatable->tipe);

              $this->excel->getActiveSheet()->setCellValue("I".$no_col,$datatable->keterangan);

              // // $this->excel->getActiveSheet()->setCellValue("J".$no_col, $datatable->dayAgo);

              $no_col++;
          }
           $filename='Out_of_stock_report-'.date("d-M-Y:h:i:s").'.xls';
           header('Content-Disposition: attachment;filename="'.$filename.'"');
           header('Cache-Control: max-age=0');
           $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
           $objWriter->save('php://output');
        }
        public function downloadtotalcontact($data,$val)
        {
          $this->excel = new PHPExcel();
           $this->excel->setActiveSheetIndex(0);
           $this->excel->getActiveSheet()->setTitle('Total Contact Report');
           $this->excel->getActiveSheet()->setCellValue('A1', 'Cabang');
           $this->excel->getActiveSheet()->mergeCells('A1:A2');
           $this->excel->getActiveSheet()->setCellValue('B1', 'Nama BA');
           $this->excel->getActiveSheet()->mergeCells('B1:B2');
           $this->excel->getActiveSheet()->setCellValue('C1', 'Status ( Mobile / Stay )');
           $this->excel->getActiveSheet()->mergeCells('C1:C2');
           $this->excel->getActiveSheet()->setCellValue('D1', 'Customer Id');
           $this->excel->getActiveSheet()->mergeCells('D1:D2');
           $this->excel->getActiveSheet()->setCellValue('E1', 'Nama Store');
           $this->excel->getActiveSheet()->mergeCells('E1:E2');

           $this->excel->getActiveSheet()->setCellValue('F1', 'Contact');
           $this->excel->getActiveSheet()->mergeCells('F1:H1');
           $this->excel->getActiveSheet()->setCellValue('F2', 'Contact');
           $this->excel->getActiveSheet()->setCellValue('G2', 'Switching');
           $this->excel->getActiveSheet()->setCellValue('H2', 'New Recruit');

           $this->excel->getActiveSheet()->setCellValue('I1', 'Sampling');
           $this->excel->getActiveSheet()->mergeCells('I1:M1');
           $this->excel->getActiveSheet()->setCellValue('I2', 'BC');
           $this->excel->getActiveSheet()->setCellValue('J2', 'BTI');
           $this->excel->getActiveSheet()->setCellValue('K2', 'RUSK');
           $this->excel->getActiveSheet()->setCellValue('L2', 'Pudding');
           $this->excel->getActiveSheet()->setCellValue('M2', 'Others');
           
           $this->excel->getActiveSheet()->setCellValue('N1', 'Strike Sampling');
           $this->excel->getActiveSheet()->mergeCells('N1:R1');
           $this->excel->getActiveSheet()->setCellValue('N2', 'BC');
           $this->excel->getActiveSheet()->setCellValue('O2', 'BTI');
           $this->excel->getActiveSheet()->setCellValue('P2', 'RUSK');
           $this->excel->getActiveSheet()->setCellValue('Q2', 'Pudding');
           $this->excel->getActiveSheet()->setCellValue('R2', 'Others');

           $this->excel->getActiveSheet()->setCellValue('S1', 'TANGGAL CONTACT');
           $this->excel->getActiveSheet()->mergeCells('S1:S2');

           $this->excel->getActiveSheet()->getStyle('F2:H2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '#ffce44')
                ),
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#000000'),
                  ),
                ),
            )
            );
            $style = array(
              'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              )
          );

          $this->excel->getActiveSheet()->getStyle('F2:H2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '#ffce44')
                ),
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#000000'),
                  ),
                ),
            )
            );
            $style = array(
              'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              )
          );
          $this->excel->getActiveSheet()->getStyle('I2:M2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '#db0d15')
                ),
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#000000'),
                  ),
                ),
            )
            );
            $style = array(
              'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              )
          );

          $this->excel->getActiveSheet()->getStyle('N2:R2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '#ff0000')
                ),
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#000000'),
                  ),
                ),
            )
            );
            $style = array(
              'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              )
          );


          // $this->excel->getActiveSheet()->fromArray($result);
          $this->excel->getActiveSheet()->getStyle("E1:I1")->applyFromArray($style);
           // $this->excel->getActiveSheet()->fromArray($result);
           $this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
           $this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '#aed8fc')
                ),
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#000000'),
                  ),
                ),
            )
            );
            // $this->excel->getDefaultStyle()->getAlignment()->setWrapText(true);
            $this->excel->getDefaultStyle()
              ->getAlignment()
              ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
              ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $cabang_column = "A";
          $no_col = 3;
          $jml = $no_col+$data;
          
          foreach ($val as $ks) {

              $this->excel->getActiveSheet()->setCellValue($cabang_column.$no_col, $ks->nama_cabang);
              $this->excel->getActiveSheet()->setCellValue("B".$no_col, $ks->nama_ba);
              if ($ks->stay=="Y") {
                $this->excel->getActiveSheet()->setCellValue("C".$no_col, "Stay");
              }
              if($ks->stay=="N"){
                $this->excel->getActiveSheet()->setCellValue("C".$no_col, "Mobile");
              }
              $this->excel->getActiveSheet()->setCellValue("D".$no_col, $ks->customer_id);
              $this->excel->getActiveSheet()->setCellValue("E".$no_col, $ks->nama_store);
              $this->excel->getActiveSheet()->setCellValue("F".$no_col, $ks->contact_count);
              $this->excel->getActiveSheet()->setCellValue("G".$no_col, $ks->switching);
              $this->excel->getActiveSheet()->setCellValue("H".$no_col, $ks->newRecruit);

              if ($ks->sampling_bc==null) {
                $this->excel->getActiveSheet()->setCellValue("I".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("I".$no_col, $ks->sampling_bc);  
              }
              if ($ks->sampling_bti==null) {
                $this->excel->getActiveSheet()->setCellValue("J".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("J".$no_col, $ks->sampling_bti);  
              }
              if ($ks->sampling_rusk==null) {
                $this->excel->getActiveSheet()->setCellValue("K".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("K".$no_col, $ks->sampling_rusk);  
              }
              if ($ks->sampling_pudding==null) {
                $this->excel->getActiveSheet()->setCellValue("L".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("L".$no_col, $ks->sampling_pudding);  
              }
              if ($ks->sampling_others==null) {
                $this->excel->getActiveSheet()->setCellValue("M".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("M".$no_col, $ks->sampling_others);  
              }
              if ($ks->strike_bc==null) {
                $this->excel->getActiveSheet()->setCellValue("N".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("N".$no_col, $ks->strike_bc);  
              }
              if ($ks->strike_bti==null) {
                $this->excel->getActiveSheet()->setCellValue("O".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("O".$no_col, $ks->strike_bti);  
              }
              if ($ks->strike_rusk==null) {
                $this->excel->getActiveSheet()->setCellValue("P".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("P".$no_col, $ks->strike_rusk);  
              }
              if ($ks->strike_pudding==null) {
                $this->excel->getActiveSheet()->setCellValue("Q".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("Q".$no_col, $ks->strike_pudding);  
              }
              if ($ks->strike_others==null) {
                $this->excel->getActiveSheet()->setCellValue("R".$no_col, "0");
              }
              else{
                $this->excel->getActiveSheet()->setCellValue("R".$no_col, $ks->strike_others);

                  
              }
              $this->excel->getActiveSheet()->setCellValue("S".$no_col, date('d-m-Y',strtotime($ks->tgl_contact)));
              
            // echo $ks->nama_kota;
              $no_col++;
          }
           $filename='total_contact_'.date("d-M-Y:h:i:s").'.xls';
           header('Content-Disposition: attachment;filename="'.$filename.'"');
           header('Cache-Control: max-age=0');
           $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
           $objWriter->save('php://output');
        }
        public function downloadreportpromo($keys,$value){
          $this->excel = new PHPExcel();
           $this->excel->setActiveSheetIndex(0);
           $this->excel->getActiveSheet()->setTitle('Total Contact Report');
           $this->excel->getActiveSheet()->setCellValue('A1', 'CABANG');
           
           $this->excel->getActiveSheet()->setCellValue('B1', 'KOTA');
           
           $this->excel->getActiveSheet()->setCellValue('C1', 'CUSTOMER CODE');
           
           $this->excel->getActiveSheet()->setCellValue('D1', 'NAMA STORE');
           
           $this->excel->getActiveSheet()->setCellValue('E1', 'NAMA BA');

           $this->excel->getActiveSheet()->setCellValue('F1', 'NAMA TL');

           $this->excel->getActiveSheet()->setCellValue('G1', 'TIPE PROMO');

           $this->excel->getActiveSheet()->setCellValue('H1', 'JENIS PROMO');

           $this->excel->getActiveSheet()->setCellValue('I1', 'KETERANGAN PROMINA');

           $this->excel->getActiveSheet()->setCellValue('J1', 'KETERANGAN KOMPETITOR');

           $this->excel->getActiveSheet()->setCellValue('K1', 'PERIODE MULAI');

           $this->excel->getActiveSheet()->setCellValue('L1', 'PERIODE SELESAI');

           $this->excel->getActiveSheet()->setCellValue('M1', 'PERIODE TANGGAL');


           $this->excel->getActiveSheet()->setCellValue('O1', 'FOTO KOMPETITOR');

           
           
           // $this->excel->getActiveSheet()->fromArray($result);
           $this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
           $this->excel->getActiveSheet()->getStyle('A1:O1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '#aed8fc')
                ),
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#000000'),
                  ),
                ),
            )
            );
            // $this->excel->getDefaultStyle()->getAlignment()->setWrapText(true);
          $this->excel->getDefaultStyle()
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

          $no_col = 2;

          foreach ($value as $datatable) {
    
              $this->excel->getActiveSheet()->setCellValue('N1', 'FOTO PROMINA');
              // $this->excel->getActiveSheet()->mergeCells('M1:O1');
              $this->excel->getActiveSheet()->setCellValue("A".$no_col, $datatable->nama_cabang);

              $this->excel->getActiveSheet()->setCellValue("B".$no_col, $datatable->nama_kota);

              $this->excel->getActiveSheet()->setCellValue("C".$no_col, $datatable->store_id);

              $this->excel->getActiveSheet()->setCellValue("D".$no_col, $datatable->nama_toko);

              $this->excel->getActiveSheet()->setCellValue("E".$no_col, $datatable->nama_user);

              if ($datatable->tipe == "consumerPromo") {
                $row = "Consumer Promo";
              }
              if ($datatable->tipe == "secondaryDisplay") {
                $row = "Secondary Display";
              }
              if ($datatable->tipe == "activation") {
                $row = "Activation";
              }
              if($datatable->nama_tl == null){
                $rows = "Tidak ada TL";
              }
              else{
                $rows = $datatable->nama_tl;
              }
              $this->excel->getActiveSheet()->setCellValue("F".$no_col, $rows);

              $this->excel->getActiveSheet()->setCellValue("G".$no_col, $row);

              $this->excel->getActiveSheet()->setCellValue("H".$no_col, $datatable->jenis);

              $this->excel->getActiveSheet()->setCellValue("I".$no_col, $datatable->keteranganPromina);

              $this->excel->getActiveSheet()->setCellValue("J".$no_col, $datatable->keteranganKomptetitor);

              $this->excel->getActiveSheet()->setCellValue("K".$no_col, $datatable->awalTanggal);

              $this->excel->getActiveSheet()->setCellValue("L".$no_col, $datatable->selesaiTanggal);

              $this->excel->getActiveSheet()->setCellValue("M".$no_col, $datatable->timestamp);

              $foto_promina = explode(',', $datatable->promina_foto);
              $foto_kompetitor = explode(',', $datatable->kompetitor_foto);
          // //     $objDrawing = new PHPExcel_Worksheet_Drawing();
          // //     $objDrawing->setName('test_img');
          // //     $objDrawing->setDescription('test_img');                       
          // //     // $sheet = $this->excel->setSheetIndexAndTitle(1, "YOUR_SHEET_TITLE");
          // //     // $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
              foreach ($foto_promina as $key => $value) {
          // echo $value;
                $promina[] = base_url().'assets/upload/'.$value;
              }
              $d = implode("\n\n", $promina);
              foreach ($foto_kompetitor as $key => $value) {
                $kompetitor[] = base_url().'assets/upload/'.$value;
              }
              $da = implode("\n\n", $kompetitor);
          //     $img = imagecreatefromstring($promina);
          //     $objDrawing->setPath('assets/upload/google.png');
          //     $objDrawing->setPath('assets/upload/googleahahaha.png');
              
          //     $objDrawing->setCoordinates('M'.$no_col);
          //     $objDrawing->setWorksheet($this->excel->getActiveSheet());
              $this->excel->getActiveSheet()->setCellValue("N".$no_col, $d);
              $this->excel->getActiveSheet()->setCellValue("O".$no_col, $da);
              // $this->excel->getActiveSheet()->fromArray($foto_promina, NULL , "M".$no_col);

              // $this->excel->getActiveSheet()->setCellValue("N".$no_col, $datatable->);

              $no_col++;
          }
           $filename='report_promo_'.date("d-M-Y:h:i:s").'.xls';
           header('Content-Disposition: attachment;filename="'.$filename.'"');
           header('Cache-Control: max-age=0');
           $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
           $objWriter->save('php://output');
        }

        public function downloadSkuReport($result)
        {
          $this->excel = new PHPExcel();
          $this->excel->setActiveSheetIndex(0);
          $this->excel->getActiveSheet()->setTitle('Sku Report');
          $this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
          $this->excel->getActiveSheet()->fromArray($result);
          // $this->excel->getActiveSheet()->getStyle('A1:R2')->applyFromArray(
          //  array(
          //      'fill' => array(
          //          'type' => PHPExcel_Style_Fill::FILL_SOLID,
          //          'color' => array('rgb' => '#aed8fc')
          //      ),
          //      'borders' => array(
          //        'allborders' => array(
          //          'style' => PHPExcel_Style_Border::BORDER_THIN,
          //          'color' => array('rgb' => '#000000'),
          //        ),
          //      ),
          //  )
          //  );
           $this->excel->getDefaultStyle()
             ->getAlignment()
             ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

          $filename='Sku_report.xls';
          header('Content-Disposition: attachment;filename="'.$filename.'"');
          header('Cache-Control: max-age=0');
          $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
          $objWriter->save('php://output');

        }


}
