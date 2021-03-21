<center> 

   <button 
        class     = "btn btn-circle btn-sm btn-warning btn_edit"
        data-url  = '{{ $url_edit }}'
        data-toggle="tooltip" title="Ubah Data"
        > 
        <i class  = "fa fa-edit"> </i> 
  </button>


      <button 
        class     = "btn btn-circle btn-sm btn-danger btn_delete"
        data-url    =  '{{ $url_destroy }}'
        data-text   = "{{ $delete_text }}"
        data-toggle="tooltip" title="Hapus Data"
        > 
        <i class  = "fa fa-trash"> </i> 
  </button>
</center>