<form action='<?php echo base_url().$this->uri->segment(1)."/proses_penjualan?id=".$this->input->post('id'); ?>' method='POST'>
    <div class="modal-body">
    <input type='text' class='form-control' placeholder='- - - - - - - -' name='resi'>
    </div>
    <div class="modal-footer">
    <button type="submit" name='proses' class="btn btn-primary pull-left">Proses Pesanan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    </div>
</form>