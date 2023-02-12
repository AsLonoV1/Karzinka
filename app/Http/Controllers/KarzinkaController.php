<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Achot;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sold;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use PhpParser\NodeVisitor\FirstFindingVisitor;

class KarzinkaController extends Controller
{
    public function usersPage() {

       $users=User::orderByDesc('created_at')->paginate(7);
       return view('users.users',[
        'users'=>$users
       ]);

    }

    public function categoryPage() {

        $categories=Category::where('categoryStatus',1)->get();
        $report=Report::where('userId',Auth::User()->id)->first();

        if($report==null){
            $report=new Report();
            $report->userId=0;
            $report->soldChosen=0;
            $report->soldSumm=0;

        }
            return view('category.category',[
             'categories'=>$categories,
             'report'=>$report
            ]);
       
 
     }
    public function usersUpdateb($id,Request $request) {

        $users=User::where('id',$id)->first();
        return view('users.usersUpdate',[
         'users'=>$users
        ]);
 
     }

    public function usersLogin(LoginRequest $request) {

          $credentials =[
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($credentials)){

            $users=User::orderByDesc('created_at')->paginate(7);
            return view('users.users',[
             'users'=>$users
            ]);
     
        }else{
            return redirect()->back();
        }
     }

    public function usersCreate(Request $request){

        $request->validate([

            'firstName'  =>'required',
            'lastName'  =>'required',
            'email' =>'required',
            'phone' =>'required|min:5',
            'password' =>'required'

   ]);
        $user= new User();
        $user->firstName=$request['firstName'];
        $user->lastName=$request['lastName'];
        $user->email=$request['email'];
        $user->phone=$request['phone'];
        $user->password=bcrypt($request['password']);
        $user->save();
       return redirect()->route('usersPage');
    }
    public function usersUpdate($id,Request $request){

        $request->validate([

            'firstName'  =>'required',
            'lastName'  =>'required',
            'email'  =>'required',
            'phone'  =>'required',
            'password'=>'required'
           
   ]);
        $user=User::where('id',$id)->first();
        $user->firstName=$request['firstName'];
        $user->lastName=$request['lastName'];
        $user->email=$request['email'];
        $user->phone=$request['phone'];
      //  dd($request['password']);
      if($request['password']!=null){
          $user->password=bcrypt($request['password']);
      }
        $user->save();
       return redirect()->route('usersPage');
    }

    public function usersDelete($id ,Request $request) {

        $user=User::where('id',$id)->first();
        if($id==Auth::User()->id){
            
      //  dd('ok');   
            return redirect()->route('usersPage');
        }else{
       //     dd('no'); 
            $user->delete();
            return redirect()->route('usersPage');
        }
    }

    public function categoryDelete($id ,Request $request) {

        $category=Category::where('id',$id)->first();
        $report=Report::where('userId',Auth::User()->id)->first();
        $products=Product::where('categoryId',$id)->get();

                if($report!=null){
            $report->soldChosen=$report->soldChosen-$category->categoryChosen;
            $report->soldSumm=$report->soldSumm-$category->categorySumm;
            $report->save();
                    }

                    foreach($products as $product){
                        $sold=Sold::where('productName',$product->id)->first();
                        if($sold!=null){
                            $sold->delete();
                        }
                        $product->delete();
                    } 
                                    
                                    $category->delete();
            return redirect()->route('categoryPage');
        }


        public function categoryCreate(Request $request)
        {
         //  dd($request['categoryStatus']);
            $category= new Category();
            $category->categoryTitle=$request['categoryTitle'];
            // if($request['categoryStatus']!=null){
            //     $category->categoryStatus=$request['categoryStatus'];
            // }else{ $category->categoryStatus=0;}
            $category->categoryStatus = ($request['categoryStatus']!=null)?1:0;
            $category->categoryChosen=0;
            $category->categorySumm=0;
            $category->save();
           return redirect()->route('categoryPage');
        }


        public function categoryUpdateb($id,Request $request) {

        $category=Category::where('id',$id)->first();
        return view('category.categoryUpdate',[
         'category'=>$category
        ]);
 
     }


