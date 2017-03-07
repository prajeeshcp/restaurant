<style type="text/css">
        
         #printout_bill {
            text-align: center;
            /*width:100%;
            height:100%;*/
          }
          table {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
          }
          table, td, th {    
            
            text-align: left;
        }
          th, td {
            padding: 15px;
        }
</style>

<div id="printout_bill" >
    
        <h3>Sample title</h3>
        <h4>Sample details hmghjggh</h4>
        ----------------------------------------------
        <table>
            <tr>
                <td>Table No : <?=$bill_details[0]["table_id"]?></td> 
                <td></td>
                <td></td>
                <td></td>
                <td>Date : <?=date('Y-m-d')?></td>
            </tr>
            <tr>
                <td>Order No : <?=$bill_details[0]["entity_id"]?></td> 
                <td></td>
                <td></td>
                <td></td>
                <td>Time : <?=date('h:i:s A')?> </td>
            </tr>
        </table>

        <h4>List of Items</h4>
        -----------------------------------------------

        <table>
            <tr>
                <th>SI</th>
                <th>Item</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Total</th>

            </tr>
        <?php 
            if (!empty($bill_details)) {
                foreach ($bill_details as $key =>  $bill) {
        ?>

            <tr>
                <td><?=$key+1?></td>
                <td><?=strip_tags($bill['name']);?></td>
                <td><?=$bill['price']?></td>
                <td><?=$bill['qty_ordered']?></td>
                <td><?=$bill['row_total']?></td>
                
            </tr>
        <?php } }
        ?>

            
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>------------</td>
                <td>------------</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?=$bill_details[0]["grand_total"]?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>vat</td>
                <td><?=$bill_details[0]["tax_amount"]?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>------------</td>
                <td>------------</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Final Total</td>
                <td><?=$bill_details[0]["grand_total"]?></td>
            </tr>
            


        </table>
        

    
        
    </div>
    



