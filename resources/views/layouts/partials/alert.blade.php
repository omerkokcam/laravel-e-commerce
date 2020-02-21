@if(session()->has('mesaj'))
    <div  class='container' style="width: 100%;">

        <div style= "height:60px; padding:0; line-height:60px; width:500px; margin:0 auto; text-align: center; "class="alert alert-{{session('mesaj_tur')}}">{{session('mesaj')}}</div>

    </div>



@endif
