<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BackController extends Controller
{
    public function showLoginForm(){
      
            return view('login'); // Redirect to the login page, adjust as needed
        
    }
    public function loginStoreToken(Request $request){
    //  dd($request->all());
     // getting email and password
     $email = $request->input('email');
    //  dd($email);
     $password = $request->input('password');
 
    
     $apiResponse = Http::withHeaders([
         'accept' => 'application/json',
         'Content-Type' => 'application/json',
     ])->post('https://candidate-testing.api.royal-apps.io/api/v2/token',[
         'email'=> $email,
         'password'=> $password,
     ]);
 
     if ($apiResponse->successful()) {
        // dd($apiResponse);
        $data = $apiResponse->json();
        $userToken = $data['token_key'];
        $userFirstName = $data['user']['first_name'];
        $userLastName = $data['user']['last_name'];
        Session::put('user_token',$userToken);
        Session::put('user_first_name',$userFirstName);
        Session::put('user_last_name',$userLastName);
        return redirect()->route('author.home')->with('success', 'Login Successfully.');
      
     } else {
         $error = $apiResponse->json();
         dd($error);
        
     }
    
    
   } 
   
   public function authorsIndex(){
   
        //getting token from the session
        $userToken = Session('user_token');
        //getting all author using below api.
        $authorApi = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $userToken"
        ])->get('https://candidate-testing.api.royal-apps.io/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1');
          $authorData = null;
        if($authorApi->successful()){
            $authorData = $authorApi->json();
            // dd($authorData);
            foreach($authorData['items'] as &$singleAuthor){
                // dd($singleAuthor);
                $singleAuthorApi = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => "Bearer $userToken"
                ])->get("https://candidate-testing.api.royal-apps.io/api/v2/authors/".$singleAuthor['id']);
                if($singleAuthorApi->successful()){
                    $singleAuthorData = $singleAuthorApi->json();
                    if(count($singleAuthorData['books']) > 0){
                        // dd('here');
                        $singleAuthor['delete_status'] = false;
                    }else{
                        $singleAuthor['delete_status'] = true;
                    }
                }else{
                    $error = $singleAuthorApi->json();
                    dd($error);
                }
               

            }
           
            // foreach($authorData['items'] as $value){
            //     echo "<pre>";
            //     print_r($value);
            //     echo "</pre>";
            //     // foreach($value as $singleAuthor){
            //     //     echo "$singleAuthor <br>";
            //     // }
            // }
            // dd($authorData);
        }else{
            $error = $authorApi->json();
            dd($error);
        }
        // $authorData = $authorData['items'];
        // dd($authorData);
       
        // dd($authorData);
        return view('authors-listing',compact('authorData'));
    
    
   }

   public function viewAuthor($authorId){
    // dd($authorId);
    $userToken = Session('user_token');
    $singleAuthorApi = Http::withHeaders([
        'accept' => 'application/json',
        'Authorization' => "Bearer $userToken"
    ])->get("https://candidate-testing.api.royal-apps.io/api/v2/authors/$authorId");
    $singleAuthorData = Null;
    if($singleAuthorApi->successful()){
        $singleAuthorData = $singleAuthorApi->json();
      
        // dd($singleAuthorData);
    }else{
        $error = $singleAuthorApi->json();
        dd($error);
    }
    return view('author-books',compact(['singleAuthorData','authorId']));

   }
   public function deleteBook($bookId){
        $userToken = Session('user_token');
        $deleteBookApi = Http::withHeaders([
            'Authorization' => "Bearer $userToken"
        ])->delete('https://candidate-testing.api.royal-apps.io/api/v2/books/'.$bookId);
        if($deleteBookApi->successful()){
            return redirect()->back()->with('success','Successfully Deleted');
        }else{
            dd($deleteBookApi->json());
        }
   }
   public function deleteAuthor($authorId){
     $userToken = Session('user_token');
     $deleteAuthorApi = Http::withHeaders([
        'Authorization' => "Bearer $userToken"
    ])->delete('https://candidate-testing.api.royal-apps.io/api/v2/authors/'.$authorId);
    if($deleteAuthorApi->successful()){
        return redirect()->back()->with('success','Successfully Deleted');
    }else{
        dd($deleteAuthorApi->json());
    }
   }
   public function addBook(){
    $userToken = Session('user_token');
    //getting all author using below api.
    $authorApi = Http::withHeaders([
        'accept' => 'application/json',
        'Authorization' => "Bearer $userToken"
    ])->get('https://candidate-testing.api.royal-apps.io/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1');
      $authorList = null;
      if($authorApi->successful()){
        $authorList = $authorApi->json();
        // dd($authorList);
      }
    return view('add-book',compact('authorList'));
   }

   public function saveBook(Request $request){
    //  dd(gettype((int)$request->number_of_pages));
    $userToken = Session('user_token');
    $addBookRequest = Http::withHeaders([
         'accept' => 'application/json',
         'Content-Type' => 'application/json',
         'Authorization' => "Bearer $userToken"
     ])->post('https://candidate-testing.api.royal-apps.io/api/v2/books',[
        "author" => [
            "id" => $request->author_id
        ],
          "title" => $request->title,
          "release_date" => $request->release_date,
          "description"=> $request->description,
          "isbn" => $request->isbn,
          "format"=> $request->format,
          "number_of_pages" => (int)$request->number_of_pages
     ]);
    if($addBookRequest->successful()){
        $addBookStatus = $addBookRequest->json();
        return redirect()->back()->with('success','successfully added the book');
    }else{
        $error = $addBookRequest->json();
        dd($error);
    }
   }
   public function logout(){
    Session::forget(['user_token','user_first_name','user_last_name']);
    return redirect()->route('login.form');
   }
}
