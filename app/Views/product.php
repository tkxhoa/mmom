<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-body">
    <form class="user" method="POST" action="<?=site_url('product/create') ?>">
        <table class="my-table">
            <tr>
                <td><span class="font-weight-bold">Product Title: </span></td>
                <td><input type="text" style="width:555px" name="title" aria-describedby="emailHelp"></td>
            </tr>    
            <tr>
                <td><span class="font-weight-bold">Design For: </span></td>
                <td><input type="text" style="width:255px" name="design_for" aria-describedby="emailHelp"></td>
            </tr>  
            <tr>
                <td><span class="font-weight-bold">Product kind: </span></td>
                <td>
                    <select name="kind">
                        <option value="" selected>---</option>
                        <?php foreach ($product_kinds as $product_kind): ?>
                            <option value="<?=$product_kind?>" <?=$product_kind == $kind ? 'selected' : ''?>><?=$product_kind?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>  
            <tr>
                <td><span class="font-weight-bold">Shop type: </span></td>
                <td>
                    <input type="radio" id="shop_type_etsy" name="shop_type" value="etsy">
                    <label for="shop_type_etsy">Etsy</label>
                    <input type="radio" id="shop_type_merch" name="shop_type" value="merch">
                    <label for="shop_type_merch">Merch</label>
                    <input type="radio" id="shop_type_both" name="shop_type" value="">
                    <label for="shop_type_both">All</label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add New Product</button></td>
            </tr>
            
        </table>
    </form>   
    </div>    
</div>    

<div style="width:30px; display:inline;">
    <form class="user" method="GET" action="<?=site_url('product') ?>">
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
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>TITLE</th>
                        <th>SHOP</th>
                        <th>KIND</th>
                        <th>MADE</th>
                        <th>LOCATION</th>
                        <th>DESIGN FOR</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>TITLE</th>
                        <th>SHOP</th>
                        <th>KIND</th>
                        <th>MADE</th>
                        <th>LOCATION</th>
                        <th>DESIGN FOR</th>
                    </tr>
                </tfoot>
                <tbody class="tbl-text-font-size">
                    <?php $i = 0; ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td style="width:30px"><?=++$i?></td>
                            <td><span id='product_title<?=$i?>'><?=$row->title?> - <?=$row->code?></span> <button onclick="copy_text_fun('product_title<?=$i?>')">COPY</button></td>
                            <td style="width:40px"><?=$row->shop_type?></td>
                            <td class="text-editting" style="width:40px">
                                <label for="<?=$row->id?>-kind" class="control-label">
                                    <?=$row->kind?>
                                </label>
                                <input type="text" value="<?=$row->kind?>" style="display:none;width:30px" />
                            </td>
                            <td class="text-editting" style="width:35px">
                                <label for="<?=$row->id?>-designed_flg" class="control-label">
                                    <?=$row->designed_flg?>
                                </label>
                                <input type="text" value="<?=$row->designed_flg?>" style="display:none;width:30px" />
                            </td>
                            <!-- <td class="text-editting"><?//=$row->design_location?></td> -->
                            <td class="text-editting" style="width:310px">
                                <label for="<?=$row->id?>-design_location" class="control-label">
                                    <?=$row->design_location?>
                                </label>
                                <input type="text" value="<?=$row->design_location?>" style="display:none;width:300px" />
                            </td>
                            <td class="text-editting" style="width:100px">
                                <label for="<?=$row->id?>-design_for" class="control-label">
                                    <?=$row->design_for?>
                                </label>
                                <input type="text" value="<?=$row->design_for?>" style="display:none;width:85px" />
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>