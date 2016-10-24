<?php

/**
 * Class MemberAreaPage
 */
class MemberAreaPage extends ListPage
{
    private static $can_be_root = false;
    private static $has_many = array(
        "SecureImages" => "SecureImageResource",
        "SecureDocuments" => "SecureDocumentLibrary",
    );


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(["Comments", "RelatedLinks"]);

        $DocumentsGridFieldConfig = GridFieldConfig_RecordEditor::create();
        $DocumentsGridFieldConfig->addComponent(new GridFieldBulkUpload());
        $DocumentsGridFieldConfig->getComponentByType('GridFieldBulkUpload')->setUfSetup('setFolderName', 'Vault/Documents');
        $DocumentsGridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $DocumentsGridField = new GridField('Documents', 'Documents', $this->SecureDocuments(), $DocumentsGridFieldConfig);
        $fields->addFieldToTab('Root.Secure', $DocumentsGridField);


        $ImagesGridFieldConfig = GridFieldConfig_RecordEditor::create();
        $ImagesGridFieldConfig->addComponent(new GridFieldBulkUpload());
        $ImagesGridFieldConfig->getComponentByType('GridFieldBulkUpload')->setUfSetup('setFolderName', 'Vault/Images');
        $ImagesGridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $ImagesGridField = new GridField('Images', 'Images', $this->SecureImages(), $ImagesGridFieldConfig);
        $fields->addFieldToTab('Root.Secure', $ImagesGridField);


        return $fields;
    }


}

class MemberAreaPage_Controller extends ListPage_Controller implements PermissionProvider
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