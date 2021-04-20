<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-body">
    <form class="user" method="POST" action="<?=site_url('product/create') ?>">
        <div class="formgroup">
            <span class="font-weight-bold">Product Title: </span><input type="text" style="width:255px" name="title" aria-describedby="emailHelp">
            <span class="font-weight-bold">Design For: </span><input type="text" style="width:75px" name="design_for" aria-describedby="emailHelp">
            <span class="font-weight-bold">Product kind: </span><input type="text" style="width:75px" name="kind" aria-describedby="emailHelp">
            <br/><br/>
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add New Product</button>
        </div>
    </form>   
    </div>    
</div>    

<div style="width:30px; display:inline;">
    <form class="user" method="POST" action="<?=site_url('product') ?>">
        <span class="font-weight-bold">Code: </span><input type="text" style="width:255px" name="code" value="<?=$code?>">
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
                        <th>KIND</th>
                        <th>DEISGNED</th>
                        <th>LOCATION</th>
                        <th>DESIGN FOR</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>TITLE</th>
                        <th>KIND</th>
                        <th>DEISGNED</th>
                        <th>LOCATION</th>
                        <th>DESIGN FOR</th>
                    </tr>
                </tfoot>
                <tbody class="tbl-text-font-size">
                    <?php $i = 0; ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><span id='product_title'><?=$row->title?> - <?=$row->code?></span> <button onclick="copy_text_fun('product_title')">COPY</button></td>
                            <td><?=$row->kind?></td>
                            <td class="text-editting" style="width:50px">
                                <label for="<?=$row->id?>-designed_flg" class="control-label">
                                    <?=$row->designed_flg?>
                                </label>
                                <input type="text" value="<?=$row->designed_flg?>" style="display:none;width:45px" />
                            </td>
                            <!-- <td class="text-editting"><?//=$row->design_location?></td> -->
                            <td class="text-editting" style="width:250px">
                            <label for="<?=$row->id?>-design_location" class="control-label">
                                <?=$row->design_location?>
                            </label>
                            <input type="text" value="<?=$row->design_location?>" style="display:none;width:145px" />
                            </td>
                            <td><?=$row->design_for?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>