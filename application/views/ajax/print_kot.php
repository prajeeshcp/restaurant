<?php 
if ($kot_details[0]["table_id"]) {
	$tableDetails		= _DB_get_record($this->tables['table_details'], array('id' => $kot_details[0]["table_id"]));
	$tableName			= $tableDetails['table_number'];
} else {
	$tableName			= "Not Mentioned";
}?>
<div id="print_kot_div" >
    <table border="2">
        <tr style="text-align:center">
            <th width="40%">KOT :<?=$kot_details[0]["increment_id"]?></th>
            
            <th width="30%">TABLE :<?=$tableName?></th>
            
            <th width="30%"></th>
        </tr>
        <tr style="text-align:center">
            <th width="40%">Food Item</th>
            <th width="30%">Quatity</th>
            <th width="30%">Type</th>
        </tr>

        <?php 
        if (!empty($kot_details)) {
            foreach ($kot_details as $kot) {
         ?>

        <tr style="text-align:center">
            <td width="40%">   
                 <?=strip_tags($kot['name']);?>      
            </td>
            <td width="30%" >
                <?=number_format($kot['qty_ordered']);?>
                    
            </td>
            <td> <?=stripslashes($kot['order_type']);?></td>
        </tr>
            
        <?php } }
         ?>

    </table>
    
</div>