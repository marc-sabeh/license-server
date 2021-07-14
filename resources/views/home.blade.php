@extends('layouts.app')
@section('content')
@if ($license == null)
    <div class="container">
        <h4>Please choose: </h4>
        <form action="/home" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <select name="license" id="lic">
                    <option selected>Choose License Feature</option>

                    @foreach ($license_features as $license)
                        <option value="{{ $license->id }}">Name: {{ $license->license_name }} | Life Span:
                            {{ $license->life_span }} Days | You can choose {{ $license->equiment_number }} equiments |
                            Price is: {{ $license->price }}$</option>
                    @endforeach
                </select>

            </div>
            <br><br>
    <div class="row justify-content-center">

        <select multiple="multiple" name="equiments[]" id="eq">
            @foreach ($equiments as $equiment)
                <option value="{{ $equiment->id }}">{{ $equiment->equiment_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row justify-content-center">
        {{-- <h5 style="color: red">You must choose only 10 equipments</h5> --}}
            
        <input type="submit" value="Submit" id="submit-btn" class="btn btn-primary mt-2 d-none">


    </div>
    </div>
    </div>
    </form>

    </div>
    @else
    <div class="container">
       <h3> Your License is: <br> {{$license}} </h3>
    </div>
@endif
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
$(document).on('change','#eq',function(){
    var selectBox = document.getElementsByName('license');
    var other = document.getElementsByName('equiments[]');
    let license = selectBox[0].options[selectBox[0].selectedIndex].value
    equiments_length = other[0].selectedOptions.length;

console.log(license);
    if(license == 2 || (license == 1 && equiments_length < 10))
    {
        document.getElementById('submit-btn').classList.remove('d-none');
    }
});
</script>