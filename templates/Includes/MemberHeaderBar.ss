<div id="MemberLinksContainer">
    <div class="container-fluid">
        <ul class="member-top-links" itemscope itemtype="https://schema.org/SiteNavigationElement">
            <% if $CurrentMember %>

                <% if $isAdmin %>
                    <li>
                        <a href="/admin/" itemprop="url" class="rev"><i class="fa fa-cog"></i>
                            <span itemprop="name">Admin</span>
                        </a>
                    </li>
                <% end_if %>

                <li>
                    <a href="$_Link(MemberProfilePage)" itemprop="url" class="rev">
                        <i class="fa fa-user"></i>
                        <span itemprop="name">My Account</span>
                    </a>
                </li>

                <li>
                    <a href="$_Link(MemberAreaHolder)" itemprop="url" class="rev"><i class="fa fa-bars"></i> <span
                            itemprop="name">Member Portal</span>
                    </a>
                </li>

                <li>
                    <a href="Security/logout/?BackURL=home" itemprop="url" class="rev">
                        <i class="fa fa-lock"></i> <span itemprop="name">Log out</span></a>
                </li>

            <% else %>
                <li>
                    <a href="$_Link(MemberProfilePage)" itemprop="url" class="rev $ClassName">
                        <i class="fa fa-edit"></i> <span itemprop="name">Register</span>
                    </a>
                </li>
                <li>
                    <a href="Security/login/" itemprop="url" class="rev $ClassName">
                        <i class="fa fa-unlock-alt"></i> <span itemprop="name">Log in</span>
                    </a>
                </li>
            <% end_if %>


            <% if $Cart %>
                <% with $Cart %>
                    <li>
                        <a href="$Top.CartLink" itemprop="url">
                            <i class="icon-shopping-cart icon-white"></i>
                            <i class="fa fa-shopping-cart"></i> <span itemprop="name">Cart ($Items.Quantity)</span>
                        </a>
                    </li>
                    <li>
                        <a href="$Top.CheckoutLink" itemprop="url" class="rev">
                            <i class="fa fa-money"></i>
                            <span itemprop="name">Check out</span>
                        </a>
                    </li>
                <% end_with %>
            <% end_if %>

        </ul>
    </div>
</div>
