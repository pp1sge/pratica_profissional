<?php

    class TM_Form_Search extends Zend_Form
    {
    	protected $search;
        public function init()
        {
            $this->setName('form-search');
            $url = new Zend_View_Helper_Url();
            $this->setAction($url->url(array('controller'=>'produto','action'=>'search','module'=>'dashboard'),null,true));
            $this->search = new Zend_Form_Element_Text('search');
            $this->search->addFilter("StripTags")
                   ->addFilter("StringTrim")
                   ->setAttrib('id','search')
                   ->setAttrib('placeholder', 'Nome ou codigo..');
            $this->addElement($this->search);
            $button = new Zend_Form_Element_Button('Buscar');
            $button->setAttrib('id', 'srbt');
            $button->setAttrib('class', 'alt_btn');
            $this->addElement($button);
            
        }
		public function getSearch()
		{
			return $this->search;
		}
    }
?>
