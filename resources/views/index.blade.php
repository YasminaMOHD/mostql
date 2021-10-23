@extends('layouts.app')
@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4 text-uppercase">export product IDs</h1>
          <form>
            <div class="lead d-flex flex-wrap">
                <div class=" align-items-center  col-12">
                    <div class="col-12">
                    <label for="inputPassword6" class="col-form-label">category :</label>
                    </div>
                    <div class="col-sm-12" style="position: relative;">
                        <span class="btn_cat_lang">
                            <select name="lang_cat" class="language_cat h-100" id="language_cat" style="background: #000; color: #fff;">
                                <option value="1">en</option>
                                <option value="2">ar</option>
                            </select>
                        </span>
                        <select name="category[]" class="select2 category  form-control mb-3 mb-sm-0" multiple>
                            <option value="all">All Category</option>
                            @if (isset($categories) )
                            @foreach ($categories as $key=>$category)
                            @foreach ($category as $c )
                                <option value="{{$c->category_id}}">{{$key." > ".$c->description->name}}</option>
                            @endforeach
                             @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="align-items-center  col-12 mx-1">
                    <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">store</label>
                    </div>
                    <div class="col-12">
                        <select name="store[]" class="select2 store form-control w-100" multiple>
                            <option value="all">All Store</option>
                            @if (isset($stores) && $stores->count() >0 )
                                @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->store_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="d-flex  g-3 align-items-center col-md-6 col-sm-12 mx-1 my-4">
                    <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">price: </label>
                    </div>
                    <div class="col-md-6">
                        <div class="price-slider "><span class="row">
                           <div class="col-6">
                               <p>from</p>
                               <input type="number" name="fromPrice" class="fromPrice" value="0" min="0" max="{{$maxPrice}}"/>
                           </div>
                           <div class="col-6">
                            <p>to</p>
                            <input type="number" name="toPrice" class="toPrice" value="{{$maxPrice}}" min="0" max="{{$maxPrice}}"/></span>
                           </div>
                          <input value="25000" min="0" max="{{$maxPrice}}" step="500" type="range"/>
                          <input value="50000" min="0" max="{{$maxPrice}}" step="500" type="range"/>
                          <svg width="100%" height="24">
                            <line x1="4" y1="0" x2="300" y2="0" stroke="#212121" stroke-width="12" stroke-dasharray="1 28"></line>
                          </svg>
                        </div>
                    </div>
                </div>

                <div class="d-flex  g-3 align-items-center col-md-5 col-sm-12 mx-1">
                    <div class="col">
                        <label for="inputPassword6" class="col-form-label"> max products/store</label>
                    </div>
                    <div class="col m-3">
                        <input name="count" class="count" type="number" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                    </div>
                </div>

                <div class=" g-3 align-items-center col-sm-12 mx-1">
                    <div class="d-flex flex-wrap row">
                        <div class="d-flex col-md-5">
                            <div class="col-md-3">
                                <label class="">From</label>
                            </div>
                            <input type="date" class="fromDate" value="" name="from" class="form-control ">
                        </div>
                        <div class="d-flex col-md-5">
                            <div class="col-md-3">
                                <label class="">to</label>
                            </div>
                            <input type="date" class="toDate" value="" name="to" class="form-control ">
                        </div>
                    </div>
                </div>

                <div class="d-flex    col-10  ">
                    <div class="col m-3 d-flex flex-row-reverse" >
                        <button name="submit" class="search-btn btn btn-success"> submit</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="my-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <h1 class="display-6 text-uppercase">products</h1>
                </div>
                <div class="col-sm-2 mb-3 h-100 text-right ml-auto">
                   <select name="lang" class="lang w-100 " id="lang" style=" padding: 6px 10px;">
                       <option value="1" selected>en</option>
                       <option value="2" >ar</option>
                   </select>
                </div>
                <div class="col-sm">
                    <input type="text" name="id" class="products_id form-control">
                </div>
            </div>
            {{-- <form method="get" id="my-form"> --}}
         <div class="tableData">
            <table id="display" class="table table-hover table-responsive mb-2 display">
                <thead>
                    <tr>
                        <th> <input type="checkbox" name="check[]" class="checkAll"> ALL</th>
                        <th> id</th>
                        <th> name</th>
                        <th> image</th>
                        <th> store</th>
                        <th> category</th>
                        <th> price</th>
                        <th> created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($products) && $products->count() >0)
                        @foreach ($products as $product)

                            <tr>
                                <td><input type="checkbox" class="check" name="check[]" value="{{$product->product_id}}"></td>
                                <td>{{$product->product_id}}</td>
                                <td>{{$product->description->name}}</td>
                                <td><img style="width:140px" src="{{asset('image/'.$product->image)}}" alt=""></td>
                                <td>
                                    {{-- @if ($product->stores->count() >0) --}}
                                        {{-- @foreach ($product->store_product as $store) --}}
                                           <span class="badge bg-secondary"> {{@$product->storeProduct->store_name }} </span>
                                        {{-- @endforeach --}}
                                    {{-- @endif --}}
                                <td>
                                    @if ($product->categories)
                                        @foreach ($product->categories as $category)
                                           <span class="badge bg-secondary"> {{$category->description ? $category->description->name : ''}} </span>
                                        @endforeach
                                    @endif
                                </td>
                                <td> {{$product->price}}</td>
                                <td>{{ \Carbon\Carbon::parse($product->date_added)->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
            {{-- </form> --}}
            {{-- <div class="paginate text-center mt-5">
                {{$products->links()}}
            </div> --}}
        </div>
        </div>
      </div>
@endsection
@section('js')
    <script>

        $(document).ready(function(){

            $('.select2').select2();



        (function() {

 var parent = document.querySelector(".price-slider");
 if(!parent) return;

 var
   rangeS = parent.querySelectorAll("input[type=range]"),
   numberS = parent.querySelectorAll("input[type=number]");

 rangeS.forEach(function(el) {
   el.oninput = function() {
     var slide1 = parseFloat(rangeS[0].value),
           slide2 = parseFloat(rangeS[1].value);

     if (slide1 > slide2) {
       [slide1, slide2] = [slide2, slide1];
     }

     numberS[0].value = slide1;
     numberS[1].value = slide2;
   }
 });

 numberS.forEach(function(el) {
   el.oninput = function() {
       var number1 = parseFloat(numberS[0].value),
       number2 = parseFloat(numberS[1].value);

     if (number1 > number2) {
       var tmp = number1;
       numberS[0].value = number2;
       numberS[1].value = tmp;
     }

     rangeS[0].value = number1;
     rangeS[1].value = number2;

   }
 });

})();

$(document).on('change','.check',function(e){
    e.preventDefault()
    var checked = $(this).is(':checked');
    if(checked){
          $(this).prop('selected',true);
          $('.products_id').val($('.products_id').val()+$(this).val()+',')
     }else{
         var p= $('.products_id').val()
         var pArray=p.split(',')
         var r=[];
        //  console.log(pArray)

         for(var s in pArray){
             if(pArray[s] != $(this).val()){
                  r.push(pArray[s])
             }
         }
        var newValue=r.join(',')
        $('.products_id').val(newValue)
     }

        //  $(this).prop('selected',false);


})
$(document).on('change','.checkAll',function(e){
    e.preventDefault()
    var checked = $(this).is(':checked');
    var p= $('.products_id').val()
         var pArray=p.split(',')
         var r=[];
    if(checked){
        $('.check').each(function(){
        $(this).prop("checked", true);
        for(var s in pArray){
             if(pArray[s] != $(this).val()){
                r.push($(this).val())
                break
             }
         }
        })
         var newValue=r.join(',')
        $('.products_id').val(newValue)


     }else{
        $('.check').each(function(){
        $(this).prop("checked", false);
         for(var s in pArray){
            if(pArray[s] == $(this).val()){
                r.pop($(this).val())
                // break
             }
         }
         $('.products_id').val(r)
    })

     }

})
//change language category (ar _en)
$(document).on('change','.language_cat',function(e){
    e.preventDefault()
    var lang=$(this).val();
    var content="";
    $.ajax({
        type:'get',
        // dataType:"json",
        data:{'lang':lang},
        url:'{{route("products.categoryLanguage")}}',

         success:function(data){

             content+='<option value="all">All Category</option>'
             data = JSON.parse(data);
            console.log(data)
                 for (var s in data){
                 for(var c in data[s]){
                      content+='<option value="'+data[s][c].category_id+'">'+s+" > "+data[s][c].description.name+'</option>'
                 }
         }
         $('.category').html(content);
         }
         ,error:function(){

        }

    })


})
//search
$(document).on('click','.search-btn',function(e){
                e.preventDefault();
                console.log('s')
                var category=$('.category').val();
                var store=$('.store').val();
                var fromPrice=$('.fromPrice').val();
                var toPrice=$('.toPrice').val();
                var count=$('.count').val();
                var fromDate=$('.fromDate').val();
                var toDate=$('.toDate').val();
                var lang=$('.lang').val();
                var content=""
                var pub_link="{{asset('image')}}";

                var newTable=$('dispaly tbody');
                // var content=$(this).find("option:selected").text();
                // var op="";
                $.ajax({
                    type:'get',
                    // dataType:"json",
                    data:{'category':category,'lang':lang ,'store':store,'count':count,'fromPrice':fromPrice,'toPrice':toPrice,'fromDate':fromDate,'toDate':toDate},
                    url:'{{route("products.search")}}',
                    cache: true,

                    success:function(data){
                       if (data != null){
                           content+='<table id="display" class="table table-hover table-responsive mb-2 display">'+
                '<thead>'+
                   ' <tr>'+
                       ' <th> <input type="checkbox" name="check[]" class="checkAll"> ALL</th>'+
                        '<th> id</th>'+
                        '<th> name</th>'+
                        '<th> image</th>'+
                        '<th> store</th>'+
                        '<th> category</th>'+
                        '<th> price</th>'+
                        '<th> created_at</th>'+
                   ' </tr>'+
               ' </thead>'+
               ' <tbody>'
                // console.log(data)
                   console.log(data)
                        for(var s in data){
                            // console.log(data[s].store_product.store_name)

                          content+="<tr>"+
                                '<td><input type="checkbox" class="check" name="check[]" value="'+data[s].product_id+'"> </td>'+
                                '<td>'+data[s].product_id+'</td>'+
                                '<td>'+data[s].description.name+'</td>'+
                                '<td><img style="width:140px" src="'+pub_link+'/'+data[s].image+'" alt=""></td>'+
                                '<td>'
                                if(data[s].store_product !=null){
                                    content+=' <span class="badge bg-secondary">'+data[s].store_product.store_name +' </span>'

                                }
                                content+='</td><td>'
                                    //  if (data[s].categories.size != 0){
                                     for(var c in data[s].categories){
                                          content+=' <span class="badge bg-secondary">'+ data[s].categories[c].description.name +' </span>'
                                     }
                                    //  }
                                content+='</td>'
                                content+='<td>'+data[s].price+'</td>'+
                               ' <td>'+data[s].date_available

                                content+='</td>'+
                            '</tr>'
                        }

                        content+="</table>"
                        $('.tableData').html(content)
                        $('#display').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
            $.fn.dataTable.ext.errMode = 'throw';
var check=$('#display').DataTable({
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
                       }else{
                           $('.display tbody').html("");
                       }
                        // $('#display').DataTable();
                        // if(data['pagination'] != null){
                        //     $('.paginate').html(data['pagination'])
                        // }
                    },
                    error:function(){
                        content="";
                        console.log('error')

                    }
                });

        });

// ajax links pagination

$('#display').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
            $.fn.dataTable.ext.errMode = 'throw';
var check=$('#display').DataTable({
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
// $('#my-form').on('submit',function(e){
    //  var form =this
    //  var rowsel=check.coulmn(0).checkboxes.selected();
    //  console.log(rowsel)
    //  $.each(rowsel,function(index,rowId){
    //      console.log(rowId)
    //     //  form.append(
    //         $('.products_id').val($('.products_id').val()+rowId +",")
    //         //  $('<input>').attr('type','hidden').attr('name','id[]').val(rowId)
    //     //  )
    //  } )

    // //  $('#view-form').text($(form).serialize())
    // //  $('input[name="id\[\]"',form).rempve()
    // //  e.preventDefault()


        });
    </script>
@endsection
