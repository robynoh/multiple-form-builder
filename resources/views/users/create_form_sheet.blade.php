<?php   use \App\Http\Controllers\UserController; ?>

<html>
    <!-- BEGIN: Head -->
    <head>

        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="app" style="background:#fff">

<div class="px-5 sm:px-20  border-gray-200  mt-10">



<?php if($fields->count()<1){?>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
Your form has no fields to display. To add fields click the "Add New Field" button above
</div>

<?php } ?>
                   


<div class="grid grid-cols-12 gap-4 row-gap-5 ">
                            
                   
                   
                               
                                    @foreach($fields as $field)
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label><b>{{ ucwords(str_replace('_', ' ',$field->fields))}}</b> <span style="color:orangered"><?php if($field->required_type=='yes'){ echo "*";} ?> </span>  <span><i><?php if($field->required_type=='no'){ echo "optional";} ?></i></span></label>
    
                                        <table>
    <tr>
        <td>
                                       <?php echo UserController::verifyField(str_replace('_', ' ',$field->fields),$field->type,Auth::user()->id) ?>
                                       <br/>
     <span style="font-size:12px"><i>{{$field->description}}</i></span>
</td>
<td width="5%">
<a  id="deleteUser{{ $field->id}}" data-userid="{{$field->id}}" href="javascript:void(0)" onclick="showAlert({{ $field->id}});" class="tooltip cursor-pointer"  title="Remove {{ str_replace('_', ' ',$field->fields) }} field" ><i data-feather="trash-2"  style="color:red"></i> </a>
<a href="/users/edit_field/{{$field->id}}" class="tooltip cursor-pointer"  title="Edit question" ><i data-feather="edit"  style="color:darkslateblue"></i> </a>

</td>
                                    </tr>                             
</table>
                                    </div>
                                   @endforeach
                                  
                                   
                                  
                               
                    </div>  
                     
                    



                   



                    <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">Do you want to drop <b id="field"></b> field from form?</div>
                            <div class="text-gray-600 mt-2"> This process can not be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                           
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Delete</button>
                        </div>
                    </div>
                </div>
                </form>

                    </div>
 <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
      <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
        <script src="{{ asset('dist/js/app.js') }}"></script>
                   
    
    
        <script>


function getFieldname(id){
    var fieldId=id;
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'/users/pullfieldname',
            method: 'POST',
            data: {
                fieldId:fieldId,_token:_token
            },
            
            success:function(result){
             document.getElementById('field').innerHTML = result;
            
            }});


}

function showAlert(ids){
    var id=ids;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal').modal('show');
   
   getFieldname(id);
   
}


function showAlert2(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id2').val(userID); 

    $.get('/users/pulllistdetail/'+id,function(list){

        $("#listid2").val(list.id);
       $("#title2").val(list.name);
       $("#show-type").val(list.type);
      
      


});


  $('#header-footer-modal-preview3').modal('show'); 
   
}


function showAlertedit(photo){
    var id=photo;
    var fieldID=$('#deleteUser'+id).attr('data-userid');

    
    //$('#app_id2').val(userID); 

    $.get('/users/pullfielddetail/'+id,function(field){

    //   $("#listid2").val(list.id);
    //  $("#title2").val(list.name);
    //$("#show-type").val(list.type);
      
     

});


  $('#delete-confirmation-modal4').modal('show'); 
   
}


function submitlist(){

var id=$("#listid2").val();
var title=$("#title2").val();
var type=$("#type").val();
var _token = $('input[name="_token"]').val();
$.ajax({
      url:'/users/submitlistupdate',
            method: 'POST',
            data: {
              id:id,title:title,type:type,_token:_token
            },
            
            success:function(result){
              $('#header-footer-modal-preview3').modal('hide'); 
              $('#button-modal-preview').modal('show'); 
            }});



}

function senddel(){
    
    window.location="/users/removefield/"+$('#app_id').val();
   
}

function popProvince(){
	


   var id=$("#state").val();
   var _token = $('input[name="_token"]').val();
   $.ajax({
      url:'/users/processstate',
            method: 'POST',
            data: {
              id:id,_token:_token
            },
            
            success:function(result){
             document.getElementById('province').innerHTML = result;
            
            }});






}	




Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach('#my_camera');
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>


    
    
    </body>

                     <!-- BEGIN: JS Assets-->
       
        <!-- END: JS Assets-->


    
</html>


            


