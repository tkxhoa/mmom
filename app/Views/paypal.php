<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>
    

<div class="row">
    <?php foreach ($results as $row): ?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card <?=$row->active_flg ? 'border-left-primary' : 'border-left-warning bg-verifying' ?>  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xxs font-weight-bold text-primary text-uppercase mb-1 text-underline"><?=$row->paypal_email;?></div>
                        <div class="h5 mb-0 font-weight-bold text-primary">$<?=round($row->balance, 2);?></div>
                        <div class="h5 mb-0 font-weight-bold font-italic text-gray-800">$<?=$row->holding_amount;?></div>
                        <div class="h5 mb-0 font-weight-light text-primary"><?=$row->type;?></div>
                        <div class="h5 mb-0 font-weight-light font-italic <?=$row->remark == 'VERIFIED' ? 'text-primary' : 'text-danger';?>"><?=$row->remark;?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php endforeach; ?>    
    
</div>


<?= $this->endSection() ?>