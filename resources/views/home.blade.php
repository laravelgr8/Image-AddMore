<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="col-xl-12">
        <form method="post" action="/insert" enctype="multipart/form-data">
            @csrf
            <table class="table" id="myid">
                <tr>
                    <td colspan="2" style="float:right;"><span class="btn btn-info" id="add">Add</span></td>
                </tr>
                @foreach($data as $key => $record)
                <tr>
                    <td><input type="text" name="user_id[]" id="user_id{{$key}}" class="form-control" value="{{$record->emp_id ?? ''}}"></td>
                    <td>
                        <input type="file" name="pic[]" id="pic{{$key}}" class="form-control">
                        <input type="hidden" name="pic_[]" value="{{ @$record->pic}}">
                    </td>
                </tr>
                @endforeach
            </table>
            <input type="hidden" name="countID" id="countID" value="{{$key ?? 0}}">
            <input type="submit" class="btn btn-success">
        </form>
    </div>
</div>

<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script>
  $(document).ready(function(){

    var i=$("#countID").val();
    $("#add").click(function(){
        i++;
        $("#myid").append('<tr id="row'+i+'"><td><input type="text" name="user_id[]" id="user_id'+i+'" class="form-control"></td><td><input type="file" name="pic[]" id="pic'+i+'" class="form-control"></td><td><span class="btn btn-danger remove" id="'+i+'">X</span></td></tr>');
    });

    $(document).on("click",'.remove',function(e){
            e.preventDefault();
            var id=$(this).attr('id');
            $("#row"+id).remove();
        });
  });  
</script>
</body>
</html>