     public function categoryUpdate($id,Request $request){

        $request->validate([

            'categoryTitle'  =>'required',
           
   ]);
        $category=Category::where('id',$id)->first();
        $category->categoryTitle=$request['categoryTitle'];
        if($request['categoryStatus']!=null){
            $category->categoryStatus=$request['categoryStatus'];
        }else{
            $category->categoryStatus=0;  
        }

        $category->save();
       return redirect()->route('categoryPage');
    }

    public function categoryProduct($id,Request $request) {

        $category=Category::where('id',$id)->first();
        // $category=Category::with('products')->first();
        $products=Product::where('categoryId',$id)->get();

      
        return view('category.categoryProduct',[
         'category'=>$category,
         'products'=>$products,
   
        ]);
 
     }
     public function productCreate($id,Request $request){

        $request->validate([

            'productTitle'  =>'required',
            'productAmout'  =>'required|numeric',
            'productCount'  =>'required|numeric',
    
   ]);
        $product= new Product();
        $product->productTitle=$request['productTitle'];
        $product->productAmout=$request['productAmout'];
        $product->productCount=$request['productCount'];
        $product->categoryId=$id;
        $product->productChosen=0;
        $product->save();
       return redirect()->route('categoryProduct',$id);
    }

    public function productCreateb($id,Request $request) {

        return view('product.productCreate',[
         'id'=>$id
        ]);
 
     }

     public function productDelete($id ,Request $request) {
        
         $product=Product::where('id',$id)->first();
         $report=Report::where('userId',Auth::User()->id)->first();
         $category=Category::where('id',$product->categoryId)->first();
         $sold=Sold::where('productName',$product->id)->first();
         
         if($report!=null){
             
             $report->soldChosen=$report->soldChosen-$product->productChosen;
             $report->soldSumm=$report->soldSumm-($product->productChosen*$product->productAmout);
             $report->save();
            }
            if( $category!=null){

                $category->categoryChosen= $category->categoryChosen-$product->productChosen;
                $category->categorySumm=$category->categorySumm-($product->productChosen*$product->productAmout);
                
            }
            
            $product->delete();

            if($sold!=null){
                $sold->delete();
            }
            
            $products=Product::where('categoryId',$category->id)->first();
            //dd($products);

            if($products==null){
                $category->categoryStatus=0;
                $category->save();
                return redirect()->back();
            }
         //   dd($category->categoryStatus);
            $category->save();

            return redirect()->back();
        }


        public function productUpdateb($id,Request $request) {

            $product=Product::where('id',$id)->first();
            return view('product.productUpdate',[
             'product'=>$product
            ]);
     
         }
         public function productUpdateAllb($id,Request $request) {

            $product=Product::where('id',$id)->first();
            return view('product.productUpdateAll',[
             'product'=>$product
            ]);
     
         }

         public function productUpdate($id,Request $request){

            $request->validate([

                'productTitle'  =>'required',
                'productAmout'  =>'required|numeric',
                'productCount'  =>'required|numeric',
     
       ]);
            $product=Product::where('id',$id)->first();
            $product->productTitle=$request['productTitle'];
            $product->productAmout=$request['productAmout'];
            $product->productCount=$request['productCount'];
            $product->save();
           return redirect()->route('categoryProduct',$product->categoryId);
        }
        
        public function productUpdateAll($id,Request $request){

            $request->validate([

                'productTitle'  =>'required',
                'productAmout'  =>'required|numeric',
                'productCount'  =>'required|numeric',
     
       ]);
            $product=Product::where('id',$id)->first();
            $product->productTitle=$request['productTitle'];
            $product->productAmout=$request['productAmout'];
            $product->productCount=$request['productCount'];
            $product->save();
           return redirect()->route('allProducts');
        }

