<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>
    

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
                        <th>PAYPAL REGISTERED</th>
                        <th>PAYPAL USED</th>
                        <th>ETSY REGISTERED</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>EMAIL</th>
                        <th>MAIN PAYPAL MAIL</th>
                        <th>TYPE</th>
                        <th>PAYPAL REGISTERED</th>
                        <th>PAYPAL USED</th>
                        <th>ETSY REGISTERED</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?=$row->id?></td>
                            <td><?=$row->email?></td>
                            <td><?=$row->main_paypal_email?></td>
                            <td ><button type="button" class="btn btn-primary disabled"><?=$row->type?></button></td>
                            <td>x</td>
                            <td>x</td>
                            <td>x</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>