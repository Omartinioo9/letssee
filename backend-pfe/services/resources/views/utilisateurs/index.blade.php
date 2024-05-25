<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        {{-- <h1 >Home page :</h1> --}}
         @foreach($utilisateurs as $utilisateur)
         <div class="utilisateur-card">
            <p>
                <strong>Nom:</strong> {{ $utilisateur->name }}<br>
                <strong>Email:</strong> {{ $utilisateur->email }}<br>
                <strong>Role:</strong> {{ $utilisateur->role }}<br>
                <strong>Statut:</strong> {{ $utilisateur->status }}<br>
            </p>
        </div>
        @endforeach 

</body>
</html>