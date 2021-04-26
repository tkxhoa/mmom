<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-body">
    <form class="user" method="POST" action="<?=site_url('finance/create') ?>">
        <table class="my-table">
            <tr>
                <td><span class="font-weight-bold">Kind </span></td>
                <td>
                    <select name="kind" id="transfer_kind">
                        <option value="" selected>---</option>
                        <?php foreach ($kindList as $kind): ?>
                            <option value="<?=$kind?>" <?=!empty($data['kind']) && $kind == $data['kind'] ? 'selected' : ''?>><?=$kind?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>   
            <tr>
                <td><span class="font-weight-bold">Bank Accounts: </span></td>
                <td>
                    <select name="account">
                        <option value="" selected>---</option>
                        <?php foreach ($bank_list as $bank): ?>
                            <option value="<?=$bank->name?>" <?=!empty($data['account']) && $bank->name == $data['account'] ? 'selected' : ''?>><?=$bank->name?></option>
                        <?php endforeach; ?>
                    </select>

                    <span id="to_account" class="account2" style="display:none">
                        <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:</label>
                        <select name="to_account">
                            <option value="" selected>---</option>
                            <?php foreach ($bank_list as $bank): ?>
                                <option value="<?=$bank->name?>" <?=!empty($data['toAccount']) && $bank->name == $data['toAccount'] ? 'selected' : ''?>><?=$bank->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </span>

                    <span id="from_account" class="account2" style="display:none">
                        <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From(PP,PO,PI):</label>
                        <input type="text" style="width:255px" name="from_account" value="<?=$data['toAccount'] ?? ''?>">
                    </span>
                </td>
            </tr>  
            <tr>
                <td><span class="font-weight-bold">Category: </span></td>
                <td><input type="text" style="width:150px" name="category" value="<?=$data['category'] ?? ''?>"></td>
            </tr> 
            <tr>
                <td><span class="font-weight-bold">Amount: </span></td>
                <td>
                    <input type="text" style="width:100px" class="amount" id="amount" name="amount" value="<?=$data['amount'] ?? ''?>">
                    <label for="">Currency:</label>
                    <input type="text" style="width:35px" name="currency" id="currency" value="<?=$data['currency'] ?? ''?>">
                    <label for="">Rate</label>
                    <input type="text" style="width:100px" class="amount" id="rate" name="rate" value="<?=$data['rate'] ?? ''?>">
                </td>
            </tr> 
            <tr>
                <td><span class="font-weight-bold">VND Amount: </span></td>
                <td><input type="text" style="width:150px" name="vnd_amount" id="vnd_amount" value="<?=$data['vnd_amount'] ?? ''?>"></td>
            </tr>      
            <tr>
                <td><span class="font-weight-bold">Issue: </span></td>
                <td><input type="text" style="width:255px" name="issue" value="<?=$data['issue'] ?? ''?>"></td>
            </tr> 
            <tr>
                <td></td>
                <td><button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add New Transaction</button></td>
            </tr>
            
        </table>
    </form>   
    </div>    
</div>    

<div style="width:30px; display:inline;">
    <form class="user" method="GET" action="<?=site_url('credit') ?>">
        <span class="font-weight-bold">Code: </span><input type="text" style="width:100px" name="code" value="<?=$code?>">
        
        <span class="font-weight-bold">Shop Type: </span>
        <input type="radio" id="shop_type_both" name="shop_type" value="" checked>
        <label for="shop_type_both" >All</label>
        <input type="radio" id="shop_type_etsy_search" name="shop_type" value="etsy" <?=$shop_type == 'etsy' ? 'checked' : ''?>>
        <label for="shop_type_etsy">Etsy</label>
        <input type="radio" id="shop_type_merch" name="shop_type" value="merch" <?=$shop_type == 'merch' ? 'checked' : ''?>>
        <label for="shop_type_merch">Merch</label>

        <button class="btn btn-primary" type="submit" id="btn_search">
            <i class="fas fa-search fa-sm"></i>
        </button> 
    </form> 
</div>

<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php $tblHeads = '<tr>
                        <th>NO.</th>
                        <th>KIND</th>
                        <th>CATEGORY</th>
                        <th>ACCOUNT</th>
                        <th>ACCOUNT 2</th>
                        <th>CURRENCY</th>
                        <th>AMOUNT</th>
                        <th>RATE</th>
                        <th>VND AMOUNT</th>
                        <th>BALANCE</th>
                        <th>ISSUE</th>
                        <th>IMPACT</th>
                        <th>TIME</th>
                    </tr>';?>
                <thead>
                    <?=$tblHeads?>
                </thead>
                <tfoot>
                    <?=$tblHeads?>
                </tfoot>
                <tbody class="tbl-text-font-size">
                    <?php $i = 0; ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$row->kind?></td>
                            <td><?=$row->category?></td>
                            <td><?=$row->account?></td>
                            <td><?=$row->account2?></td>
                            <td><?=$row->currency?></td>
                            <td style="text-align:right"><?=number_format ($row->amount, 2)?></td>
                            <td><?=number_format ($row->rate, 0)?></td>
                            <td style="text-align:right"><?=number_format ($row->vnd_amount, 0)?></td>
                            <td style="text-align:right"><?=number_format ($row->balance, 0)?></td>
                            <td><?=$row->issue?></td>
                            <td><?=$row->balance_impact?></td>
                            <td><?=$row->created_date?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>