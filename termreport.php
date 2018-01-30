<?php

require_once 'termreport.civix.php';
use CRM_Termreport_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function termreport_civicrm_config(&$config) {
  _termreport_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function termreport_civicrm_xmlMenu(&$files) {
  _termreport_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function termreport_civicrm_install() {
  _termreport_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function termreport_civicrm_postInstall() {
  _termreport_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function termreport_civicrm_uninstall() {
  _termreport_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function termreport_civicrm_enable() {
  _termreport_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function termreport_civicrm_disable() {
  _termreport_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function termreport_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _termreport_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function termreport_civicrm_managed(&$entities) {
  _termreport_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function termreport_civicrm_caseTypes(&$caseTypes) {
  _termreport_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function termreport_civicrm_angularModules(&$angularModules) {
  _termreport_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function termreport_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _termreport_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function termreport_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function termreport_civicrm_navigationMenu(&$menu) {
  _termreport_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _termreport_civix_navigationMenu($menu);
} // */

/**
 * Implementation of hook_civicrm_entityTypes
 */
function termreport_civicrm_entityTypes(&$entityTypes) {
  $entityTypes['CRM_CiviDiscount_DAO_Item'] = array(
    'name' => 'TermReport',
    'class' => 'CRM_Termreport_DAO_TermReport',
    'table' => 'civicrm_termreport'
  );
}

/**
 * Implementation of hook_civicrm_post
 */
function termreport_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if ($objectName == 'Membership' && $op == 'create') {
    $termParams['membership_id'] = $objectId;
    $termParams['start_date'] = $objectRef->start_date;
    $termParams['end_date'] = $objectRef->end_date;
    civicrm_api3('TermReport', 'create', $termParams);
  }
}

/**
 * Implementation of hook_civicrm_pre
 */
function termreport_civicrm_pre($op, $objectName, $id, &$params){
  if ($objectName == 'Membership' && $op == 'edit') {
    $result = civicrm_api3('Membership', 'get', array(
      'id' => $id
    ));
    if(isset($params['end_date'])  && isset($result['values'][$id]['end_date']))
    {
      $paramDate = date_create($params['end_date']);
      if(date_format($paramDate,"Y-m-d") != $result['values'][$id]['end_date'])
      {
        $termParams['membership_id'] = $id;
        $termParams['start_date'] = $result['values'][$id]['end_date'];
        $termParams['end_date'] = date_format($paramDate,"Y-m-d");
        civicrm_api3('TermReport', 'create', $termParams);
      }
    }
  }
}

/**
 * Implementation of hook_civicrm_links
 */
function termreport_civicrm_links($op, $objectName, $objectId, &$links, &$mask, &$values){

  if($objectName == "Membership"){
    if($op = "membership.selector.row"){
        $newLink['name'] = "Renewal Term Report";
        $newLink['url'] = "civicrm/term-report";
        $newLink['qs'] = "reset=1&id=%%id%%&cid=%%cid%%&action=termreport&context=%%cxt%%&selectedChild=member&key=854130e1e1faee7284b94e3dadb39cc6_7291";
        $newLink['title'] = "Check Renewal Term Report";
        $newLink['bit'] = 2;
        array_push($links, $newLink );
    }
  }
}
