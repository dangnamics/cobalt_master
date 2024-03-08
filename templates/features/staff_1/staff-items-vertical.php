<?php
$numberOfColumns = get_query_var("staff-item-numberOfColumns");
$groupItems = get_query_var('staff-groupItems');
$columnSize = floor(BOOTSTRAP_COLUMNS / $numberOfColumns);
$canHalfSize = ($numberOfColumns > 3 && $numberOfColumns % 2 == 0);
$halfColumns = floor($numberOfColumns / 2);
$columnWidth = 970 / ($numberOfColumns + 1) ;
?>
    <div class="row staff-medium-row" <?php _e("style=\"-webkit-column-width:{$columnWidth}px; -moz-column-width:{$columnWidth}px; column-width:{$columnWidth}px; \""); ?> >
<?php
foreach ($groupItems as $staff_member)
{
    ?>
        <div class="staff-member-container">
    <?php
    if(has_filter("staff_item_show"))
        $staff_member = apply_filters("staff_item_show", $staff_member);
    $staff_member->showFunction->__invoke();
    ?>
        </div>
    <?php
}
?>
    </div>