<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>IMPORT ORDERS</th>
                    <th>FULFILLED</th>
                    <th>TRACKING</th>
                    <th>SHIPPED</th>
                </tr>
            </thead>
            <tbody class="tbl-text-font-size">
                <tr>
                    <td style="width:25%;">
                        <form class="user" method="POST" action="<?=site_url('etsyorder/importcsv') ?>" enctype="multipart/form-data">
                            <div class="formgroup">
                                <input type="file" style="width:255px" name="csv_file" aria-describedby="emailHelp">
                                <br/><br/>
                                <select name="shop_name" id="list_etsy_csv">
                                    <option value="" selected>---</option>
                                    <?php foreach ($listEtsy as $etsy): ?>
                                        <option value="<?=$etsy->shop_name?>"><?=$etsy->shop_name?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br/><br/>
                                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Import CSV</button>
                            </div>
                        </form>  
                    </td>
                    <td style="width:25%;align:center">
                        <form class="user" method="POST" action="<?=site_url('etsyorder/updateFulfill') ?>">
                            <div class="font-weight-bold">Input Order Ids:</div>
                            <div class="form-group">
                                <textarea id="order_ids" name="order_ids" rows="3" cols="35"></textarea>
                            </div>
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Fulfilled Update</button>
                        </form>  
                    </td>
                    <td style="width:25%;">
                        <form class="user" method="POST" action="<?=site_url('etsyorder/updateTracking') ?>">
                            <div class="font-weight-bold">Input Order Ids:</div>
                            <div class="form-group">
                                <textarea id="order_ids" name="order_ids" rows="3" cols="35"></textarea>
                            </div>
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tracking Update</button>
                        </form>  
                    </td>
                    <td style="width:25%;">
                        <form class="user" method="POST" action="<?=site_url('etsyorder/updateShipped') ?>">
                            <div class="font-weight-bold">Input Order Ids:</div>
                            <div class="form-group">
                                <textarea id="order_ids" name="order_ids" rows="3" cols="35"></textarea>
                            </div>
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Shipped Update</button>
                        </form> 
                    </td>
                    
                </tr>    
            </tbody>
        </table>  
    </div>    
</div> 
   <!--Hidden form  -->
<form class="user" method="get" action="<?=site_url('etsyorder') ?>" id="form_etsyorder_hidden">
    <input type="hidden" id="hidden_shop_name" name="shop_name" value="<?=$shopName?>">
    <input type="hidden" id="hidden_fulfilled_flg" name="fulfilled_flg" value="<?=$fulfilledFlg?>">
</form>

<form class="user" method="get" action="<?=site_url('export_csv_etsy_orders') ?>" id="form_hidden_export_csv_etsy_orders">
    <input type="hidden" id="hidden_csv_shop_name" name="shop_name" value="<?=$shopName?>">
</form>


<div style="width:30px; display:inline;">
    <span>Shop:</span>
    <select id="list_etsy">
        <option value="" selected>---</option>
        <?php foreach ($listEtsy as $etsy): ?>
            <option value="<?=$etsy->shop_name?>" <?=$shopName == $etsy->shop_name ? 'selected' : ''?>><?=$etsy->shop_name?></option>
        <?php endforeach; ?>
    </select>

    <span>Fulfilled:</span>
    <select id="list_fulfilled_flg">
        <option value="" selected>---</option>
        <option value="0" <?=$fulfilledFlg === '0' ? 'selected' : ''?>>Not</option>
        <option value="1" <?=$fulfilledFlg === '1' ? 'selected' : ''?>>Yes</option>
    </select>
    <button class="btn btn-primary" type="button" id="btn_search">
        <i class="fas fa-search fa-sm"></i>
    </button>        
    
    
    <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="btn_export_csv">
        <i class="fas fa-download fa-sm text-white-50"></i> CSV to Fulfill
    </span>
</div>

<div class="m-0 font-weight-bold text-primary">Total Result: <?=count($results)?></div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <?php $tblHeader = '<tr>
                        <th>SHOP<br/>NAME</th>
                        <th>ORDER ID</th>
                        <th>SALE<br/>DATE</th>
                        <th>ITEM NAME</th>
                        <th>QTY</th>
                        <th>PRICE</th>
                        <th>ITEM TOTAL</th>
                        <th>TRANSACTION</th>
                        <th>SHIP NAME</th>
                        <th>ADDRESS</th>
                        <th>FF</th>
                        <th>TR</th>
                        <th>SH</th>
                    </tr>';?>
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
                        <?php $i++?>
                        <tr>
                            <td><?=$row->label?><br/> <?=$row->shop_name?></td>
                            <td><?=$row->order_id?></td>
                            <td><?=$row->sale_date?></td>
                            <td><?=$row->item_name?></td>
                            <td><?=$row->quantity?></td>
                            <td>$<?=$row->price?></td>
                            <td>$<?=$row->item_total?></td>
                            <td><?=$row->transaction_id?></td>
                            <td><?=$row->ship_name?></td>
                            <td><?=$row->ship_address1 . '<br/>' . $row->ship_city . ',' . $row->ship_state . ', ' . $row->ship_zipcode . ',<br/>' .$row->ship_country?></td>
                            <!-- <td><?//=$row->fulfilled_flg ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : '' ?></td> -->
                            <td class="flag-editting" style="width:35px">
                                <label for="<?=$row->id?>-fulfilled_flg" class="control-label">
                                <?=$row->fulfilled_flg ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : '' ?>
                                </label>
                                <input type="text" value="<?=$row->fulfilled_flg?>" style="display:none;width:25px" />
                            </td>
                            <!-- <td><?//=$row->tracking_flg ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : '' ?></td> -->
                            <td class="flag-editting" style="width:35px">
                                <label for="<?=$row->id?>-tracking_flg" class="control-label">
                                <?=$row->tracking_flg ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : '' ?>
                                </label>
                                <input type="text" value="<?=$row->tracking_flg?>" style="display:none;width:25px" />
                            </td>
                            <!-- <td><?//=$row->shipped_flg ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : '' ?></td> -->
                            <td class="flag-editting" style="width:35px">
                                <label for="<?=$row->id?>-shipped_flg" class="control-label">
                                <?=$row->shipped_flg ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : '' ?>
                                </label>
                                <input type="text" value="<?=$row->shipped_flg?>" style="display:none;width:25px" />
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>