<!doctype html>
<html lang="en">
  <head>
    <title>Add Book</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <div class="row justify-content-center pt-5">
         
        
           
            
              <h3>Add Book</h3>
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
            <div class="col-12 d-flex justify-content-center pt-2">
            <form style="width: 50%" method="POST" action="{{route('author.save.book')}}">
                @csrf
                <div class="form-group">
                  <label for="">Select Author</label>
                  <select class="form-control" name="author_id" id="">
                    @foreach($authorList['items'] as $singleAuthor)
                        <option value="{{$singleAuthor['id'] ?? ""}}">{{$singleAuthor['first_name'] ?? ""." ".$singleAuthor['last_name'] ?? ""}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>   
                <div class="form-group">
                    <label for="">Release Date</label>
                    <input type="datetime-local" class="form-control" name="release_date" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Help text</small>
              </div>
               <div class="form-group">
                 <label for="">Description</label>
                 <input type="text" class="form-control" name="description" id="" aria-describedby="helpId" placeholder="">
                 <small id="helpId" class="form-text text-muted">Help text</small>
               </div>
               <div class="form-group">
                <label for="">Isbn</label>
                <input type="text" class="form-control" name="isbn" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
              </div>
              <div class="form-group">
                <label for="">format</label>
                <input type="text" class="form-control" name="format" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
              </div>
              <div class="form-group">
                <label for="">Number of pages</label>
                <input type="number" class="form-control" name="number_of_pages" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
              </div>
              <input type="submit" value="save" class="btn btn-primary" >
            </form>
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