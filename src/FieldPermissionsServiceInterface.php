<?php

/**
 * @file
 * Contains FieldPermissionsServiceInterface.php.
 */

namespace Drupal\field_permissions;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\comment\CommentManagerInterface;

/**
 * Implement FieldPermission Interface.
 */
interface FieldPermissionsServiceInterface {

  /**
   * Obtain the list of field permissions.
   *
   * @param string $field_label
   *   The human readable name of the field to use when constructing permission
   *   names. Usually this will be derived from one or more of the field
   *   instance labels.
   */
  public  function getList($field_label = '');

  /**
   * Returns field permissions in format suitable for use in hook_permission.
   *
   * @param \Drupal\field\FieldStorageConfigInterface $field
   *   The field to return permissions for.
   *
   * @return array
   *   An array of permission information,
   */
  public  function listFieldPermissionSupport($field, $label = '');

  /**
   * Get default value for checkbox role permission.
   */
  public  function getPermissionValue();


  /**
   * Returns permissions implements in field_permissions.
   */
  public  function permissions();

  /**
   * Get default value for checkbox  role permission.
   *
   * @param \Drupal\field\FieldStorageConfigInterface $field
   *   The field to return permissions for.
   */
  public  function fieldGetPermissionType($field);

  /**
   * Get default value for checkbox  role permission.
   *
   * @param \Drupal\field\FieldStorageConfigInterface $field
   *   The field to return permissions for.
   */
  public  function fieldSetPermissionType($field, $type_permission);

  /**
   * Field is attached to comment entity.
   *
   * @param FieldDefinitionInterface $field_definition
   *   Fields to get permissions.
   *
   * @return bool
   *   TRUE if in a comment entity.
   */
  public  function fieldIsCommentField($field_definition);

  /**
   * Get access for field by operations and account permisisons.
   *
   * @param string $operation
   *    String operation on field.
   * @param Entity $items
   *   Entity cotain fields.
   * @param AccountInterface $account
   *    Account to get permissions.
   * @param FieldDefinitionInterface $field_definition
   *   Fields to get permissions.
   */
  public  function getFieldAccess($operation, $items, $account, $field_definition);

  /**
   * Access to field on itemes and opertations whith FIELD_PERMISSIONS_PRIVATE.
   *
   * @param string $operation
   *    String operation on field.
   * @param Entity $items
   *   Entity cotain fields.
   * @param AccountInterface $account
   *    Account to get permissions.
   * @param string $field_name
   *   Fieldsname to get permissions.
   *
   * @return bool
   *   Check permission.
   */
  public  function getFieldAccessPrivate($operation, $items, $account, $field_name);

  /**
   * Access to field on itemes VIEW and FIELD_PERMISSIONS_PRIVATE.
   *
   * @param Entity $items
   *   Entity cotain fields.
   * @param AccountInterface $account
   *    Account to get permissions.
   * @param string $field_name
   *   Fieldsname to get permissions.
   *
   * @return bool
   *   Check permission.
   */
  public  function getFieldAccessPrivateView($items, $account, $field_name);

  /**
   * Access to field on itemes EDIT and FIELD_PERMISSIONS_PRIVATE.
   *
   * @param Entity $items
   *   Entity cotain fields.
   * @param AccountInterface $account
   *    Account to get permissions.
   * @param string $field_name
   *   Fieldsname to get permissions.
   *
   * @return bool
   *   Check permission.
   */
  public  function getFieldAccessPrivateEdit($items, $account, $field_name);
  /**
   * Access to field on itemes and opertations whith FIELD_PERMISSIONS_CUSTOM.
   *
   * @param string $operation
   *    String operation on field.
   * @param Entity $items
   *   Entity cotain fields.
   * @param AccountInterface $account
   *    Account to get permissions.
   * @param string $field_name
   *   Fieldsname to get permissions.
   *
   * @return bool
   *   Check permission.
   */
  public  function getFieldAccessCustom($operation, $items, $account, $field_name);

  /**
   * Access to field on itemes VIEW and FIELD_PERMISSIONS_CUSTOM.
   *
   * @param Entity $items
   *   Entity cotain fields.
   * @param AccountInterface $account
   *    Account to get permissions.
   * @param string $field_name
   *   Fieldsname to get permissions.
   *
   * @return bool
   *   Check permission.
   */
  public  function getFieldAccessCustomView($items, $account, $field_name);

  /**
   * Access to field on itemes EDIT and FIELD_PERMISSIONS_CUSTOM.
   *
   * @param Entity $items
   *   Entity cotain fields.
   * @param AccountInterface $account
   *    Account to get permissions.
   * @param string $field_name
   *   Fieldsname to get permissions.
   *
   * @return bool
   *   Check permission.
   */
  public  function getFieldAccessCustomEdit($items, $account, $field_name);

}