        public function   productBasket($id,Request $request){
              
                   
        $user=User::where('id',Auth::User()->id)->first();
        // $user=Auth::User();
        
        $report=Report::where('userId',$user->id)->first();
        
        $product=Product::where('id',$id)->first();
        $category=Category::where('id',$product->categoryId)->first();
        
        if($product->productCount>0){

                        if($product->productChosen==0){
                            $sold= new Sold();
                            $sold->userId=$user->id;
                            $sold->productName=$product->id;
                            $sold->productAmout=$product->productAmout;
                            $sold->productChosen=1;
                            $sold->save();
                        }else{
                            $sold=Sold::where('productName',$product->id)->first();
                            $sold->productChosen=$sold->productChosen+1;
                            $sold->save();
                        }
                
                
                        if($report==null){  
                            $report=new Report();
                            $report->userId=$user->id;
                            $report->soldChosen=$report->soldChosen+1;
                            $report->soldSumm=$report->soldSumm+$product->productAmout;
                        }else{
                            $report->soldChosen=$report->soldChosen+1;
                            $report->soldSumm=$report->soldSumm+$product->productAmout;
                        }

                        $product->productCount=$product->productCount-1;
                        $product->productChosen=$product->productChosen+1;
                        $category->categoryChosen= $category->categoryChosen+1;
                        $category->categorySumm=$category->categorySumm+$product->productAmout;
                        
                            $product->save();
                            $category->save();
                            $report->save();
                        
        }
                   return redirect()->route('categoryProduct',$product->categoryId);
            
        }
        public function productAbort($id,Request $request){
                
            $product=Product::where('id',$id)->first();
            $category=Category::where('id',$product->categoryId)->first();
            $report=Report::where('userId',Auth::User()->id)->first();
            $sold=Sold::where('productName',$product->id)->first();



            if($product->productChosen>0){
                            $product->productCount=$product->productCount+1;
                            $product->productChosen=$product->productChosen-1;
                            if($category->categoryChosen>0){
                                $category->categoryChosen= $category->categoryChosen-1;
                                $category->categorySumm=$category->categorySumm-$product->productAmout;
                            }

                            if($report->soldChosen>0){
                                $report->soldChosen=$report->soldChosen-1;
                                $report->soldSumm=$report->soldSumm-$product->productAmout;
                            }

                            $sold->productChosen=$sold->productChosen-1;
                            
                        if($sold->productChosen==0){ $sold->delete();   }else{  $sold->save(); }

                            $product->save();
                            $category->save();
                            $report->save();
                            
                        
                            return redirect()->route('categoryProduct',$product->categoryId);

                        }else{
                        
                            return redirect()->route('categoryProduct',$product->categoryId);  
              }
        }

            public function productSold() {

                $solds=Sold::orderByDesc('created_at')->paginate(20);
                $report=Report::where('userId',Auth::User()->id)->first();
                $user=User::where('id',Auth::User()->id)->first();
                foreach($solds as $sold){

                    $product=Product::where('id',$sold->productName)->first();
                    $sold->productName=$product->productTitle;
                   $sold->save();
                }
          if($report!=null){
              if($report->soldSumm>0 ){
                  $achot= new Achot();
                  $achot->userId=$report->userId;
                  $achot->userName=0;
                  $achot->achotSumm=$report->soldSumm;
                  $achot->save();
              }
          }else{
            $report= new Report();
            $report->userId=0;
            $report->soldChosen=0;
            $report->soldSumm=0;
            $report->save();
          }


                return view('product.productSold',[
                    'solds'=>$solds,
                    'report'=>$report,
                    'user'=>$user
                ]);

                }

                public function logout() {

                   $products=Product::all();
                   $categories=Category::all();
                   $solds=Sold::all();
                   $reports=Report::all();

                   foreach($products as $product){
                    $product->productChosen=0;
                    $product->save();
                   }
                   foreach($categories as $category){
                    $category->categoryChosen=0;
                    $category->categorySumm=0;
                    $category->save();
                   }
                   foreach($solds as $sold){
                    $sold->delete();
                   }
                   foreach($reports as $report){
                    $report->delete();
                   }
                   return redirect()->route('login');
                 }

