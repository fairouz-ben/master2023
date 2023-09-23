<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>liste d'étudiants</title>
    <link href="{{asset('build/assets/pp/app.cf2a0f77.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9px;
          }
    </style>
  </head>
<body dir="rtl">
    <h2>{{ $title }}</h2>
    
    <p style="font-family: 'DejaVu Sans'">Faculté: {{$faculty->name_fr}}-{{$faculty->name_ar}}</p>
    <p>{{ $date }}</p>
    
 <table class="table table-striped" >
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"> Nom & prenom</th>
          <th scope="col">date naissance</th>
          <th scope="col">classement</th>
          <th scope="col">Departement</th>
          <th scope="col">Specialities</th>
          <th scope="col">Statut</th>
          
        </tr>
      </thead>
     
      <tbody>
     
        @foreach ($students as $etu)
        
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$etu->nom_ar}}  {{$etu->prenom_ar}}<br/>{{$etu->nom_fr}} {{$etu->prenom_fr}} </td>
            <td>{{$etu->date_nais }}</td>
            <td>{{$etu->classement}}</td>
             <td>{{$etu->department->name_fr }}</td> 
            <td>{{$etu->special_1 }} <br/> {{$etu->special_2 }}<br/> {{$etu->special_3 }}</td>
            <td>
              @if($etu->etat =='Accepté') 
              <span class="badge bg-success">Accepté</span>
              
              @elseif($etu->etat == 'Refusé') 
              <span class="badge bg-danger">Refusé</span>
              @else
              <span class="badge bg-secondary">Non traité</span>
              @endif

            </td>
            
          </tr>
         
        @endforeach
        
      </tbody>
    </table>
  


</body>
</html>


