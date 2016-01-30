<?php

namespace Drupal\field_permissions\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeManager;
use Symfony\Component\Validator\Constraints\File;
use Drupal\Core\Field;
use Drupal\field_permissions\FieldPermissions;

class FieldPermissionsController {

  public function content(){

//    $fields = \Drupal::entityTypeManager()->getStorage('field_config')->loadMultiple();
//    $instances = \Drupal::entityTypeManager()->getStorage('field_storage_config')->loadByProperties(['entity_type'=>'field']);

//   $site= \Drupal::configFactory()->get('system.site')->get('name');

    $build['table'] = array(
      '#type' => 'table',
      '#header' => $this->buildHeader(),
      '#title' => $this->getTitle(),
      '#rows' => $this->buildRows(),
    );

  return $build;
  }

  public function buildHeader(){
    $headers = array(t('Field name'), t('Field type'), t('Entity type'), t('Used in'));
    $permissions_list = FieldPermissions::field_permissions_list();
    foreach ( $permissions_list as $permission_type => $permission_info) {
      $headers[] = array('data' => $permission_info['label'], 'class' => 'field-permissions-header');
    }
    return $headers;
  }

  public function getTitle(){
    return t('Field permissions');
  }

  protected function buildRows(){
    $instances = \Drupal::entityTypeManager()->getStorage('field_storage_config')->loadMultiple();

    /**
     *  occorre caricare l'elenco dei tipi di field in modo da poter presentare in tabella la parte
     *  descrittiva e non il nomi macchina
     */
    $rows=[];

    /**
     * @var $instance \Drupal\field\Entity\FieldStorageConfig
     */
    foreach( $instances as $key=>$instance){
      $rows[]=$this->buildRow($instance);
    }
    return $rows;
  }

//  protected function buildRow(EntityInterface $field_storage) {
  protected function buildRow(\Drupal\field\Entity\FieldStorageConfig $field_storage) {
    $row = [];
    if ($field_storage->isLocked()) {
      $row[0]['class'] = array('menu-disabled');
      $row[0]['data']['id'] =  $this->t('@field_name (Locked)', array('@field_name' => $field_storage->getName()));
    }
    else {
      $row[0]['data'] = $field_storage->getName();
    }
      $row[1]['data'] = $field_storage->getType();
      $row[2]['data'] = $field_storage->getTargetEntityTypeId();
      $row[3]['data'] =  implode(",", $field_storage->getBundles());

      // foreach()
    //  dpm($field_storage->getEntityType());
//    $field_type=$field_storage->getD
//    $field_type = $this->fieldTypes[$field_storage->getType()];
//    $row['data']['type'] = $this->t('@type (module: @module)', array('@type' => $field_type['label'], '@module' => $field_type['provider']));
//
//    $usage = array();
//    foreach ($field_storage->getBundles() as $bundle) {
//      $entity_type_id = $field_storage->getTargetEntityTypeId();
//      if ($route_info = FieldUI::getOverviewRouteInfo($entity_type_id, $bundle)) {
//        $usage[] = \Drupal::l($this->bundles[$entity_type_id][$bundle]['label'], $route_info);
//      }
//      else {
//        $usage[] = $this->bundles[$entity_type_id][$bundle]['label'];
//      }
//    }
//    $row['data']['usage']['data'] = [
//      '#theme' => 'item_list',
//      '#items' => $usage,
//      '#context' => ['list_style' => 'comma-list'],
//    ];
    return $row;
  }


}