<?php 
if (!empty($kot_details)) {
	foreach ($kot_details as $kot) {
 ?>
<tr>
    <td width="55%">
       <strong> <?=strip_tags($kot['name']);?> </strong>
    </td>
    <td><button type="button" class="btn btn-sm btn-info btn-prev"><?=number_format($kot['qty_ordered'], 2);?></button></td>
    <td><div class="actions">
<button type="button" class="btn btn-sm btn-warning btn-prev">
    <i class="fa fa-minus-circle"></i></button>
<button type="button" class="btn btn-sm btn-success btn-next" data-last="Finish"><i class="fa fa-plus-circle"></i>
</button>
<button type="button" class="btn btn-sm btn-danger btn-prev">
    <i class="fa  fa-trash-o"></i></button>
</div></td>
</tr>
<?php } } ?>