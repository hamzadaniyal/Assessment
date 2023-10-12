<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <div class="row justify-content-center pt-5">
          <div class="col-8 text-right">
            <div><strong>Welcome,</strong> {{Session('user_first_name')." ".Session('user_last_name')}}</div>
          </div>
          <div class="col-4" style="cursor: pointer;">
              <a class="btn btn-sm btn-danger text-white" href="{{route('user.logout')}}">logout</a>
          </div>
            <div class="col-12">
                <div class="row justify-content-center">
                  <div class="col-6">
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                  </div>
                </div>
              </div>
            
              <h3>Authors</h3>
              <div class="col-12 text-right">
                <a href="{{route('user.add.book')}}" class="btn btn-primary">Add Book</a>
            </div>
            <div class="col-12 d-flex justify-content-center pt-2">
               <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Dob</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                  @foreach($authorData['items'] as $singleAuthor)
                  <tr>
                    <td scope="row">{{$singleAuthor['id'] ?? ""}}</td>
                    <td>{{$singleAuthor['first_name'] ?? ""." ".$singleAuthor['last_name'] ?? ""}}</td>
                    <td>{{date("F j, Y", strtotime($singleAuthor['birthday']))}}</td>
                    <td>{{$singleAuthor['gender'] ?? ""}}</td>
                    <td>
                      <a href="{{route('author.edit',['id' => $singleAuthor['id']])}}" class="btn btn-sm btn-success text-white" style="cursor:pointer">Edit</a>
                      @if($singleAuthor['delete_status'])
                        <a href="{{route('author.delete',['authorId' => $singleAuthor['id']])}}" class="btn btn-sm btn-danger text-white" style="cursor:pointer">Delete</a>
                     @endif
                    </td>
                </tr>
                @endforeach
                   
                 
                </tbody>
               </table>
            </div>

        </div>
       
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>