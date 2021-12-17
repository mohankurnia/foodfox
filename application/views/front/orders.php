<div class="container mt-3">
    <?php if($this->session->flashdata('success_msg') != ""):?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success_msg');?>
    </div>
    <?php endif ?>
    <?php if($this->session->flashdata('error_msg') != ""):?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error_msg');?>
    </div>
    <?php endif ?>
    <div class="container shadow-container">
        <h2 class="text-center">Order Terkini</h2>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Tanggal Order</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php if(!empty($orders)) {?>
                    <?php foreach($orders as $order) { ?>
                    <?php $status=$order['status']; 
                            if($status=="" or $status=="NULL" or $status=="dalam proses" or $status=="ditolak") { ?>
                    <tr>
                        <td><?php echo $order['d_name']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo 'Rp. '.$order['price'].'K'; ?></td>
                        <?php if($status=="" or $status=="NULL") { ?>
                        <td> <button type="button" class="btn btn-secondary"><i class="fas fa-bars"></i> Dikirim</button></td>
                        <?php } if($status=="in process") { ?>
                        <td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> Dalam Perjalanan</button></td>
                        <?php }?>
                        <?php if($status=="rejected") { ?>
                        <td> <button type="button" class="btn btn-danger"> <i class="far fa-times-circle"></i> Dibatalkan</button>
                        </td>
                        <?php } ?>
                        <td><?php echo $order['date']; ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="deleteOrder(<?php echo $order['o_id']; ?>)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Batal</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="6">Records tidak ditemukan</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <h2 class="text-center">All Order</h2>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Item</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php if(!empty($orders)) {?>
                    <?php foreach($orders as $order) { ?>
                    <?php $status=$order['status']; 
                            if($status=="closed") { ?>
                    <tr>
                        <?php $cDate = strtotime($order['date']); ?>
                        <td><?php echo date('d-M-Y',$cDate); ?></td>
                        <td><?php echo $order['d_name']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo 'Rp.'.$order['price'].'K'; ?></td>
                        <td> <button type="button" class="btn btn-success"><i class="fas fa-check"></i> Terkirim</button>
                        <td><a href="<?php echo base_url().'orders/invoice/'.$order['o_id']; ?>" class="btn btn-info"><i class="fas fa-file-alt"></i> Invoice</a></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="5">Records tidak ditemukan</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function deleteOrder(id) {
        if (confirm("Are you sure you want to cancel this order?")) {
        window.location.href = '<?php echo base_url().'orders/deleteOrder/';?>' + id;
        }
    }
</script>