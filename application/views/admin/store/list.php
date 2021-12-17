<div class="container my-3">
    <?php if($this->session->flashdata('res_success') != ""):?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('res_success');?>
    </div>
    <?php endif ?>
    <?php if($this->session->flashdata('error') != ""):?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error');?>
    </div>
    <?php endif ?>
    <div class="row">
        <div class="col-md-6">
            <h4>Restaurant Tersedia</h4>
        </div>
        <div class="col-md-6 text-right">
            <input class="form-control mb-3" id="myInput" type="text" placeholder="Cari..." style="width:50%;">
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-responsive table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kontak</th>
                        <th>Website</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        <th>Hari Buka</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php $no = 1; ?>
                    <?php if(!empty($stores)) { ?>
                    <?php foreach($stores as $store) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $store['name']; ?></td>
                        <td><?php echo $store['email']; ?></td>
                        <td><?php echo $store['phone']; ?></td>
                        <td><?php echo $store['url']; ?></td>
                        <td><?php echo $store['o_hr']; ?></td>
                        <td><?php echo $store['c_hr']; ?></td>
                        <td><?php echo $store['o_days']; ?></td>
                        <td><?php echo $store['address']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'admin/store/edit/'.$store['r_id']?>"
                                class="btn btn-info mb-1"><i class="fas fa-edit mr-1"></i>Edit</a>

                            <a href="javascript:void(0);" onclick="deleteStore(<?php echo $store['r_id']; ?>)"
                                class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else {?>
                    <tr>
                        <td colspan="10">Records tidak ditemukan</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
function deleteStore(id) {
    if (confirm("Anda yakin ingin menghapus?")) {
        window.location.href = '<?php echo base_url().'admin/store/delete/';?>' + id;
    }
}
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>