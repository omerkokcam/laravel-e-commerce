@if(count($errors)>0)
    <div class="alert alert-info" style="width: 450px ; height: 80px ;margin-left: 150px">
        <ul>
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        </ul>

    </div>

@endif


