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
}