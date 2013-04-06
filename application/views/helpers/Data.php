<?php


	class Dashboard_View_Helper_Data extends Zend_View_Helper_Abstract
	{
		
		public function data($data)
		{
			$tratar = explode("-",$data);
			$date = new Zend_Date(array('month'=>$tratar[1],'year'=>$tratar[0],'day'=>$tratar[2]));
			return $date->toString('d/MM/y',null,"pt_BR");
			
		}		
	}
