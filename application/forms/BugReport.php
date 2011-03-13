<?php

class Application_Form_BugReport extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
		//Id: Hidden
		$id = new Zend_Form_Element_Hidden('id');
		
		//Author : Text
		$author = new Zend_Form_Element_Text('author');
		$author->setLabel('Enter your name:')
			->setAttrib('size', 30)
			->setRequired(TRUE)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');

		//Email : Text-EMail
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Your email address:')
			->setRequired(TRUE)
			->addValidator(new Zend_Validate_EmailAddress())
			->addFilters(array(
				new Zend_Filter_StringTrim(),
				new Zend_Filter_StringToLower()
				))
			->setAttrib('size', 40);		 

		//Date : Text-Date
		$date = new Zend_Form_Element_Text('date');
		$date->setLabel('Date the issue occurred (mm-dd-yyyy):')
			->setRequired(TRUE)
			->addValidator(new Zend_Validate_Date('MM-DD-YYYY'))
			->setAttrib('size',20);	
			
		//Url : Text-Url
		$url = new Zend_Form_Element_Text('url');
		$url->setLabel('Issue URL:')
			->setRequired(TRUE)
			->setAttrib('size',50);		
			
		//Description : Text Area
		$description = new Zend_Form_Element_TextArea('description');
		$description->setLabel('Issue description:')
			->setRequired(TRUE)
			->setAttrib('cols',50)
			->setAttrib('rows',4);

		//Priority: Select Box
		$priority = new Zend_Form_Element_Select('priority');
		$priority->setLabel('Issue priority:')
			->setRequired(TRUE)
			->addMultiOptions(array(
				'low' => 'Low',
				'med' => 'Medium',
				'high' => 'High'
				));		

		//Status : Select Box
		$status = new Zend_Form_Element_Select('status');
		$status->setLabel('Current status:')
			->setRequired(TRUE)
			->addMultiOption('new', 'New')
			->addMultiOption('in_progress', 'In Progress')
			->addMultiOption('resolved', 'Resolved');		
		
		//Submit : Submit
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
		
        $this->addElements(array($id, $author, $email, $date, $url, $description, $priority, $status, $submit));		
    }


}

