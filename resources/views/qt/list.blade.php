<?php
$spent = number_format(($vacation-$time_remaining)/$vacation*100,0);
?>

@extends('layout.index')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style>
  .r-d{
    display: none !important;
  }
  .tab-content {
    padding-top: 30px;
    padding-bottom: 30px;
  }

  .flex-o2 {
    display: flex;
  }

  div.flex-o2>span {
    border-bottom: 1px solid blue;
  }

  a.a-active {
    color: black !important;
    border-top: 1px solid blue;
    border-left: 1px solid blue;
    border-right: 1px solid blue;
    border-bottom: none !important;
  }

  a.tab-o1 {
    color: blue;
    padding: 10px;
    display: inline-block;
    margin: 0;
    border-bottom: 1px solid blue;
  }

  .mgt-10 {
    margin-top: 10px;
  }

  .bg-primary {
    background-color: #337ab7;
  }

  section.content-header>h3 {
    margin-left: 10px;
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    align-content: stretch;
  }

  @media only screen and (min-width:992px) {
    .r-w-o1 {
      width: 25%;
    }
    .r-d{
      display: table-cell !important;
    }
  }
</style>
@endsection

@section('content')
<div class="content-wrapper">
  {{-- <button id="test">test</button> --}}
  <section class="content-header">
    <h3><span>Vacation</span><a href="qt/post" style="color: white" class="btn btn-primary">New plan</a></h3>
  </section>
  <section class="content">
    <div class="box box-primary">
      <div style="padding: 10px 20px">
        <div class="info-box bg-primary">
          <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Time remaining</span>
            <span class="info-box-number" id="timeRemaining">
              <?php $hours_remaining = $time_remaining/60?>
              {{$hours_remaining.' hours' }}
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: {{$spent}}%"></div>
            </div>
            <span class="progress-description">
              Spent <span class="spent-percent">{{$spent}}</span>%
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="box" style="border: none">
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Start</th>
                      <th>End</th>
                      <th>Spent</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($history as $i)
                        <?php $hours_spent = $i->spent/60 ?>
                        <tr>
                          <td>{{ $i->start }}</td>
                          <td>{{ $i->end }}</td>
                          <td>{{ $hours_spent }} hours</td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
@endsection

@section('script')
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function(){

    $('#example1, #example2').DataTable({
      "order": []
    });

    //bootstrap tab setting
    {
      $('a.tab-o1').click(function(){
          $('a.tab-o1').each(function(){
              $(this).removeClass('a-active');
          });
          $(this).addClass('a-active');
      });
    }
    //end-bootstrap tab setting

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
    })

    $('.searchByDate').change(function(){
      let date = $('.searchByDate').val();
      $.ajax({
        url:'qt/ajax/searchByDate',
        method:'get',
        data:{
          date: date
        },
        dataType:'json',
        error: function(xhr, ajaxOptions, thrownError){
           console.log(xhr.status);
           console.log(xhr.responseText);
           console.log(thrownError);
        },
        success: function(data){
          $('table>tbody tr').remove();
          var arr = data.data;
          arr.forEach((e)=>{
            var vacationType = <?php echo json_encode(Constants::VACATION_TYPE) ?>;
            var type = '';
            for(key in vacationType){
              if(e.type == key){
                type = vacationType[key];
                break;
              }
            }
            let hour_spent  = (e.spent/60);
            $('table>tbody').append('<tr> <td>'+e.start.split(' ')[1]+'</td> <td>'+e.end.split(' ')[1]+'</td> <td>'+hour_spent+' hours</td> <td>'+type+'</td> </tr>')
          });
        }
      });
    })

    //test
    $('#test').click(function(){
    });
    //end-test
  });
</script>
@endsection