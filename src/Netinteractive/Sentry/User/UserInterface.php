<?php namespace Netinteractive\Sentry\User;
/**
 * Part of the Sentry package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Sentry
 * @version    2.0.0
 * @author     Netinteractive LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Netinteractive LLC
 * @link       http://cartalyst.com
 */

use Netinteractive\Sentry\Role\RoleInterface;

interface UserInterface {

	/**
	 * Returns the user's ID.
	 *
	 * @return mixed
	 */
	public function getId();


	/**
	 * Returns the user's password (hashed).
	 *
	 * @return string
	 */
	public function getPassword();

	/**
	 * Returns permissions for the user.
	 *
	 * @return array
	 */
	public function getPermissions();

	/**
	 * Check if the user is activated.
	 *
	 * @return bool
	 */
	public function isActivated();

	/**
	 * Checks if the user is a super user - has
	 * access to everything regardless of permissions.
	 *
	 * @return bool
	 */
	public function isSuperUser();



	/**
	 * Gets a code for when the user is
	 * persisted to a cookie or session which
	 * identifies the user.
	 *
	 * @return string
	 */
	public function getPersistCode();

    /**
     * Gets user login
     *
     * @return string
     */
    public function getLogin();


	/**
	 * Checks the given persist code.
	 *
	 * @param  string  $persistCode
	 * @return bool
	 */
	public function checkPersistCode($persistCode);

	/**
	 * Get an activation code for the given user.
	 *
	 * @return string
	 */
	public function getActivationCode();

	/**
	 * Attempts to activate the given user by checking
	 * the activate code. If the user is activated already,
	 * an Exception is thrown.
	 *
	 * @param  string  $activationCode
	 * @return bool
	 * @throws \Netinteractive\Sentry\User\UserAlreadyActivatedException
	 */
	public function attemptActivation($activationCode);

	/**
	 * Checks the password passed matches the user's password.
	 *
	 * @param  string  $password
	 * @return bool
	 */
	public function checkPassword($password);

	/**
	 * Get a reset password code for the given user.
	 *
	 * @return string
	 */
	public function getResetPasswordCode();

	/**
	 * Checks if the provided user reset password code is
	 * valid without actually resetting the password.
	 *
	 * @param  string  $resetCode
	 * @return bool
	 */
	public function checkResetPasswordCode($resetCode);

	/**
	 * Attempts to reset a user's password by matching
	 * the reset code generated with the user's.
	 *
	 * @param  string  $resetCode
	 * @param  string  $newPassword
	 * @return bool
	 */
	public function attemptResetPassword($resetCode, $newPassword);

	/**
	 * Wipes out the data associated with resetting
	 * a password.
	 *
	 * @return void
	 */
	public function clearResetPassword();

	/**
	 * Returns an array of groups which the given
	 * user belongs to.
	 *
	 * @return array
	 */
	public function getRoles();

	/**
	 * Adds the user to the given group
	 *
	 * @param  \Netinteractive\Sentry\Role\RoleInterface  $group
	 * @return bool
	 */
	public function addRole(RoleInterface $role);

	/**
	 * Removes the user from the given group.
	 *
	 * @param  \Netinteractive\Sentry\Role\RoleInterface  $group
	 * @return bool
	 */
	public function removeRole(RoleInterface $role);

	/**
	 * Updates the user to the given group(s).
	 *
	 * @param  \Illuminate\Database\Eloquent\Collection  $roles
	 * @param  bool  $remove
	 * @return bool
	 */
	public function updateRoles($roles, $remove = false);

	/**
	 * See if the user is in the given group.
	 *
	 * @param  \Netinteractive\Sentry\Role\RoleInterface  $group
	 * @return bool
	 */
	public function hasRole(RoleInterface $role);

	/**
	 * Returns an array of merged permissions for each
	 * group the user is in.
	 *
	 * @return array
	 */
	public function getMergedPermissions();

	/**
	 * See if a user has access to the passed permission(s).
	 * Permissions are merged from all groups the user belongs to
	 * and then are checked against the passed permission(s).
	 *
	 * If multiple permissions are passed, the user must
	 * have access to all permissions passed through, unless the
	 * "all" flag is set to false.
	 *
	 * Super users have access no matter what.
	 *
	 * @param  string|array  $permissions
	 * @param  bool  $all
	 * @return bool
	 */
	public function hasAccess($permissions, $all = true);

	/**
	 * See if a user has access to the passed permission(s).
	 * Permissions are merged from all groups the user belongs to
	 * and then are checked against the passed permission(s).
	 *
	 * If multiple permissions are passed, the user must
	 * have access to all permissions passed through, unless the
	 * "all" flag is set to false.
	 *
	 * Super users DON'T have access no matter what.
	 *
	 * @param  string|array  $permissions
	 * @param  bool $all
	 * @return bool
	 */
	public function hasPermission($permissions, $all = true);

	/**
	 * Returns if the user has access to any of the
	 * given permissions.
	 *
	 * @param  array  $permissions
	 * @return bool
	 */
	public function hasAnyAccess(array $permissions);

	/**
	 * Records a login for the user.
	 *
	 * @return void
	 */
	public function recordLogin();

}
