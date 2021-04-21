<style>
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 6vw;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}



h1 {
    margin-top: 150px
}

p {
    font-size: 1.2rem
}

@media only screen and (max-width: 600px) {
    h1 {
        font-size: 14px
    }

    p {
        font-size: 12px
    }
}
</style>

<form  action="{{ url('product-rate/'.$product->id) }}" method="POST">
    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    </div>
    <div class="modal-body">
        <div class="errors"></div>

        @csrf
        @method('PUT')
        <br><br><br>
        <div class="container">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="200px">Nama Produk</th>
                        <th>{{ $product->name }}</th>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <th>{{ $product->category->name }}</th>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <th>{{ rupiah_format($product->price) }}</th>
                    </tr>

                </thead>

            </table>

            <div class="form-group row ">
            <label class="col-sm-3 col-form-label">Berikan Penilaian</label>
                <div class="col-sm-4 ">
                    <div class="rating">
                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                    </div>
                </div>
            </div>
            <input type="hidden" id="input-rate" name="rate" value="0">
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Masukkan Ulasan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="comment" required></textarea>
                </div>
            </div>




        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
        <button type="submit" class="btn btn-success "> <i class="fa fa-paper-plane"></i> Terima</button>
    </div>
</form>

<script>
    $('#1').change(function(){
        $('#input-rate').val('1');
    });
    $('#2').change(function(){
        $('#input-rate').val('2');
    });
    $('#3').change(function(){
        $('#input-rate').val('3');
    });
    $('#4').change(function(){
        $('#input-rate').val('4');
    });
    $('#5').change(function(){
        $('#input-rate').val('5');
    });
</script>