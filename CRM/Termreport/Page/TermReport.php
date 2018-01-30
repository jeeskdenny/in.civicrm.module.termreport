<?php
use CRM_Termreport_ExtensionUtil as E;

class CRM_Termreport_Page_TermReport extends CRM_Core_Page {

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    $arg = CRM_Utils_Request::retrieve('id', 'Integer');

    CRM_Utils_System::setTitle(E::ts('TermReport'));

    $result = civicrm_api3('TermReport', 'get', array(
	  'sequential' => 1,
	  'membership_id' => $arg
	));
    
    if($result['values'])
    {
    	$i=0;
    	foreach ($result['values'] as $key => $value) {
    		$result['values'][$key]['period'] = "Term/Period " . ++$i ;
		}
    }
		
    $this->assign('result', $result);

    parent::run();
  }

}
