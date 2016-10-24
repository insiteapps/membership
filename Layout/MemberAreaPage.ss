<div class="typography">
    <!-- =========== Section 2 =========== -->
    <div class="container-fluid horizontal-section-container clearfix">
        <div class="row">
            <% if $hasSideBar %>
                <div class="col-sm-3">
                    <% include Sidemenu %>
                </div>
                <!-- .col-sm-3 -->
            <% end_if %>

            <div class="col-sm-{$mainContentWidth}">
                <!-- Main Page Content -->
                <div id="main-page-content" class="section-container main-page-content clearfix">
                    <div class="section-content">
                        <h1 class="page_title">{$Title}</h1>

                        {$Content}


                        <% if $SecureDocuments %>
                            <section id="SecureDocumentHolder">
                                <div class="row">
                                    <% loop $SecureDocuments %>
                                        <div class="col-sm-3 sameSizePanel">
                                            <a href="{$Link}" target="_blank">
                                                <h5>{$Title}</h5>
                                                $Content
                                            </a>
                                        </div>
                                    <% end_loop %>
                                </div>
                            </section>
                        <% end_if %>

                    </div>
                    <!-- .section-content -->
                </div>
                <!-- .section-container -->
            </div>
            <!-- .col-sm-8 -->

            <% if $SideBar.Widgets %>
                <div class="col-sm-3">
                    $SideBar
                </div>
                <!-- .col-sm-4 -->
            <% end_if %>

        </div>
        <!-- .row -->
    </div><!-- .container-fluid -->
    <!-- End: Section 2 -->




    <% if $PanelBlocks %>
        <% loop $PanelBlocks %>
            $PanelContent
        <% end_loop %>
    <% end_if %>


    <% if $FeaturePanels %>
        <% include FeaturePanels %>
    <% end_if %>
</div>