<?php
use CRM_Termreport_ExtensionUtil as E;

class CRM_Termreport_BAO_TermReport extends CRM_Termreport_DAO_TermReport {

  /**
   * Create a new TermReport based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Termreport_DAO_TermReport|NULL
   *
   */
  public static function create($params) {
    $className = 'CRM_Termreport_DAO_TermReport';
    $entityName = 'TermReport';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } 


  /**
   * 
   *
   * @param array $params (reference) an assoc array of name/value pairs
   * @param array $defaults (reference) an assoc array to hold the flattened values
   *
   * @return object CRM_Civitermreport_DAO_CiviTermReport object on success, null otherwise
   * @access public
   * @static
   */
  static function retrieve(&$params, &$defaults) {
    $item = new CRM_Termreport_DAO_TermReport();
    $item->copyValues($params);
    if ($item->find(TRUE)) {
      CRM_Core_DAO::storeValues($item, $defaults);
      return $item;
    }
    return NULL;
  }

  /**
   * Function to delete renewal Term Report
   *
   * @param  int $civitermreportID ID of the Term to be deleted.
   *
   * @access public
   * @static
   * @return true on success else false
   */
  static function del($civitermreportID) {
    if (!CRM_Utils_Rule::positiveInteger($civitermreportID)) {
      return FALSE;
    }

    $item = new CRM_Termreport_DAO_TermReport();
    $item->id = $civitermreportID;
    $item->delete();

    return TRUE;
  }


}
