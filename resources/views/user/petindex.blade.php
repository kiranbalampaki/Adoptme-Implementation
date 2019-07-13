@extends('user.dashboard')

@section('content')
<h2 class="text-center py-2">Your Pets</h2>
<div class="container">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-sm table-hover table-bordered">
            
                @if (count($pets)>0)
                <thead class="thead-dark text-center">
                    <tr>
                        <th>SN.</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Photo</th>
                        <th>Details</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pets as $pet)
                    <?php $img = $pet->pet_photo; ?>
                    <tr>
                        <td>{{$pet->id}}</td>
                        <td>{{$pet->name}}</td>
                        <td>{{$pet->type}}</td>
                        <td><?php if ($pet->gender == "m"){ echo "Male"; } else{ echo "Female"; } ?></td>
                        <td>{{$pet->age}}</td>
                        <td>{{$pet->size}}</td>
                        <td>{{$pet->color}}</td>
                        <td class="text-center"><img src="{{asset('assets/uploads/pets/'.$img)}}" height="100"></td>
                        <td>{!!str_limit($pet->details, 155, '....')!!}</td>
                        <td class="text-center align-middle">
                            @if ($pet->is_adopted == FALSE)
                                <div class="btn-group">
                                    <a href="{{route('pets.edit',['id'=>$pet->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                    <form action="{{ route('pets.destroy',['id'=>$pet->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <form action="{{ route('pets.update',['id'=>$pet->id]) }}" method="POST">
                                        <input type="checkbox" checked name="is_adopted" value="TRUE" hidden>
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Update as adopted"><i class="fa fa-check"></i></button>
                                    </form>
                                </div>
                            @else
                            adopted
                            @endif
                        </td>
                    </tr>                        
                </tbody>
                @endforeach
                @else
                    <div class="mx-auto mt-5" style="background:url({{asset('assets/landingimages/nopost.png')}});background-position:center;background-size:cover;height:220px; width:220px;"></div>
                    <p class="text-center">No Pets</p>
                @endif                
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
                <script>
                    $(".table").DataTable();
                </script>
            </table>
        </div>
    </div>
</div>
@endsection