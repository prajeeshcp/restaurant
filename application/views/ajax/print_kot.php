<table border="1px">
<tr style="text-align:center">
    <td width="40%">KOT:<?=$kot_details[0]["kot_id"]?></td>
    
    <td width="30%">TABLE:<?=$kot_details[0]["table_id"]?></td>
    
    <td width="30%">ORDER TYPE:<?=strtoupper($kot_details[0]["order_type"])?></td>
</tr>
<tr style="text-align:center">
    <th width="40%">Food Item</th>
    <th width="30%">Quatity</th>
    <th width="30%">Other Details</th>
</tr>

<?php 
if (!empty($kot_details)) {
	foreach ($kot_details as $kot) {
 ?>

<tr style="text-align:center">
    <td width="40%">   
    	<strong> <?=strip_tags($kot['name']);?> </strong>     
    </td>
    <td width="30%" >
        <?=number_format($kot['qty_ordered']);?>
            
    </td>
    
<?php } }
 ?>

</table>



