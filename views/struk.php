

<?php
//session_start();
//modular memanggil file dari folder tampleate
include_once 'template/header.php';
include_once '../controllers/C_penjualan.php';
$member = new C_penjualan();
include_once "../controllers/C_koneksi.php";
$conn = new C_koneksi();
?>
<div class="col-md-5 mb-3" style="margin-top: 20px;">
    <div class="card" id="print">
        <div class="card-header bg-white border-0 pb-0 pt-4">
          <h5 class='card-tittle mb-0 text-center' id="font"><b>GUS Cashier</b></h5>
      <p class='m-0 small text-center'>Cimahi</p>
        <p class='small text-center'>08123456789</p>
        <div class="row">
        <?php
        foreach ($member->tampil_struk($_GET['id']) as $m) {
        ?>
            <div class="col-8 col-sm-9 pr-0">
              <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                  <li>Id : <?= $m->PelangganID; ?></li>
                  <li>Pelanggan : <?= $m->NamaPelanggan; ?></li>
              </ul>
            </div>
            <div class="col-4 col-sm-3 pl-0">
            <ul class="pl-0 small" style="list-style: none;">
              <li>23:59</li>
                  <li>31-12-2023</li>
              </ul>
            </div>
        </div>
        </div>
        <div class="card-body small pt-0">
        <hr class="mt-0">
            <table style="width:100%; border-spacing: 30px;"><tr><th>
                  <span><b>Nama Barang</b></span>
            </th><th>
                <span><b>Jumlah</b></span>
            </th><th>
                <span><b>Harga</b></span>
            </th><th>
                <span><b>Total</b></span>
            </th></tr>
            <?php 
            $penjualan = $_GET['id'];
			$produk = mysqli_query($conn->conn(),"SELECT * FROM `detailpenjualan` JOIN produk ON produk.ProdukID=detailpenjualan.ProdukID WHERE PenjualanID='$penjualan'");
			while($d_produk = mysqli_fetch_array($produk)){
			?>
            <tr>
            <td>
                  <span><b><?= $d_produk['NamaProduk']; ?></b></span>
                  </td>
                  <td>
                <span><b><?= $d_produk['JumlahProduk']; ?></b></b></span>
                </td>
                <td>
                <span><b>Rp.<?= number_format($d_produk['Harga']); ?></b></b></span>
                </td>
                <td>
            <?php $total = $d_produk['Harga'] * $d_produk['JumlahProduk']; ?>
                <span><b><?= $total . ".00"; ?></b></b></span>

                </td>
            </tr>
            <?php } ?>
            </table>
            <div class="col-12">
                <hr class="mt-2">
                  <ul class="list-group border-0">
                  <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                      <b>Total </b>
                      <span><b>Rp.<?= number_format($m->TotalHarga); ?></b></span>
                  </li>
                  <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                    <?php 
                    if ($_POST['Bayar'] != "" && $_POST['Kembalian'] != "") {
                        $bayar = $_POST['Bayar'];
                        $kembalian = $_POST['Kembalian'];
                    }else {
                        $bayar = 0;
                        $kembalian = 0;
                    }
                    ?>
                      <b>Bayar</b>
                      <span><b>Rp.<?= $bayar; ?></b></span>
                  </li>
                  <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                      <b>Kembalian</b>
                      <span><b>Rp.<?= $kembalian; ?></b></span>
                  </li>
                  </ul>
                  <?php
        }
?>
            </div>
            </div>
        </div>
    </div>