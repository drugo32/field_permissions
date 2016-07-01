<?php

/**
 * @file
 * Contains FieldPermissionsDynamicPermissions.php.
 */

namespace Drupal\field_permissions;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\field_permissions\FieldPermissionsService;

class FieldPermissionsDynamicPermissions implements ContainerInjectionInterface {

  /**
   * The FieldPermissionsService.
   *
   * @var Drupal\field_permissions\FieldPermissionsService
   */
  protected $fieldPermissionsService;

  /**
   * Constructs a FieldPermissionsService instance.
   *
   * @param Drupal\field_permissions\FieldPermissionsService $field_permissions_serices
   *   Service Interface.
   */
  public function __construct(FieldPermissionsService $field_permissions_serices) {
    $this->fieldPermissionsService = $field_permissions_serices;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('field_permissions.permissions_service'));
  }

  /**
   * Get implemets permissions invoke in field_permissions.permissions.yml.
   *
   * @return array
   *   Add custom permissions.
   */
  public function permissions() {
    return $this->fieldPermissionsService->permissions();
  }

}
