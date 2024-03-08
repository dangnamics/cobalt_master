<?php
        $pageHeaderStyle = get_field("page_header-style");
        $pageHeaderMode = get_field('page_banner-size');
        $pageTitle = '';
        $overrideTitle = get_field('page_title-override');
        if($overrideTitle)
            $pageTitle = get_field('page_header-title');
        $pageHeaderText = get_field('page_header-text');
        switch ($pageHeaderStyle)
        {
            case "image" :
                
                if($pageHeaderMode == 'full')
                {
                    $pageHeaderSize = 'page-header-large';
                    $pageHeaderMode = 'full';
                }
                else if($pageHeaderMode == 'left')
                {
                    $pageHeaderMode = 'left';
                    $pageHeaderSize = 'page-hero-banner';
                }else{
                    $pageHeaderMode = 'right';
                    $pageHeaderSize = 'page-hero-banner';
                
                }
                rrcb_showFeature("hero", [
                   "hero_content-display-mode"=>$pageHeaderMode,
                   "hero_contentPercentage"=>50,
                   "hero_imageSize" => $pageHeaderSize,
                   "hero_headline-copy"=>$pageTitle,
                   "hero_headline-sub-copy"=>$pageHeaderText,
                   'hero_allow-empty-sub-copy'=>true,
                    //"container_class" => "",
                    //"hero_hideWrapperMarkup" => true
                   ]);

                break;
            case "text" :
            default:
                rrcb_showFeature("title-header", 
                    [
                    'title-header_summaryFieldName'=>'page_header-text',
                    'title-header_summary'=>$pageHeaderText,
                    'title-header_title'=>$pageTitle,
                    ]);
                break;
        }
        rrcb_showFeature("breadcrumbs", ["container_class" => 'container hidden-xs']);

?>