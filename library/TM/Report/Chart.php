<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chart
 *
 * @author Paulo
 */
class TM_Report_Chart {
    
    private $_container;
    private $_title;
    private $_subtitle;
    private $_yAxis;
    private $_series;
    
    function __construct($conf,$series)
    {
        $this->_title = $conf['title'][0];
        $this->_subtitle = $conf['title'][1];
        $this->_container = $conf['container'];
        $this->_series = $series;
        $this->_yAxis = $conf['y'];
    }
    public function render()
    {
        $series = array();
        $data = array();
        $axis = array();
        foreach($this->_series as $key => $row){  
            $data[$key] = array();
            foreach($row as $_row){
                //var_dump($_row);
              $axis[] = "'".$_row['data']."'";
              $data[$key][] = $_row['total'];
             }
        }
       
        $axis =  implode(",",$axis);
        //echo $axis1;
        //var_dump($axis);exit;
        foreach($data as $key => $row){
            $i = implode(",",$row);
            $series[] = "{name:'Compra',data:[{$i}]}";
        }
             $series1 = implode(",",$series);
             //var_dump($series1);exit;
             
             $str = "chart = new Highcharts.Chart({
               chart: {
                  renderTo: '{$this->_container}',
                  defaultSeriesType: 'bar',
                  marginRight: 130,
                  marginBottom: 25
               },
               title: {
                  text: '{$this->_title}',
                  x: -20 //center
               },
               subtitle: {
                  text: '{$this->_subtitle}',
                  x: -20
               },
               xAxis: {
                  categories: [{$axis}]
               },
               yAxis: {
                  title: {
                     text: '{$this->_yAxis['title']}'
                  },
                  plotLines: [{
                     value: 0,
                     width: 1,
                     color: '#808080'
                  }]
               },
               tooltip: {
                  formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                  }
               },
               legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'top',
                  x: -10,
                  y: 100,
                  borderWidth: 0
               },
               series: [{$series1}]
            });
      ";
      //Lembra que falei do LiveScript?
      //Header::addLiveScript( $str );
      return $str;
   } 
    
}

?>
