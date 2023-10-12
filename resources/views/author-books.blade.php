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
        <h3 style="text-align: center;">Books Details</h3>
        <div class="row justify-content-center pt-5">  
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
           
         
            <h3>Author Name: {{$singleAuthorData['first_name']."".$singleAuthorData['last_name']}}</h3>
            <div class="col-12 d-flex justify-content-center pt-2">
               <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>Isbn</th>
                        <th>Format</th>
                        <th>Total Pages</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($singleAuthorData['books']) > 0)
                        @foreach($singleAuthorData['books'] as $book)
                            <tr>
                                <td scope="row">{{$book['id'] ?? ""}}</td>
                                <td>{{$book['title'] ?? ""}}</td>
                                <td>{{$book['description'] ?? ""}}</td>
                                <td>{{$book['isbn'] ?? ""}}</td>
                                <td>{{$book['format'] ?? ""}}</td>
                                <td>{{$book['number_of_pages'] ?? ""}}</td>
                                <td><a href="{{route('author.book.delete',['bookId' => $book['id']])}}" class="btn btn-sm btn-danger text-white" style="cursor:pointer">Delete Book</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                No Book Found For this Author
                           <td>
                        </tr>
                    @endif
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