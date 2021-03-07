@extends("layouts.app")
@section("content")
    <div class="container">
    <img src="https://itbeep.com/assets/images/logo_dark.png" alt="">
<form id="services_form" onsubmit="event.preventDefault()">
    {{csrf_field()}}
      <div class="form-group">
        <label> Your Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
      </div>
      <div class="form-group">
        <label> Your Number</label>
        <input type="text" class="form-control " id="number" name="number" placeholder="Number">
      </div>
      <div class="form-group">
        <label>Your E-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
      </div>
      <input type="hidden"  id="service" name="service">
      <input type="hidden" id="interest" name="interest">

      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
      Submit
    </button>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select Your Offer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($services as $service)
        <button class="btn" name="services" style="background:#b800a2" onclick="setServices('{{$service->name}}',event)" >
          {{$service->name}}
        </button>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2" id="firstModalButton" onclick="nextButton()">  Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @foreach($interests as $interest)
            <button class="btn" name="interests" style="background:#b800a2" onclick="setInterests('{{$interest->name}}',event)" >
              {{$interest->name}}
            </button>
          @endforeach
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>
</form>
</div>
@endsection

@section("scripts")
    <script>
    $("#firstModalButton").click(e => {
        e.preventDefault();
        $('#exampleModalCenter').modal('hide')
    });

    var services=[];
    function setServices(name,event){
      if(event.target.style.background=="#4287f5"){
        event.target.style.background="#b800a2";
        services.push(name);
      }
      else{
        event.target.style.background="#4287f5";
        services.splice(services.indexOf(name),1);
      }
    }
    function setInterests(name,event){
      $("#interest").val(name);
      $.ajax({
            url: '{{ url("/add") }}',
            method: "POST",
            contentType:false,
            cache:false,
            processData:false,
            data: new FormData($("#services_form").get(0)),
            success: function(response) {
              console.log(response);
            }
        });
    }


    function nextButton(){
      $("#service").val(services);
    }
  </script>
@endsection