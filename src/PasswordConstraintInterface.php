<?php

/**
 * @file
 * Contains Drupal\password_policy\PasswordConstraintInterface.
 */

namespace Drupal\password_policy;

/**
 * Defines the interface for password policy constraints.
 */
interface PasswordConstraintInterface {

  /**
   * Returns a true/false status as to if the password meets the requirements of the constraint.
	 * @param policy_id
	 *   The policy ID for the specific policy to verify
   * @param password
	 *   The password entered by the end user
   * @return boolean
   *   Whether or not the password meets the constraint in the plugin.
   */
  public function validate($policy_id, $password);

	/**
	 * Returns a translated string for the constraint title.
	 * @return string
	 */
	public function getTitle();

	/**
	 * Returns a translated description for the constraint description.
	 * @return string
	 */
	public function getDescription();

	/**
	 * Returns a translated error message for the constraint.
	 * @return string
	 */
	public function getErrorMessage();

	/**
	 * Returns the constraint's path to create a policy.
	 * @return string
	 */
	public function getPolicyPath();

	/**
	 * Returns the constraint's path to update a policy.
	 * @return string
	 */
	public function getPolicyUpdatePath();

	/**
	 * Returns the token for the identifier found in the update path.
	 * @return string
	 */
	public function getPolicyUpdateToken();

	/**
	 * Returns the policies for the constraint.
	 * @return array
	 */
	public function getPolicies();

}