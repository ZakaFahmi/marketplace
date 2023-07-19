 <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Transaksi Penjualan / Orderan Konsumen</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>reseller/tambah_penjualan'>Tambah Penjualan</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class='table-responsive'>
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Konsumen</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th>Total + Ongkir</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    if ($row['ongkir']!='0'){ $ongkir = "<b style='text-transform:uppercase'>$row[kurir]</b> - Rp ".$row['ongkir']; }else{ $ongkir = '-'; }
                    echo "<tr><td>$no</td>
                              <td>$row[kode_transaksi]</td>
                              <td><a href='".base_url()."reseller/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
                              <td>$ongkir</td>";
                              if ($row['proses']=='1'){
                                echo "<td><a target='_BLANK' href='https://cekresi.com/?v=wdg&noresi=$row[resi]'><u>".status($row['proses'])."</u></a></td>";
                              }else{
                                echo "<td>".status($row['proses'])."</td>";
                              }
                              echo "<td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."reseller/detail_penjualan/$row[id_penjualan]'><span class='glyphicon glyphicon-search'></span> Detail</a>
                                <div class='btn-group'>
                                  <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                      <span class='caret'></span>
                                  </button>
                                  <ul class='dropdown-menu'>
                                      <li><a onclick=\"return confirm('Yakin Ubah status pesanan jadi Pending?')\" href='".base_url().$this->uri->segment(1)."/proses_penjualan?id=$row[id_penjualan]&status=0'>Pending</a></li>
                                      <li><a href='#' data-toggle='modal' class='modal-default' data-id='$row[id_penjualan]' data-target='#modal-default'>Proses</a></li>
                                      <li><a onclick=\"return confirm('Yakin Ubah status pesanan jadi Konfirmasi?')\" href='".base_url().$this->uri->segment(1)."/proses_penjualan?id=$row[id_penjualan]&status=2'>Konfirmasi</a></li>
                                      <li><a onclick=\"return confirm('Apa anda yakin Pesanan ini sudah selesai?')\" href='".base_url().$this->uri->segment(1)."/proses_penjualan?id=$row[id_penjualan]&status=3'>Selesai</a></li>
                                  </ul>
                                </div>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."reseller/edit_penjualan/$row[id_penjualan]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."reseller/delete_penjualan/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
                </div>
              </div>
              </div>
              </div>

<script>
    $(function(){
        $(document).on('click','.modal-default',function(e){
            e.preventDefault();
            $("#modal-default").modal('show');
            $.post("<?php echo site_url()?>reseller/proses_penjualan",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });
</script>

<div class="modal fade" id="modal-default">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Masukkan No Resi</h4>
    </div>
    <div class="modal-body">
      <div class="content-body"></div>
    </div>
  </div>
</div>
</div>
              