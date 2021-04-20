<?= $this->extend('Views\management_layout') ?>

<?= $this->section('content') ?>
    <input type="hidden" id="hidden_arr_sale_dates" value="<?=implode(',',$arrSaleDates)?>" />
    <input type="hidden" id="hidden_arr_items_total" value="<?=implode(',',array_values($arrItemsTotal))?>" />
    <input type="hidden" id="hidden_max_items_total" value="<?=$maxItemsTotal?>" />
    <input type="hidden" id="hidden_arr_qty_total" value="<?=implode(',',array_values($arrQtyTotal))?>" />
    <input type="hidden" id="hidden_max_qty" value="<?=$maxQty?>" />

    <input type="hidden" id="hidden_arr_shop_names" value="<?=implode(',',array_values($arrShopNames))?>" />
    <input type="hidden" id="hidden_arr_shop_items_total" value="<?=implode(',',array_values($arrShopItemsTotal))?>" />
    <input type="hidden" id="hidden_arr_shop_qty_total" value="<?=implode(',',array_values($arrShopQtyTotal))?>" />

       <!--Hidden form  -->
    <form class="user" method="get" action="<?=site_url('etsysummary') ?>" id="form_etsysummary_hidden">
        <input type="hidden" id="hidden_period" name="period" value="<?=$period?>">
    </form>
    
    <div style="width:30px; display:inline;">
        <span>Period:</span>
        <select id="list_periods">
            <option value="this_week" <?=$period == 'this_week' ? 'selected' : ''?>>This Week</option>
            <option value="last_week" <?=$period == 'last_week' ? 'selected' : ''?>>Last Week</option>
            <option value="this_month" selected>This Month</option>
            <option value="last_month" <?=$period == 'last_month' ? 'selected' : ''?>>Last Month</option>
            <option value="30_days" <?=$period == '30_days' ? 'selected' : ''?>>Last 30 Days</option>
            <option value="this_year" <?=$period == 'this_year' ? 'selected' : ''?>>This Year</option>
            <option value="last_year" <?=$period == 'last_year' ? 'selected' : ''?>>Last Year</option>
        </select>
    </div>
    <div class="row">
		<div class="col-xl-8 col-lg-7">
			<!-- Bar Chart -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">TOTAL REVENUE: <span class="h5 mb-0 font-weight-bold text-primary">$<?=$totalRevenue?></span></h6>
				</div>
				<div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChartRevenue"></canvas>
                    </div>
                    <hr>
                </div>
			</div>
		</div>

		<!-- Donut Chart -->
		<div class="col-xl-4 col-lg-5">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Revenue Chart</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-pie pt-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
						<canvas id="myPieChartRevenue" width="301" height="253" class="chartjs-render-monitor" style="display: block; width: 301px; height: 253px;"></canvas>
					</div>
					<hr>
				</div>
			</div>
		</div>

        <div class="col-xl-8 col-lg-7">
			<!-- Bar Chart -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">TOTAL SOLD: <span class="h5 mb-0 font-weight-bold text-primary"><?=$totalQuantity?></span></h6>
				</div>
				<div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChartSold"></canvas>
                    </div>
                    <hr>
                </div>
			</div>
		</div>

        <!-- Donut Chart -->
		<div class="col-xl-4 col-lg-5">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Sold Chart</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-pie pt-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
						<canvas id="myPieChartSold" width="301" height="253" class="chartjs-render-monitor" style="display: block; width: 301px; height: 253px;"></canvas>
					</div>
					<hr>
				</div>
			</div>
		</div>

	</div>
<?= $this->endSection() ?>

