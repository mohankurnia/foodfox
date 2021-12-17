<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i class="fa fa-users" style="color:#d8ad2e;font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countUser; ?></h2>
                        <p class="m-b-0">User/s</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i id="iarchive" class="fa fa-building" style="color:#357ae8;font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countStore; ?></h2>
                        <p class="m-b-0">Restaurant/s</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i class="fa fa-utensils" style="color:#17a2b8; font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countDish; ?></h2>
                        <p class="m-b-0">Makanan</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i class="fa fa-file" style="color:#9466de; font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countOrders; ?></h2>
                        <p class="m-b-0">Total Order</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i class="fa fa-th-large" style="color:#505050; font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countCategory;?></h2>
                        <p class="m-b-0">Category</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i class="fa fa-spinner" style="color:#ad6d9c; font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countPendingOrders; ?></h2>
                        <p class="m-b-0">Order Tertunda</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i class="fa fa-check-square" style="color:#28a745; font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countDeliveredOrders; ?></h2> 
                        <p class="m-b-0">Order Terkirim</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-30">
                <div class="media">
                    <div class="media-left media media-middle">
                        <span><i class="fa fa-times-circle" style="color:#dc3545; font-size: 2.5em;"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $countRejectedOrders; ?></h2>
                        <p class="m-b-0">Order Ditolak</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h2>Laporan Restaurants</h2>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Restaurant</th>
                                <th>Total Harga Penjualan</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php $no_res = 1; ?>
                            <?php if(!empty($resReport)) {?>
                            <?php foreach($resReport as $report) { ?>
                            <tr>
                                <td><?php echo $no_res++; ?></td>
                                <td><?php echo $report->name; ?></td>
                                <td><?php echo $report->price; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } else {?>
                            <tr>
                                <td colspan="4">Records tidak ditemukan</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <a href="<?php $id=1; echo base_url().'admin/home/generate_pdf/'.$id; ?>"
                        class="btn btn-success mt-3">Unduh Laporan</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h2>Laporan Makanan</h2>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Makanan</th>
                                <th>Banyak Order</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php $no_makn = 1; ?>
                            <?php if(!empty($dishReport)) {?>
                            <?php foreach($dishReport as $report) { ?>
                            <tr>
                                <td><?php echo $no_makn++; ?></td>
                                <td><?php echo $report->d_name; ?></td>
                                <td><?php echo $report->qty; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } else {?>
                            <tr>
                                <td colspan="4">Records tidak ditemukan</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <a href="<?php $id=2; echo base_url().'admin/home/generate_pdf/'.$id; ?>"
                        class="btn btn-success mb-3">Unduh Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>