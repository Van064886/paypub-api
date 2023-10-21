@extends('emails.base_email')
@section('username', $user->firstname. ' ' .$user->lastname)
@section('content')
    <p>Voici votre code de vérification :</p>
    <div style="border-radius: 4px; background-color: #256ffe; width:130px ">
        <h2 style="padding: 16px; font-size: 25px ;color: #ffffff;">
            {{ $code }}</h2>
    </div>
@endsection
