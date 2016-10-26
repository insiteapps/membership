<?php

/**
 * Class MemberAreaHolder
 */
class MemberAreaHolder extends ListHolder
{
    private static $allowed_children = array("MemberAreaPage");
    private static $default_child = "MemberAreaPage";

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();
        $path = "Vault";

        $vault = DataObject::get_one('Folder', "Title = 'Vault'");
        if (!$vault) {
            $vault = Folder::find_or_make($path);
            $vault->ParentID = "0";
            $vault->CanViewType = "LoggedInUsers";
            $vault->write();
            DB::alteration_message(' Vault created', 'created');
        }
    }
}

class MemberAreaHolder_Controller extends ListHolder_Controller implements PermissionProvider
{
    /**
     * @var Array Codes which are required from the current user to view this controller.
     * If multiple codes are provided, all of them are required.
     * All COLLAB controllers require "COLLAB_ACCESS_CollabMain" as a baseline check,
     * and fall back to "CMS_ACCESS_<class>" if no permissions are defined here.
     * @example
     * <code>
     *      static $required_permission_codes = 'COLLAB_ACCESS_FormBuilder';
     * </code>
     * See {@link canView()} for more details on permission checks.
     */
    private static $required_permission_codes = "SITE_ACCESS_MEMBER_AREA";

    public function init()
    {
        parent::init();
        if (!$this->canView()) {
            // return a permission error
            $messageSet = array(
                'default' => "Please choose an authentication method and enter your credentials to access the System.",
                'alreadyLoggedIn' => "I'm sorry, but you can't access that part of the System.  If you want to log in as someone else, do so below",
                'logInAgain' => "You have been logged out of the System.  If you would like to log in again, enter a username and password below.",
            );
            return Security::permissionFailure($this, $messageSet);
        }


        }

    function providePermissions()
    {
        $perms = array(
            "SITE_ACCESS_MEMBER_AREA" => array(
                'name' => 'Access to all MEMBER area',
                'category' => 'Member Area Access',
                'help' => 'Overrules more specific access settings.',
                'sort' => -100
            )
        );
        return $perms;
    }

    function Member()
    {
        return Member::currentUser();
    }

    public function canView($member = null)
    {
        if ($member == null) {
            $member = Member::currentUser();
        }

        if ($member == null) {
            return false;
        }

        return true;
    }
}