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
                        <th>TYPE</th>
                        <th>TIME</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>ACTIVITY</th>
                        <th>TYPE</th>
                        <th>TIME</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?=$row->id?></td>
                            <td><?=$row->activity?></td>
                            <td ><button type="button" class="btn btn-primary disabled"><?=$row->type?></button></td>
                            <td><?=$row->created_date?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>