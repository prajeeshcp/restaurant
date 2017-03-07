<link href="css/invoice.css" rel="stylesheet">
<?php 
	if (!empty($order_detail) && !empty($order_item)) {
 ?>
<!-- widget grid -->
<section id="widget-grid" >

<!-- row -->
<div class="row"> 
  
  <!-- NEW WIDGET START -->
  <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
    
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget well jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-colorbutton="false"> 
      
      <!-- widget div-->
      <div> 
        
        <!-- widget content -->
        <div class="widget-body no-padding">
          <div class="padding-10">
            <div class="row">
              <div class="col-sm-12">
                <div>
                  <div> <strong>ORDER NO :</strong> <span class="pull-right">
                    <?=$order_detail['increment_id']?>
                    </span> </div>
                </div>
                <div>
                  <div class="font-md"> <strong>ORDER DATE :</strong> <span class="pull-right"> <i class="fa fa-calendar"></i>
                    <?=date('d/m/Y',strtotime($order_detail['created_at']))?>
                    </span> </div>
                </div>
                <br>
                <div class="well well-sm  bg-color-darken txt-color-white no-border">
                  <div class="fa-lg"> Total Due : <span class="pull-right"> RS
                    <?=$order_detail['grand_total']?>
                    </span> </div>
                </div>
                <br>
                <br>
              </div>
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th class="text-center">QTY</th>
                  <th>ITEM</th>
                  <th>DESCRIPTION</th>
                  <th>PRICE</th>
                  <th>SUBTOTAL</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($order_item as $key=>$item) { ?>
                <tr>
                  <td class="text-center"><strong>
                    <?=$item['qty_ordered']?>
                    </strong></td>
                  <td><a href="javascript:void(0);">
                    <?=$item['name']?>
                    </a></td>
                  <td><?=$item['order_type']?></td>
                  <td><?=$item['price']?></td>
                  <td><?=$item['row_total']?></td>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="4">Total</td>
                  <td><strong>
                    <?=$order_detail['grand_total']?>
                    </strong></td>
                </tr>
                <tr>
                  <td colspan="4">TAX</td>
                  <td><strong>13%</strong></td>
                </tr>
              </tbody>
            </table>
            <div class="invoice-footer">
              <div class="row">
                <div class="col-sm-7"> <a href="<?=site_url('manage/close_order/'.$order_detail['entity_id'])?>" id="compleate-order" class="btn btn-danger btn-lg">Confirm Bill</a> </div>
                <div class="col-sm-5">
                  <div class="invoice-sum-total pull-right">
                    <h3><strong>Total: <span class="text-success">RS
                      <?=$order_detail['grand_total']?>
                      </span></strong></h3>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <p class="note">**To avoid any excess panelty charges, please make payments within 30 days of the due date. There will be a 2% interest charge per month on all late invoices.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end widget content --> 
        
      </div>
      <!-- end widget div --> 
      
    </div>
    <!-- end widget --> 
    
  </article>
  <!-- WIDGET END --> 
  
</div>

<!-- end row -->

</section>
<?php } else { ?>
<section id="widget-grid" > 
  
  <!-- row -->
  <div class="row"> 
    
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    	<div class="font-md"> <strong>Sorry! You can not proccess the bill of this order</strong> </div>
     </article>
  </div>
</section>
<?php } ?>
