$.fn.dataTable.ext.errMode = 'throw';
var check=$('#table_id').DataTable({
    ajax:'data',
    coulmnDefs: [
        {
            targets:0,
            checkboxes:{
                selectRow:false
            }
        }
    ],
    select:{
        style:'multi'
    },
    order:[[1,'asc']]
})
$('#my-form').on('submit',function(e){
     var form =this
     var rowsel=check.coulmn(0).checkboxes.selected();
     $.each(rowsel,function(index,rowId){
         form.append(
             $('<input>').attr('type','hidden').attr('name','id[]').val(rowId)
         )
     } )

     $('#view-form').text($(form).serialize())
     $('input[name="id\[\]"',form).rempve()
     e.preventDefault()
})
<form method="get" id="my-form">
    <button class="btn btn-danger">View Selected</button> <br>
