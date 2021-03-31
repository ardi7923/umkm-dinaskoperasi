// show modals 
  const showForm = function(){
      var btn = $(this); 
      $.ajax({
          url  : btn.attr('data-url'),
          type : 'get',
          dataType: 'json',
          beforeSend : function(){
            $('#modals').modal('show');
            $('#modals .modal-dialog').addClass('modal-'+btn.attr('data-size'));
          },
          success : function(data){
              $('#modals .modal-content').html(data);
          }
      });
  }

// save form 
      const saveForm =  function(){

              var form = $(this);
                $.ajax({
                  url  : form.attr('data-url'),
                  data : form.serialize(),
                  type : form.attr('method'),
                  dataType : 'json',
                  success : function(response){
                      if(response['code'] == 200){
                        if(form.attr('data-type') == "reload"){
                          location.reload();
                        }else{
                          $('#myTable').DataTable().ajax.reload();
                        }

                        $('#modals').modal('hide');
                        Swal({
                          title:'Berhasil',
                          text:response['msg'],
                          type:'success',
                          showConfirmButton:false,
                          timer:2000,
                          allowOutsideClick:false,
                        });
                      }else{
                         $('#modals .errors').html(response['errors']);
                      }
                  }
                });

              return false;
          }
      // save with image
      const saveWithImage = function(){ 

         var form       = $(this);
         var img        = document.getElementById('upload_preview');
         var image      = img.getAttribute('src');
         var add_request = "&"+form.attr('data-reqimage')+"="+image;

                $.ajax({
                  url  : form.attr('data-url'),
                  data : form.serialize()+add_request,
                  type : form.attr('method'),
                  dataType : 'json',
                  success : function(response){

                      if(response['code'] == 200){
                        $('#myTable').DataTable().ajax.reload();
                        $('#modals').modal('hide');
                        Swal({
                          title:'Berhasil',
                          text:response['msg'],
                          type:'success',
                          showConfirmButton:false,
                          timer:2000,
                          allowOutsideClick:false,
                        });
                      }else{
                         $('#modals .errors').html(response['errors']);
                      }
                  }
                });

            return false;
      }   
// delete data
  const deleteData =  function(url,data,type){

        $.ajax({
          url  : url,
          data : data,
          type : "POST",
          dataType : 'json',
          success : function(response){
              if(response['code'] == 200){
                if(type == "reload"){
                  location.reload();
                }else{
                  $('#myTable').DataTable().ajax.reload();
                }
                Swal({
                  title:'Berhasil',
                  text:response['msg'],
                  type:'success',
                  showConfirmButton:false,
                  timer:2000,
                  allowOutsideClick:false,
                })
              }else{
                 Swal({
                  title:'Perhatian',
                  text:response['errors'],
                  type:'error'
                })
              }
          }
        });

      return false;
  }
// show delete form
  const deleteForm = function(){

        var btn  = $(this);
        var url  = btn.attr('data-url');
        var text = btn.attr('data-text');
        var type = btn.attr('data-type');
        var data = {
                      _method : 'DELETE',
                      _token  : $('meta[name="token"]').attr('content')
                    };
        Swal({
          title: 'Apakah Anda Yakin?',
          html: "Menghapus Data dengan <br />"+text,
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: '<i class="fa fa-trash"></i> YA',
          cancelButtonText: '<i class="fa fa-reply-all"></i> Batal',
          showCancelButton: true,
          showLoaderOnConfirm: true,
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
              deleteData(url,data,type);
            }
          
        })

    }

// approve form 
      const approveForm =  function(){

              var form = $(this);
                $.ajax({
                  url  : form.attr('data-url'),
                  data : form.serialize(),
                  type : form.attr('method'),
                  dataType : 'json',
                  success : function(response){
                      if(response['code'] == 200){
                        if(form.attr('data-type') == "reload"){
                          location.reload();
                        }else{
                          $('#myTable').DataTable().ajax.reload();
                          window.open(form.attr('data-print'));
                        }

                        $('#modals').modal('hide');
                        Swal({
                          title:'Berhasil',
                          text:response['msg'],
                          type:'success',
                          showConfirmButton:false,
                          timer:2000,
                          allowOutsideClick:false,
                        });
                      }else{
                         $('#modals .errors').html(response['errors']);
                      }
                  }
                });

              return false;
          }
 // convert to base64 =======================================
window.previewImage = function(idInputFile,idPriviewFile) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById(idInputFile).files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById(idPriviewFile).src = oFREvent.target.result;
        };
    };

       window.getSizeBase64 =  function(stringImage){

        sub2       = stringImage.substring(stringImage.length-2);
         if(sub2 = '=='){
          var y = 2;
         }else{
           var y = 1;
         }
        x = (stringImage.length * (3/4)) - y;
        kb = x/1024;
        mb = kb/1024;

      return mb;
      

    }
 // =========================================================

 // Autonumeric  =====================================================
  window.autoNumericGlobal = function(var1, var2) {

        $('.'+var1).bind('blur focusout keypress keyup', function() {
          if ($(this).autoNumeric('get') == '') {
            $('.'+var2).val('0');
          }else {
            $('.'+var2).val($(this).autoNumeric('get'));
          }          
        });

      return   $('.'+var1).autoNumeric('init', {mDec: '2'});
  }
    // Document Ready ============================================================
  window.menuOpen = function(type,idMenu, idSubmenu=''){
    if(type == 'menu'){

      $("#"+idMenu).addClass("active");
    
    }else if(type == 'submenu'){
    
      $("#"+idMenu).addClass("active");
      $("#"+idMenu).addClass("menu-open");
      $("#"+idSubmenu).addClass("active");
    
    }
  }
  window.keyUpTotal = function(id1,id2,idTotal)
    {
      $('#'+id1).keyup(function(){
        laki      = parseInt($('#'+id1).val());
        perempuan = parseInt($('#'+id2).val());
  
        $('#'+idTotal).val(laki+perempuan);
    });
    }


  const validationAlert = function(text)
  {
    swal({
        title :'Perhatian',
        text  :text,
        type  :'error'
      });
  }

   //  number with commas =========================================================
 const numberWithCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

    $(document).ready(function() {


      
      $('body').tooltip({
          selector: '[data-toggle=tooltip]'
      });
      

      
    });
  // ========================================================