<section class="content-header">
      <h1>Sales
        Penjualan
        <small> Penjualan product</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-shopping-cart"></i></a></li>
        <li> Transaction</li>
        <li class="active"> Sales</li>
      </ol>
</section>

<section class="content">
    <div class="row">
            <div class="col-md-5">
                <div class="box box-widget"> 
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align : top "> 
                                    <label for="Date"> Date  </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" id="date" value="<?=date('Y-m-d')?>" class="form-control ">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align :top; width :30%"> 
                                    <label for="user"> kasir </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="user" value="<?=$this->user_login->user_session()->username?>" class="form-control " readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">
                                    <br>
                                    <label for="pelanggan">Pelanggan</label>
                                </td>
                                <td>
                                    <select id="pelanggan" class="form-control">
                                        <option value="">Umum</option>
                                        <?php foreach ($pelanggan as $cust => $value) {
                                            echo '<option value="'.$value->pelanggan_id.'">'.$value->nama_pelanggan.'</option>';
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

                
            <div class="col-md-4" >
                <div class="box box-widget"> 
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align : top; width: 30% "> 
                                    <label for="kode_item"> Kode Barang  </label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <input type="hidden" id="item_id">
                                        <input type="hidden" id="price">
                                        <input type="hidden" id="stock">
                                        <input type="kode_item" id="kode_item" value="" class="form-control ">
                                            <span class="input-group-btn"> 
                                                <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-item">
                                                    <i class="fa fa-search"></i>
                                                    </button>
                                            </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align :top; width :30%"> 
                                    <label for="qty"> qty </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="qty" value="1"  min="1" class="form-control" onchange="gantiQty()">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div>
                                        <button type="button" id="add_cart" class="btn btn-warning">
                                            <i class="fa fa-cart-plus"></i> Add barang
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3" >
                <div class="box box-widget"> 
                    <div class="box-body">
                        <div align="right" >
                            <h4> Invoice <b> <span id="invoice"><?php echo $invoice ?></span></b></h4>
                            <h1><b><span class="font-size:50pt" id="grand_total2">0</span></b></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        
        <div class="row">
            <div class="col-md-12"> 
                <div class="box box-widget">
                    <div class="box-body table-responsive"> 
                        <table class="table table-boredered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th width="10%">Discount Item</th>
                                    <th width="15%">Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="cart_table">
                                <?php  $this->view('transaction/sales/cart_data') ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="box box-widget"> 
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align : top; width : 30% "> 
                                    <label for="sub_total"> Sub Total </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="sub_total" value="0" min="0" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align :top"> 
                                    <label for="discount"> Discount </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" value="0"  min="0" id="discount" class="form-control">
                                    </div>
                                </td>
                            </tr>
                                <tr>
                                    <td style="vertical-align : top ">
                                        <label for="grand_total"> Grand Total </label>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" id="grand_total" value="0" readonly>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3">
                <div class="box box-widget"> 
                    <div class="box-body">
                        <table>
                            <tr>
                                <td style="vertical-align : top; width : 25% "> 
                                    <label for="cash"> cash</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="cash" value="0" min="0" class="form-control ">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align :top"> 
                                    <label for="change"> change </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="change" value="0"  min="0"class="form-control " readonly>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box box-widget"> 
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align : top; width : 20% "> 
                                    <label for="note">note</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                       <textarea name="note" id="note"  rows="5" placeholder="note" class="form-control"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div>
                    <button id="cencel-payment" class="btn btn-warning btn-flat btn-sm"> 
                        <i class="fa fa-refresh"></i>  Cancel
                    </button>
                    </br>
                    </br>
                    <button id="process_payment" class="btn btn-success btn-flat btn-sm">
                        <i class="fa fa-paper-plane-o"></i> Payment
                    </button>
                </div>
            </div>
    </div>
</section>

<!-- modal add item -->
<div class="modal fade" id="modal-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hodden="true">&times;</span>
                </button>
                <h4 class="modal-title">Select Produk Item </h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bodered table-striped" id="table1" style="width: 100%">
                    <thead>
                        <tr>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Unit</td>
                            <td>Price</td>
                            <td>Stock</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $key => $item) { ?>
                        <tr>
                            <td><?php echo $item->kode_item ?></td>
                            <td><?php echo $item->nama_item ?></td>
                            <td><?php echo $item->nama_unit ?></td>
                            <td class="text-center"><?php echo indo_currency($item->price) ?></td>
                            <td class="text-right"><?php echo $item->stock ?></td>
                            <td class="text-right">
                                <button class="btn btn-xs btn-info" id="select"
                                    data-id="<?=$item->item_id?>"
                                    data-kode_item="<?=$item->kode_item?>"
                                    data-price="<?=$item->price?>"
                                    data-stock="<?=$item->stock?>"
                                    onclick="setMaxQty('<?php echo $item->kode_item ?>')"
                                >
                                    <i class="fa fa-check"></i>Select
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<!-- modal edit cart -->
<div class="modal fade" id="modal-item-update">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hodden="true">&times;</span>
                </button>
                <h4 class="modal-title">Update Cart Item </h4>
            </div>

            <div class="modal-body">
                <input type="hidden" id="cartid_item">
                <div class="form-group">
                    <label for="product_item">Product Item</label>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" id="kodeitem" class="form-control" readonly>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="product_item" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="price_item">Price Item</label>
                    <input type="number" id="price_item" class="form-control">
                </div>

                <div class="form-group">
                    <label for="qty_item">QTY Item</label>
                    <input type="number" id="qty_item" class="form-control">
                </div>

                <div class="form-group">
                    <label for="total_before">Total Before Discount</label>
                    <input type="number" id="total_before" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="discount_item">Discount Per item</label>
                    <input type="number" id="discount_item" min="0" class="form-control">
                </div>

                <div class="form-group">
                    <label for="total_item">Discount After Item</label>
                    <input type="number" id="total_item" class="form-control" readonly>
                </div>

            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="edit_cart" class="btn btn-success">
                        <i class="fa fa-paper-plane"></i>Save
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).on('click', '#select', function(){
        $('#item_id').val($(this).data('id'))
        $('#kode_item').val($(this).data('kode_item'))
        $('#price').val($(this).data('price'))
        $('#stock').val($(this).data('stock'))
        $('#modal-item').modal('hide')
    })    

    $(document).on('click', '#add_cart', function(){
        var item_id     = $('#item_id').val()
        var price       = $('#price').val()
        var stock       = $('#stock').val()
        var qty         = $('#qty').val()
        if (item_id == '' ){
            alert('Product Belum dipilih')
            $('#kode_item').focus()
        }
        else if (stock < 1 ){
            alert('Stock Tidak Mencukupi')
            $('#item_id').val('')
            $('#kode_item').val('')
            $('#kode_item').focus()
        }
        // else if (stock < )
        else{
            $.ajax({
                type    : 'POST',
                url     : '<?=site_url('sales/process') ?>',
                data    : {'add_cart' : true, 'item_id' : item_id, 'price' : price, 'qty' : qty },
                dataType: 'json',
                success : function(result){
                    if(result.success == true){
                        $('#cart_table').load('<?=site_url('sales/cart_data') ?>', function(){
                            calculate()
                        })
                        $('#item_id').val('')
                        $('#kode_item').val('')
                        $('#qty').val(1)
                        $('#kode_item').focus()
                    }
                    else{
                        alert('Gagal Tambah Item Cart')
                    }
                }
            })
        }
    })

    //fungsi hapus
     $(document).on('click', '#delete_cart', function(){
        if(confirm('Apakah Anda Yakin Akan Menghapus Data ?')){
            var cart_id = $(this).data('cartid')
            // console.log(cart_id);
            $.ajax({
                type    : 'POST',
                url     : '<?=site_url('sales/cart_delete') ?>',
                data    : {'cart_id' : cart_id},
                dataType: 'json',
                success : function(result){
                    if(result.success == true){
                        $('#cart_table').load('<?=site_url('sales/cart_data') ?>', function(){
                             calculate()
                             alert('Berhasil Hapus Item Cart')
                        })
                    }
                    else{
                        alert('Gagal Hapus Item Cart')
                    }
                }
            })
        }
    })

    //update cart
    $(document).on('click', '#update_cart', function(){
        $('#cartid_item').val($(this).data('cartid'))
        $('#kodeitem').val($(this).data('kodeitem'))
        $('#product_item').val($(this).data('product'))
        $('#price_item').val($(this).data('price'))
        $('#qty_item').val($(this).data('qty'))
        $('#total_before').val($(this).data('price') * $(this).data('qty'))
        $('#discount_item').val($(this).data('discount'))
        $('#total_item').val($(this).data('total'))
        $('#modal-item').modal('hide')
    })    

    function count_update_modal(){
        var price = $('#price_item').val()
        var qty = $('#qty_item').val()
        var discount = $('#discount_item').val()

        total_before = price * qty
        $('#total_before').val(total_before)

        total = (price - discount) * qty
            $('#total_item').val(total)

        if(discount == ''){
            $('#discount_item').val(0)
        }
    }

    $(document).on('keyup mouseup', '#qty_item, #price_item, #discount_item', function() {
        count_update_modal()
    })

    $(document).on('click', '#edit_cart', function(){
        var cart_id     = $('#cartid_item').val()
        var price       = $('#price_item').val()
        var qty         = $('#qty_item').val()
        var discount    = $('#discount_item').val()
        var total       = $('#total_item').val()
        if(price == '' || price < 1 ){
            alert('Price tidak boleh kosong')
            $('#price_item').focus()
        }
        else if (qty == '' || qty < 1 ){
            alert('QTY tidak boleh kosong')
            $('#qty_item').focus()
        } 
        else{
            $.ajax({
                type    : 'POST',
                url     : '<?=site_url('sales/process') ?>',
                data    : {'edit_cart' : true, 'cart_id' : cart_id, 'price' : price, 'qty' : qty, 'discount' : discount, 'total' : total },
                dataType: 'json',
                success : function(result){
                    if(result.success == true){
                        $('#cart_table').load('<?=site_url('sales/cart_data') ?>', function(){
                             calculate()
                            // alert('Berhasil Hapus Item Cart')
                        })
                        $('#modal-item-update').modal('hide')
                        alert('Data Berhasil Diupdate')  
                    }
                    else{
                        alert('Gagal Update Cart!!!')
                    }
                }  
            })
        }
    })

    function calculate(){
        var subtotal = 0;
        $('#cart_table tr').each(function(){
            subtotal += parseInt($(this).find('#total').text())
        })
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

        var discount = $('#discount').val()
        var grand_total = subtotal - discount
        if (isNaN(grand_total)){
            $('#grand_total').val(0)
            $('#grand_total2').text(0)
        }
        else{
            $('#grand_total').val(grand_total)
            $('#grand_total2').text(grand_total)            
        }

        var cash = $('#cash').val()
        cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)

        if(discount == ''){
            $('#discount').val(0)
        }

    }

    $(document).on('keyup mouseup', '#discount, #cash', function() {
        calculate()
    })


    $(document).ready(function(){
        calculate()
    })

    $(document).on('click', '#process_payment', function(){
    var pelanggan_id = $('#pelanggan').val()
    var subtotal    = $('#sub_total').val()
    var discount    = $('#discount').val()
    var grand_total = $('#grand_total').val()
    var cash        = $('#cash').val()
    var change      = $('#change').val()
    var note      = $('#note').val()
    var date      = $('#date').val()

    // alert(id_customer)
    // alert(subtotal)
    // alert(discount)
    // alert(grand_total)
    // alert(cash)
    // alert(change)
    // alert(note)
    // alert(date)
    if (subtotal < 1 ) {
        alert('Barang Belum Dipilih !')
        $('#kode_item').focus()
    }else if(cash < 1) {
        alert('jumlah pembayaran Belum Di isi!')
        $('#cash').focus()
    }else {
        if (confirm('Yakin Ingin Melanjutkan Transakski?')) {
            $.ajax({
                type : 'POST',
                url :'<?=site_url('sales/process')?>',
                data :{
                    'process_payment' : true, 
                    'pelanggan_id'  : pelanggan_id, 
                    'subtotal'      : subtotal, 
                    'discount'      : discount, 
                    'grand_total'   : grand_total, 
                    'cash'          : cash, 
                    'change'        : change, 
                    'note'          : note, 
                    'date'          : date
                },
                dataType : 'json',
                success:function(result) {
                    if (result.success) {
                    alert('Transakski Berhasil');
                }else{
                    alert('Transakski Gagal')
                }
                location.href='<?=site_url('sales')?>'
                }
            })
        }
    }
})

function setMaxQty(id){
    $("#kode_item").val(id);
    $.ajax({
        url : "<?= site_url('sales/set_max_value') ?>",
        method : "POST",
        data : { item_id : id},
        success: function(res){
            // console.log(res);
            var hasil = $.parseJSON(res);
            // console.log(hasil);
            $("#qty").attr({
                "min" : 1,
                "max" : hasil.stock
            })
        }
    })
}

function gantiQty(){
    let kode_item = $("#kode_item").val();
    // console.log(kode_item)
    let qty_input = $("#qty").val();
    console.log(qty_input);
    if(kode_item !=""){
        $.ajax({
            url: "<?= site_url('sales/set_max_value') ?>",
            method : "POST",
            data: {item_id : kode_item},
            success: function(res){
                console.log(res);
                var hasil = $.parseJSON(res);
                if(hasil.stock > qty_input){
                    Swal.fire('Stok yang kamu masukka melebihi batas')
                }
            }
        })
    } else {
         Swal.fire('Masukkan kode item terlebih dahulu')
    }
}

</script>
