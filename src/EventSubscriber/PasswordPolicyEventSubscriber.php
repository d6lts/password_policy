<?php
/**
 * @file
 * Contains Drupal\password_policy\EventSubscriber\PasswordPolicyEventSubcriber.
 */
namespace Drupal\password_policy\EventSubscriber;

use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

class PasswordPolicyEventSubscriber implements EventSubscriberInterface {

  /**
   * Event callback to look for users expired password
   */
  public function checkForUserPasswordExpiration(GetResponseEvent $event) {
    $account = \Drupal::currentUser();
    $user = entity_load('user', $account->id());
    $route_name = \Drupal::request()->attributes->get(RouteObjectInterface::ROUTE_NAME);

    ///system/ajax
    $ignored_routes = array(
      'entity.user.edit_form',
      'system.ajax',
      'user.logout',
    );

    $user_expired = $user->get('field_password_expiration')->get(0)->getValue();
    $user_expired = $user_expired['value'];


    //TODO - Consider excluding admins here
    if ($user_expired and !in_array($route_name, $ignored_routes)) {
      $url = new Url('entity.user.edit_form', array('user' => $user->id()));
      $url = $url->toString();
      $event->setResponse(new RedirectResponse($url));
      drupal_set_message('Your password has expired, please update it', 'error');
    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    //TODO - Evaluate if there is a better place to add this check
    $events[KernelEvents::REQUEST][] = array('checkForUserPasswordExpiration');
    return $events;
  }
}
