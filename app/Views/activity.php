<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>
    

<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>ACTIVITY</th>
                        <th>TIME</th>
                        <th>RESULT</th>
                        <th>TIME</th>
                        <th>TYPE</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>ACTIVITY</th>
                        <th>TIME</th>
                        <th>RESULT</th>
                        <th>TIME</th>
                        <th>TYPE</th>
                    </tr>
                </tfoot>
                <tbody class="tbl-text-font-size">
                    <?php $i = 0; ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$row->activity?></td>
                            <td><?=$row->created_date?></td>
                            <td><?=$row->result?></td>
                            <td><?=$row->result_date?></td>
                            <td >
                                <button type="button" style="font-size:11px;" class="btn <?=$row->type == 'etsy' ? 'btn-etsy' : 'btn-primary'?> btn-font-size"><?=$row->type?></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>