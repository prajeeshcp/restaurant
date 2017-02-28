<?php 

if (!empty($kot_details)) {
	foreach ($kot_details as $kot) {
 ?>
<tr style="<?=($kot['is_kot'] == 0) ? 'background-color:darkkhaki' : 'background-color:darkolivegreen'?>">
    <td width="55%">   
    	<strong> <?=strip_tags($kot['name']);?> </strong>     
    </td>
    <td><button type="button" class="btn btn-sm btn-info btn-prev"><?=number_format($kot['qty_ordered'], 2);?></button></td>
    <td><div class="actions">
    <?php if($kot['qty_ordered'] == 1){?>
<button type="button" class="btn btn-sm btn-warning btn-prev disabled" onclick="return confirm_menu(<?=$kot['menu_id']?>, <?=$kot['price_type']?>,<?=$kot['order_id']?>, <?=$kot['kot_id']?>,1)">
    <i class="fa fa-minus-circle"></i></button>
    <?php } else { ?>
    	<button type="button" class="btn btn-sm btn-warning btn-prev" onclick="return confirm_menu(<?=$kot['menu_id']?>, <?=$kot['price_type']?>,<?=$kot['order_id']?>, <?=$kot['kot_id']?>,1)">
    <i class="fa fa-minus-circle"></i></button>
    <?php } ?>
<button type="button" class="btn btn-sm btn-success btn-next"  data-last="Finish" onclick="return confirm_menu(<?=$kot['menu_id']?>, <?=$kot['price_type']?>,<?=$kot['order_id']?>, <?=$kot['kot_id']?>)"><i class="fa fa-plus-circle"></i>
</button>
<button type="button" class="btn btn-sm btn-danger btn-prev" onclick="return confirm_menu(<?=$kot['menu_id']?>, <?=$kot['price_type']?>,<?=$kot['order_id']?>, <?=$kot['kot_id']?>,2)">
    <i class="fa  fa-trash-o"></i></button>
</div></td>
</tr>
<?php } }
 ?>

<table id="print_kot_table" style="display:none">
<tr>
    <td>KOT:</td><td><?=$kot_details[0]["kot_id"]?></td>
    
    <td>TABLE:</td><td><?=$kot_details[0]["table_id"]?></td>
    
    <td>ORDER TYPE:</td><td><?=$kot_details[0]["order_id"]?></td>
</tr>
<tr>
    <th>Food Item</th>
    <th>Quatity</th>
</tr>

<?php 
if (!empty($kot_details)) {
    foreach ($kot_details as $kot) {
 ?>

<tr>
    <td width="100%">   
        <strong> <?=strip_tags($kot['name']);?> </strong>     
    </td>
    <td>
        <?=number_format($kot['qty_ordered']);?>
            
    </td>
    
<?php } }
 ?>

</table>
