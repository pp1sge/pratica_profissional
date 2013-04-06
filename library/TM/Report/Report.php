<?php
/**
 *  Classe que herda as propriedades da classe PHPExcel para geração de relatórios 
 *  @author Paulo Ricardo Rangel da Silveira Monteiro
 *  @package TM_Report
 *  @version 1.0
 *  @copyright (c) 2013, Paulo Ricardo Rangel da Silveira Monteiro
 */
    
    Zend_Loader::loadFile('Classes/PHPExcel.php');
    Zend_Loader::loadFile('Classes/PHPExcel/Writer/Excel2007.php');
    class TM_Report_Report extends PHPExcel
    {
         protected $cols;
         protected $rows;
         protected $excel;
         
         /**
          *   Função que seta as propriedades da worksheet do excel.
          *   @param Array $properties 
          *   O array é lido pela função e deverá ter a seguinte formatação:
          * 
          *   $properties = array(
          *    'author'   => 'AUTOR DA PLANILHA'
          *    'title'    => 'TITULO DA PLANILHA'
          *    'description' => 'DESCRIÇÃO DA PLANILHA',
          *    'category'    => 'CATEGORIA DA PLANILHA'
          *   );
          * 
          */

         public function setProp(array $properties)
         {
             $this->getProperties()
                     ->setCreator($properties['author'])
                     ->setTitle($properties['title'])
                     ->setSubject($properties['subject'])
                     ->setDescription($properties['description'])
                     ->setCategory($properties['category']);
         }
         
         /**
          * Função que armazena o cabeçalho da planilha.
          * A função armazena cada string de cabeçalho no atributo 
          * $cols que vira um array na função
          * @param String $col
          * 
          * =======================================================
          * Exº: 
          * 
          * $report = new TM_Report_Report
          * $report->setCol('Código do Usuário');
          */
         
         public function setCol($col)
         {
             $this->cols[] = $col;
         }
         
         /**
          * Função que armazena os valores de cada cabeçalho da planilha.
          * A função armazena cada string de linha no atributo 
          * $rows que vira um array na função
          * @param String $row
          * 
          * =======================================================
          * Exº: 
          * 
          * $report = new TM_Report_Report
          * $report->setRow(string $valor_da_coluna);
          */
         
         public function setRow($row)
         {
             $this->rows[] = $row;
         }
         
         /**
          * Função que retorna o array de colunas armazenadas
          * @return array $cols
          */
         
         public function getCol()
         {
             return $this->cols;
         }
         
         /**
          * Retorna as linhas de conteúdo.
          * @return array $rows
          */
         
         public function getRow()
         {
             return $this->rows;
         }
         
         /**
          * Seta a largura da célula
          * @param String $cell
          * O parametro cell deve ter o seguinte formato:
          * 
          *  LETRA ( A - Z ) NUMERO
          * 
          * @param int $width
          * @return PHPExcel
          * 
          */
         
         public function width($cell,$width)
         {
             return $this->getActiveSheet()->getColumnDimension($cell)->setWidth($width);
         }
         
         /**
          * Função que alinha o conteúdo de uma célula
          * @param string $cell
          * @param string $alignment
          * Valores para $alignment:
          * "VERTICAL_TOP"
          * "VERTICAL_BOTTOM"
          * "VERTICAL_CENTER"
          * "VERTICAL_JUSTIFY"
          * "HORIZONTAL_CENTER"
          * "HORIZONTAL_LEFT"
          * "HORIZONTAL_JUSTIFY"
          * "HORIZONTAL_GENERAL"
          * "HORIZONTAL_RIGHT"
          */
         
         public function align($cell,$alignment)
         {
             $alignment = strtoupper($alignment);
             switch ($alignment)
             {
                 case "VERTICAL_TOP":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                 break;
                 case "VERTICAL_BOTTOM":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);        
                 break;
                 case "VERTICAL_CENTER":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                 break;
                 case "VERTICAL_JUSTIFY":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_JUSTIFY);
                 break;
                 case "HORIZONTAL_CENTER":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 break;
                 case "HORIZONTAL_LEFT":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                 break;
                 case "HORIZONTAL_GENERAL":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_GENERAL);
                 break;
                 case "HORIZONTAL_JUSTIFY":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
                 break;
                 case "HORIZONTAL_RIGHT":
                     $this->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                 break;

             }
         }
         public function setFontFace($cell,$font)
         {
             $this->getActiveSheet()->getStyle($cell)->getFont()->setName($font);
         }
         public function setFontWeight($cell,$formatacao)
         {
             $formatacao = strtoupper($formatacao);
             
             switch($formatacao){
             
              case "NEGRITO":
                 $this->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
              break;
              case "ITALICO":
                  $this->getActiveSheet()->getStyle($cell)->getFont()->setItalic(true);
              break;
              case "SUBLINHADO":
                  $this->getActiveSheet()->getStyle($cell)->getFont()->setUnderline(true);
              break;
                  
             }
             
         }
         public function setFontSize($cell,$size)
         {
             $this->getActiveSheet()->getStyle($cell)->getFont()->setSize($size);
         }
         public function setCellFill($cell,$color_hexadecimal,$fill_type)
         {
           $filters = array(
               'fill' => array(
                   'type' => PHPExcel_Style_Fill::$fill_type,
                   'color' => $color_hexadecimal
               ),
           );
           $this->getActiveSheet()->getStyle($cell)->applyFromArray($filters);
         }
         public function setFontColor($cell,$color_hexadecimal)
         {
           $FontColor = new PHPExcel_Style_Color();
           $FontColor->setARGB($color_hexadecimal);
           $this->getActiveSheet()->getStyle($cell)->getFont()->setColor($FontColor);
         }
         public function setWorkSheetTitle($title)
         {
           $this->getActiveSheet()->setTitle($title);
         }
         public function setContent()
         {
             $alfabeto = array();
             $data = date('d-m-Y');
             for($i = 65 ; $i <= 91 ; $i++)
             {
                 $alfabeto[] = chr($i);
             }
             
             // Primeiro coloca o cabecalho
             foreach($this->cols as $i => $value){
                $this->getActiveSheet()->setCellValue($alfabeto[$i] . "1", $value); 
             }
             $iteracoesAlfabeto = ceil(sizeof($this->rows) / sizeof($this->cols));
             // Depois coloca o conteudo
                     $f = 0;
                     $k = 0;
                     for($i = 2 ; $i <= sizeof($this->cols) ; $i++){
                       if($f == $iteracoesAlfabeto)
                       {
                           break;
                       }
                       for($j = 0 ; $j < sizeof($this->cols) ; $j++){
                           $letra = $alfabeto[$j];
                           if($this->cols[$j] == "Preço" || $this->cols[$j] == "Preço Total")
                           {
                               $this->getActiveSheet()->setCellValue($letra . $i,$this->rows[$k]);
                               $this->getActiveSheet()->getStyle($letra . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
                           
                               
                           }
                           $preco = 0;
                            if($this->cols[$j] == "Preço Total" || $this->cols[$j] == "Preço")
                               {
                                   $flag_total = $alfabeto[(int)($j - 5)];
                                   $preco += $this->rows[$k];
                                   $this->getActiveSheet()->setCellValue($flag_total .(int)($j+7),"Total:");
                                   $this->getActiveSheet()->setCellValue($alfabeto[(int)($j - 4)] . (int)($j+7),$preco);
                                   $this->getActiveSheet()->getStyle($alfabeto[(int)($j - 4)] . (int)($j+7))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
                                   $this->setFontFace($alfabeto[(int)($j - 4)] . (int)($j+7), "times new roman");
                                   $this->setFontFace($flag_total . (int)($j+7), "times new roman");
                                   $this->setFontWeight($flag_total . (int)($j+7), "negrito");
                                   $this->width($flag_total, 60);
                                   $this->align($alfabeto[(int)($j - 4)] . (int)($j+7), "horizontal_center");
                                   $filtro = array(
                                        'borders' => array(
                                         'top' => array(
                                             'style' => PHPExcel_Style_Border::BORDER_THIN,
                                         ),
                                        'left' => array(
                                         'style' => PHPExcel_Style_Border::BORDER_THIN,
                                        ),
                                        'right' => array(
                                         'style' => PHPExcel_Style_Border::BORDER_THIN,
                                        ),
                                        'bottom' => array(
                                         'style' => PHPExcel_Style_Border::BORDER_THIN,
                                        ),
                                        )
                                      );
                                   $this->getActiveSheet()->getStyle($flag_total  . (int)($j+7))->applyFromArray($filtro);
                                   $this->getActiveSheet()->getStyle($alfabeto[(int)($j - 4)] . (int)($j+7))->applyFromArray($filtro);
                                   $this->getActiveSheet()->mergeCells($flag_total  . (int)($j+4) . ":" . $alfabeto[(int)($j - 4)] . (int)($j+5));
                                   $this->getActiveSheet()->getStyle($flag_total  . (int)($j+4) . ":" . $alfabeto[(int)($j - 4)] . (int)($j+5))->applyFromArray($filtro);
                                   $this->getActiveSheet()->setCellValue($flag_total  . (int)($j+4),"Balanço:");
                                   $this->setFontFace($flag_total . (int)($j+4), "times new roman");
                                   $this->setFontWeight($flag_total . (int)($j+4), "negrito");
                                   $this->align($flag_total . (int)($j+4), "vertical_center");
                                   $this->setFontSize($flag_total . (int)($j+4), 20);


                                   
                               }
                                                                  $quantidade = 0;

                               if($this->cols[$j] == "Quantidade")
                               {
                                   $flag_total1 = $alfabeto[(int)($j - 3)];
                                   $quantidade += $this->rows[$k];
                                   $this->getActiveSheet()->setCellValue($flag_total1 .(int)($j+8),"Produtos:");
                                   $this->getActiveSheet()->setCellValue($alfabeto[(int)($j - 2)] . (int)($j+8),$quantidade);
                                   $this->setFontFace($alfabeto[(int)($j - 2)] . (int)($j+8), "times new roman");
                                   $this->setFontFace(($flag_total1 .(int)($j+8)), "times new roman");
                                   $this->setFontWeight($flag_total1 . (int)($j+8), "negrito");

                                   $this->width($flag_total1, 60);
                                   $this->align($alfabeto[(int)($j - 2)] . (int)($j+8), "horizontal_center");
                                    $filtro = array(
                                        'borders' => array(
                                         'top' => array(
                                             'style' => PHPExcel_Style_Border::BORDER_THIN,
                                         ),
                                        'left' => array(
                                         'style' => PHPExcel_Style_Border::BORDER_THIN,
                                        ),
                                        'right' => array(
                                         'style' => PHPExcel_Style_Border::BORDER_THIN,
                                        ),
                                        'bottom' => array(
                                         'style' => PHPExcel_Style_Border::BORDER_THIN,
                                        ),
                                        )
                                      );
                                   $this->getActiveSheet()->getStyle($flag_total1  . (int)($j+8))->applyFromArray($filtro);
                                   $this->getActiveSheet()->getStyle($alfabeto[(int)($j - 2)] . (int)($j+8))->applyFromArray($filtro);


                               }
                               $this->getActiveSheet()->setCellValue($letra . $i,$this->rows[$k]);
                           
                                $this->getActiveSheet()->getColumnDimension($alfabeto[$j])->setWidth(40);
                                $this->align($alfabeto[$j] . $i, "horizontal_center");
                                $this->align($alfabeto[$j] . "1", "horizontal_center");


                                $fill = array(
                                  'fill' => array(
                                     'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                     'color' => array('rgb'=>'000')
                                 )
                               
                          );
                           if($i % 2 != 0){
                                $FontColor = new PHPExcel_Style_Color();
                                $FontColor->setARGB("FFF");
                                $this->getActiveSheet()->getStyle($alfabeto[$j] . $i)->getFont()->setColor($FontColor);
                                $this->getActiveSheet()->getStyle($alfabeto[$j] . $i)->applyFromArray($fill);
                           }
                           $k++;
                    }
                    $f++;
                 }
          }
          public function saveReport(PHPExcel $obj1)
          {
              $url = new Zend_View_Helper_BaseUrl;
              $filename = $url->baseUrl('relatorio.xls');
              try{
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Transfer-Encoding: binary ");               
                $objSave = new PHPExcel_Writer_Excel5($obj1);
                $objSave->save($filename);
                echo json_encode(array(
                        "File" => $filename
                        ));
              }catch(PHPExcel_Exception $e)
              {
                   var_dump($e->getMessage());
              }
          }
         
    }
