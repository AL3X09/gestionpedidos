<?php

/**
 * @author hectorLeon
 */
class ControladorExporte extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper(array('url', 'form', 'array', 'html'));
    $this->load->model(array('', ''));
    $this->load->library('excel');
  }

  public function removeCache() {
    $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
    $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
    $this->output->set_header('Pragma: no-cache');
  }

  function index() {
    //$this->load->view('layout/header');
    //$this->load->view('paginas/modulo-estadistico/modulo-estadistico');
    //$this->load->view('layout/pie-pagina-inicio');
  }
  
  /**
   * @AUTHOR Alex Cifuentes
   * genero excel cantidades totales 
   * aspirantes incritos en todos los procesos
   */
  function exportarCantidades() {

    $datos = $_POST['data'];
    
      $grafica=$_POST['grafica'];
      //trabajo la imagen para poder exportarla al excel la carpeta temp es relativa
      list($type, $grafica) = explode(';', $grafica);
      list(, $grafica)      = explode(',', $grafica);
      $data = base64_decode($grafica);
      file_put_contents('other/temp/grafica.png', $data); 
    //FIN trabajo la imagen para poder exportarla al excel

    $phpExcel = new PHPExcel();

    // SET TITLES
    $phpExcel->getActiveSheet()->SetCellValue('H1', 'CANTIDAD DE PRODUCTOS');


    // MERGE CELLS
    $phpExcel->getActiveSheet()->mergeCells('A1:B1');
    $phpExcel->getActiveSheet()->mergeCells('A2:B2');
    $phpExcel->getActiveSheet()->mergeCells('A5:D5');

    // ADD COLUMNS TITLES
    $phpExcel->getActiveSheet()->SetCellValue('A6', 'NOMBRE');
    $phpExcel->getActiveSheet()->SetCellValue('B6', 'CANTIDAD');
    $phpExcel->getActiveSheet()->SetCellValue('C6', 'VENDIDOS');

    $phpExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $phpExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $phpExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

    $fila = 7;
    $color = '';
    $sumaTotal = 0;
    for ($i = 0; $i < count($datos); $i++) {

      $phpExcel->getActiveSheet()->SetCellValue('A' . $fila, $datos[$i]['nombre']);
      $phpExcel->getActiveSheet()->SetCellValue('B' . $fila, $datos[$i]['cantidad']);
      $phpExcel->getActiveSheet()->SetCellValue('C' . $fila, $datos[$i]['unidades_vendidas']);

      /* CAMBIAR FUENTE, AGREGAR BORDES Y CENTRAR CELDAS */
      $styleArray = array(
        'font' => array(
          'bold' => true,
          'color' => array('rgb' => 'FFFFFF'),
          'size' => 13,
        //'name' => 'Verdana'
        ),
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'DDDDDD')
          )
        ),
        'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
      );

      $fila++;
    }
    
    //colores cabeceras
    $styleArray2 = array(
      'font' => array(
        'bold' => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size' => 13,
      //'name' => 'Verdana'
      ),
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => '000000')
        )
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      )
    );

    $styleArray3 = array(
      'font' => array(
        'bold' => false,
        'color' => array('rgb' => '000000'),
        'size' => 13,
      //'name' => 'Verdana'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      )
    );

    $phpExcel->getActiveSheet()->getStyle('A6:C6')->applyFromArray($styleArray2);
    /* COLOR TITULOS TABLA EXCEL */
    $phpExcel->getActiveSheet()
            ->getStyle('A6:C6')
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('002060');


    $Drawing = new PHPExcel_Worksheet_Drawing();
    $Drawing->setName('Logo');
    $Drawing->setDescription('Logo');
    $Drawing->setPath('img/A.png');
    $Drawing->setHeight(56);
    $Drawing->setWidth(56);
    $Drawing->setCoordinates('A1');
    $Drawing->setWorksheet($phpExcel->getActiveSheet());
    //DIBUJO LA GRAFICA EN UNA CELDA
    
      $Drawing = new PHPExcel_Worksheet_Drawing();
      $Drawing->setName('Grafica');
      $Drawing->setDescription('Grafica');
      $Drawing->setPath('other/temp/grafica.png');
      $Drawing->setHeight(800);
      $Drawing->setWidth(800);
      $Drawing->setCoordinates('E3');
      $Drawing->setWorksheet($phpExcel->getActiveSheet());
     
    // SAVE EXCEL
    $objWriter = new PHPExcel_Writer_Excel2007($phpExcel);
    $nombre = 'Cantidad_productos.xlsx';
    $objWriter->save('other/reportes/' . $nombre . '');
    //echo date('H:i:s') . " Done writing file.\r\n";
    echo '<a href="' . base_url() . 'other/reportes/' . $nombre . '" target="_blank"><img style="scroll: 10px center;" src="' . base_url() . 'Content/excel.png"> Descargar Reporte</a>';

    exit;
  }



  
//FIN AGREGA ALEX
}
