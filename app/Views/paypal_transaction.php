<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:50%">IMPORT ORDERS</th>
                    <th style="width:50%"></th>
                </tr>
            </thead>
            <tbody class="tbl-text-font-size">
                <tr>
                    <td>
                        <form class="user" method="POST" action="<?=site_url('paypaltransaction/importcsv') ?>" enctype="multipart/form-data">
                            <div class="formgroup">
                                <input type="file" style="width:255px" name="csv_file" aria-describedby="emailHelp">
                                <br/><br/>
                                <select name="paypal" id="list_paypal_csv">
                                    <option value="" selected>---</option>
                                    <?php foreach ($listPaypalEmail as $ppEmail): ?>
                                        <option value="<?=$ppEmail->email?>"><?=$ppEmail->email?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br/><br/>
                                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Import CSV</button>
                            </div>
                        </form>  
                    </td>

                    <td>
                        
                    </td>
                </tr>    
            </tbody>
        </table>  
    </div>    
</div> 
   <!--Hidden form  -->
<form class="user" method="get" action="<?=site_url('paypaltransaction') ?>" id="form_paypal_transaction_hidden">
    <input type="hidden" id="hidden_paypal" name="paypal" value="<?=$paypal?>">
</form>

<form class="user" method="get" action="<?=site_url('export_csv_etsy_orders') ?>" id="form_hidden_export_csv_etsy_orders">
    <input type="hidden" id="hidden_csv_paypal" name="paypal" value="<?=$paypal?>">
</form>


<div style="width:30px; display:inline;">
    <span>Paypal:</span>
    <select id="list_paypal">
        <option value="" selected>---</option>
        <?php foreach ($listPaypalEmail as $ppEmail): ?>
            <option value="<?=$ppEmail->email?>" <?=$paypal == $ppEmail->email ? 'selected' : ''?>><?=$ppEmail->email?></option>
        <?php endforeach; ?>
    </select>

    
    <button class="btn btn-primary" type="button" id="btn_pp_tran_search">
        <i class="fas fa-search fa-sm"></i>
    </button>        
    
</div>

<div class="m-0 font-weight-bold text-primary">Total Result: <?=count($results)?></div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="wrapper1">
            <div class="div1">
            </div>
        </div>
        <div class="wrapper2">
            <div class="div2">
                <?php $tblHeader = '<tr>
                            <th>ID</th>
                            <!-- <th>Date</th> -->
                            <th>Time</th>
                            <!-- <th>TimeZone</th> -->
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Curr</th>
                            <th class="money-text-align">Balance</th>
                            <th class="money-text-align">Gross</th>
                            <!-- <th>Fee</th> -->
                            <th class="money-text-align">Net</th>
                            <th>From Email Address</th>
                            <th>To Email Address</th>
                            <th>Transaction ID</th>
                            <th>Shipping Address</th>
                            <!-- <th>Address Status</th> -->
                            <th>Item Title</th>
                            <th>Item ID</th>
                            <!-- <th>Shipping and Handling Amount</th> -->
                            <!-- <th>Insurance Amount</th> -->
                            <!-- <th>Sales Tax</th> -->
                            <!-- <th>Option 1 Name</th>
                            <th>Option 1 Value</th>
                            <th>Option 2 Name</th>
                            <th>Option 2 Value</th> -->
                            <!-- <th>Reference Txn ID</th> -->
                            <th>Invoice Number</th>
                            <!-- <th>Custom Number</th> -->
                            <th>Qty</th>
                            <!-- <th>Receipt ID</th> -->
                            <th>Address Line 1</th>
                            <th>Address Line 2</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Postal Code</th>
                            <!-- <th>Country</th> -->
                            <!-- <th>Contact Phone Number</th> -->
                            <!-- <th>Subject</th> -->
                            <!-- <th>Note</th> -->
                            <th>Country Code</th>
                            <th>Balance Impact</th>
                        </tr>'; ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <?=$tblHeader?>
                    </thead>
                    <tfoot>
                        <?=$tblHeader?>
                    </tfoot>
                    <tbody class="tbl-text-font-size">
                        <?php $i = 1; ?>
                        <?php foreach ($results as $row): ?>
                            <?php if ($i % 7 == 0): ?>
                                <?=$tblHeader?>
                            <?php endif; ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$row->date?><br/><?=$row->time?></td>
                                <!-- <td><?//=$row->time?></td> -->
                                <!-- <td><?//=$row->timezone?></td> -->
                                <td><?=$row->name?></td>
                                <td><?=$row->type?></td>
                                <td><?=$row->status?></td>
                                <td><?=$row->currency?></td>
                                <td class="money-text-align"><?=$row->balance?></td>
                                <td class="money-text-align"><?=$row->gross?></td>
                                <!-- <td><?//=$row->fee?></td> -->
                                <td class="money-text-align"><?=$row->net?></td>
                                <td><?=$row->from_email_address?></td>
                                <td><?=$row->to_email_address?></td>
                                <td><?=$row->transaction_id?></td>
                                <td><?=$row->shipping_address?></td>
                                <!-- <td><?//=$row->address_status?></td> -->
                                <!-- <td><?//=implode(' ', array_slice(explode(' ', $row->item_title), 0, 5))?></td> -->
                                <td><?=$row->item_title?></td>
                                <td><?=$row->item_id?></td>
                                <!-- <td><?//=$row->shipping_and_handling_amount?></td> -->
                                <!-- <td><?//=$row->insurance_amount?></td> -->
                                <!-- <td><?//=$row->sales_tax?></td> -->
                                <!-- <td><?//=$row->option_1_name?></td>
                                <td><?//=$row->option_1_value?></td>
                                <td><?//=$row->option_2_name?></td>
                                <td><?//=$row->option_2_value?></td> -->
                                <!-- <td><?//=$row->reference_txn_id?></td> -->
                                <td><?=$row->invoice_number?></td>
                                <!-- <td><?//=$row->custom_number?></td> -->
                                <td><?=$row->quantity?></td>
                                <!-- <td><?//=$row->receipt_id?></td> -->
                                <td><?=$row->address_line_1?></td>
                                <td><?=$row->address_line_2?></td>
                                <td><?=$row->city?></td>
                                <td><?=$row->state?></td>
                                <td><?=$row->postal_code?></td>
                                <!-- <td><?//=$row->country?></td> -->
                                <!-- <td><?//=$row->contact_phone_number?></td> -->
                                <!-- <td><?//=$row->subject?></td> -->
                                <!-- <td><?//=$row->note?></td> -->
                                <td><?=$row->country_code?></td>
                                <td><?=$row->balance_impact?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>


<?= $this->endSection() ?>