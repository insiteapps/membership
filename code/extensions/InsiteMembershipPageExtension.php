<?php

class InsiteMembershipPageExtension extends DataExtension
{
    function HasMembership()
    {
        return true;
    }
}

class InsiteMembershipPageControllerExtension extends DataExtension
{

    public function onAfterInit()
    {
        Requirements::javascript(INSITE_APPS_MEMBERSHIP_DIR . "/js/InsiteAppsMemberShipManager.js");

        Requirements::css(INSITE_APPS_MEMBERSHIP_DIR . "/css/InsiteAppsMemberShipManager.css");


    }

}