                 public function achot() {

                    $achots=Achot::orderByDesc('created_at')->paginate(20);
                    
                                foreach($achots as $achot){
                                    $user=User::where('id',$achot->userId)->first();
                                    if($user!=null){
                                        $achot->userName=$user->firstName;
                                    }
                                    $achot->save();
                                }

                    return view('achot.achot',[
                        'achots'=>$achots
                    ]);
    
                    }
                    public function allProducts() {
                        $products=Product::all();
                        $report=Report::where('userId',Auth::User()->id)->first();
                        if($report==null){
                            $report=new Report();
                            $report->userId=0;
                            $report->soldChosen=0;
                            $report->soldSumm=0;
                        }
                        foreach($products as $product){
                           $category=Category::where('id',$product->categoryId)->first();
                           if($category->categoryStatus==0){
                            
                             $product->delete();

                           }

                        }
                                                return view('product.allProducts',[
                         'products'=>$products,
                         'report'=> $report
                        ]);
                 
                     }


public function allProductBasket($id,Request $request){
              
                   
        $user=User::where('id',Auth::User()->id)->first();
        $report=Report::where('userId',Auth::User()->id)->first();
        
        $product=Product::where('id',$id)->first();
        $category=Category::where('id',$product->categoryId)->first();

        if($product->productCount>0){
            

                            if($product->productChosen==0){
                                $sold= new Sold();
                                $sold->userId=$user->id;
                                $sold->productName=$product->id;
                                $sold->productAmout=$product->productAmout;
                                $sold->productChosen=1;
                                $sold->save();
                            }else{
                                $sold=Sold::where('productName',$product->id)->first();
                                $sold->productChosen=$sold->productChosen+1;
                                $sold->save();
                            }
                    
                    
                            if($report==null){  
                                $report=new Report();
                                $report->userId=$user->id;
                                $report->soldChosen=$report->soldChosen+1;
                                $report->soldSumm=$report->soldSumm+$product->productAmout;
                            }else{
                                $report->soldChosen=$report->soldChosen+1;
                                $report->soldSumm=$report->soldSumm+$product->productAmout;
                            }
                            
                                $product->productCount=$product->productCount-1;
                                $product->productChosen=$product->productChosen+1;
                                $category->categoryChosen= $category->categoryChosen+1;
                                $category->categorySumm=$category->categorySumm+$product->productAmout;
                    
                                $product->save();
                                $category->save();
                                $report->save();

        }
            
           return redirect()->route('allProducts');
        }

        public function allProductAbort($id,Request $request){
                
            $product=Product::where('id',$id)->first();
            $category=Category::where('id',$product->categoryId)->first();
            $report=Report::where('userId',Auth::User()->id)->first();
            $sold=Sold::where('productName',$product->id)->first();



            if($product->productChosen>0){

                            $product->productCount=$product->productCount+1;
                            $product->productChosen=$product->productChosen-1;
                            if($category->categoryChosen>0){
                                $category->categoryChosen= $category->categoryChosen-1;
                                $category->categorySumm=$category->categorySumm-$product->productAmout;
                            }

                            if($report->soldChosen>0){
                                $report->soldChosen=$report->soldChosen-1;
                                $report->soldSumm=$report->soldSumm-$product->productAmout;
                            }

                            $sold->productChosen=$sold->productChosen-1;
                            
                        if($sold->productChosen==0){ $sold->delete();   }else{  $sold->save(); }

                            $product->save();
                            $category->save();
                            $report->save();
                            
                        
                            return redirect()->route('allProducts');

            }else{
               
                return redirect()->route('allProducts');  
            }
        }

        public function productCreateAllb() {

            $categories=Category::where('categoryStatus',1)->get();
            return view('product.productCreateAll',[
             'categories'=>$categories
            ]);
     
         }
         public function productCreateAll(Request $request){


            $request->validate([

                'productTitle'  =>'required',
                'productAmout'  =>'required|numeric',
                'productCount'  =>'required|numeric',
               
        
       ]);
            $category=Category::where('id',$request['categoryId'])->first();
            if($request['categoryId']!="choose the category"){
                // dd($request['categoryId']);
                $product= new Product();
                $product->productTitle=$request['productTitle'];
                $product->productAmout=$request['productAmout'];
                $product->productCount=$request['productCount'];
                $product->categoryId=$request['categoryId'];
                $product->productChosen=0;
                $category->categoryStatus=1;
                $product->save();
                $category->save();
                return redirect()->route('categoryPage');
            }else{
                return redirect()->back();
            }
        }


    }
