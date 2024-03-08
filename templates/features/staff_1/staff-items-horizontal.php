<?php
$numberOfColumns = get_query_var("staff-item-numberOfColumns");
$groupItems = get_query_var('staff-groupItems');
$i=0;
$columnSize = floor(BOOTSTRAP_COLUMNS / $numberOfColumns);
$canHalfSize = ($numberOfColumns > 3 && $numberOfColumns % 2 == 0);
$halfColumns = floor($numberOfColumns / 2);
foreach ($groupItems as $staff_member)
//for ($i = 0; $i < count($groupItems); $i++)
{
    //$staff_member = $groupItems[$i];
    if($i % $numberOfColumns == 0)
    {
        _e("        <div class=\"row staff-medium-row staff-row-horizontal\">\n");
    }
    // If the specified number of columns is 4, 6, 8, etc  We want the medium size to be half of that.
    if($canHalfSize && ($i % $halfColumns == 0))
    {
        $leftRight = ($i % $numberOfColumns == 0) ? "left" : "right";
        _e("            <div class=\"staff-small-row staff-{$leftRight}-col col-md-6 col-sm-12\">\n");
    }


?>
                <div class="staff-member-container col-md-<?php _e($canHalfSize ? "6" : $columnSize); ?> col-sm-<?php _e(BOOTSTRAP_COLUMNS / $halfColumns); ?>">
<?php 
    if(has_filter("staff_item_show"))
        $staff_member = apply_filters("staff_item_show", $staff_member);
    $staff_member->showFunction->__invoke();
?>
                </div>
        <?php
    if($canHalfSize && ((($i % $halfColumns) + 1) == $halfColumns))
    {
        _e("            </div> <!--/.row small-->\n");
    }
    if(($i % $numberOfColumns == $numberOfColumns-1) || $i == (count($groupItems)-1))
    {
        _e("        </div> <!--/.row medium-->\n");
    }
    $i++;
}
?>