<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>
    

<div style="width:30px; display:inline;">
    <form class="user" method="GET" action="<?=site_url('email') ?>">
        <span class="font-weight-bold">Email: </span><input type="text" style="width:200px" name="email" value="<?=$email ?? '' ?>">
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
                        <th>EMAIL</th>
                        <th>MAIN PAYPAL MAIL</th>
                        <th>TYPE</th>
                        <th>ETSY<br/> REGISTERED</th>
                        <th>ETSY<br/> USED</th>
                        <th>PAYPAL<br/> REGISTERED</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>EMAIL</th>
                        <th>MAIN PAYPAL MAIL</th>
                        <th>TYPE</th>
                        <th>ETSY<br/> REGISTERED</th>
                        <th>ETSY<br/> USED</th>
                        <th>PAYPAL<br/> REGISTERED</th>
                    </tr>
                </tfoot>
                <tbody class="tbl-text-font-size">
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?=$row->id?></td>
                            <td><?=$row->email?></td>
                            <td><?=$row->main_paypal_email?></td>
                            <td ><button type="button" style="font-size:11px;" class="btn btn-primary"><?=$row->type?></button></td>
                            <td><?=$row->registered_flg_etsy ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : ''?></td>
                            <td><?=$row->used_flg_etsy ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : ''?></td>
                            <td><?=$row->registered_flg_paypal ? '<span class="btn btn-success btn-circle btn-very-sm"><i class="fas fa-check"></i></span>' : ''?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>