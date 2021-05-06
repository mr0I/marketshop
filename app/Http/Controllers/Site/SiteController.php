<?php

namespace App\Http\Controllers\Site;
//namespace App\Mail;


use App\Cart;
use App\brand;
use App\City;
use App\Review;
use App\Product;
use App\Category;
use App\ProductData;
use App\Slider;
use App\UserProducts;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use nilsenj\Toastr\Facades\Toastr;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Array_;
use Wicochandra\Captcha\Facade\Captcha;
use App\Mail\ContactUsMail;


class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }


    public function cat($catid)
    {
        $cat = Category::find($catid);
        if ($cat != null) {
            $products = $this->similarProducts( $catid, 0);
            return view('site.category', compact('cat', 'products'));
        } else {
            return view('site.404');
        }
    }

    public function subcat1($catid, $subcatid)
    {
        $cat = Category::find($catid);
        if ($cat != null) {
            $subcat1 = Category::find($subcatid);
            $products = Product::where('category_id', $subcatid)->latest()->paginate(3);
            return view('site.category', compact('subcat1', 'cat', 'products'));
        } else {
            return view('site.404');
        }
    }

    public function subcat2($catid, $subcatid1, $subcatid2)
    {
        $cat = Category::find($catid);

        if ($cat != null) {
            $subcat1 = Category::find($subcatid1);
            $subcat2 = Category::find($subcatid2);
            $products = Product::where('category_id', $subcatid2)->latest()->paginate(3);
            return view('site.category', compact('subcat1', 'subcat2', 'cat', 'products'));
        } else {
            return view('site.404');
        }
    }


    public function sort($col, $sort, $sort_catId, $paginate)
    {
        $cat = Category::findOrFail($sort_catId);
        $products = $this->sortedProducts($sort_catId, $col , $sort, $paginate);
        $sorting = $col.'/'.$sort;
        $pagin = $paginate;
        return view('site.category', compact('cat', 'products', 'sorting', 'pagin'));
    }


    public function sortedProducts($id, $col, $sort, $paginate)
    {
        $cat = Category::find($id);
        if ($cat != null) {
            if ($cat->parent_id != 0) {
                $products = Product::where('category_id', $id)->orderBy($col, $sort)->paginate($paginate);
            } else {
                $catChilds = Category::where('parent_id', $cat->id)->get();
                $array = [];
                $array[0] = $cat->id;
                foreach ($catChilds as $key => $value) {
                    $array[$key + 1] = $value->id;
                }
                $products = Product::whereIn('category_id', $array)->orderBy($col, $sort)->paginate($paginate);
            }
            return $products;
        }
    }



    public function similarProducts($cat_id , $product_id)
    {
        $cat = Category::find($cat_id);
        if ($cat != null) {
            if ($cat->parent_id != 0) {
                $products = Product::where('category_id', $cat_id)->where('id' , '<>' , $product_id)
                    ->latest()->paginate(5);
            } else {
                $catChilds = Category::where('parent_id', $cat->id)->get();
                $array = [];
                $array[0] = $cat->id;
                foreach ($catChilds as $key => $value) {
                    $array[$key + 1] = $value->id;
                }
                $products = Product::whereIn('category_id', $array)->where('id' , '<>' , $product_id)
                    ->latest()->paginate(5);
//                $len = 0;
//                foreach ($products as $product){
//                    $len++;
//                }
//                unset($products[$len-1]);
            }
            return $products;
        }
    }


    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $selfproduct = Product::where('slug', $slug)->first();
        $gallery_images = $product->product_galleries;
        $cat = $product->category;
        $parentcat = $cat->getParent;
        $sellproducts = Product::orderBy('sellCount', 'DESC')->get();
        $specproducts = Product::where('specialOffer', 1)->get();
        $similar_products = $this->similarProducts($selfproduct->category_id , $selfproduct->id );

        $reviews = Review::where('product_id', $selfproduct->id)
            ->where('confirmed', '1')->get();
        $score = 0;
        $count = 0;
        foreach ($reviews as $review) {
            $score += $review->vote;
            $count++;
        }
        if ($count != 0) {
            $vote = round($score / $count, 1);
        } else {
            $vote = 0;
        }

        if (Auth::guest()) {
            $isFav = 0;
        } else {
            $isFav = UserProducts::where('product_id', $selfproduct->id)
                ->where('user_id', Auth::user()->id)->first();
        }

        $specifications = ProductData::where('product_id', $selfproduct->id)->get();

        return view(
            'site.product',
            compact(
                'cat',
                'selfproduct',
                'product',
                'parentcat',
                'sellproducts',
                'specproducts',
                'gallery_images',
                'similar_products',
                'reviews',
                'vote',
                'isFav',
                'specifications'
            )
        );
    }


    public function brand($name)
    {
        $products = Product::where('brand', $name)->latest()->paginate(3);
        $brand = brand::where('name', $name)->first();
        if ($brand == null){
            return view('site.404');
        }
        return view('site.brand', compact('products', 'brand'));
    }

    public function sort_brand($col, $sort, $brandName , $paginate)
    {
        $products = Product::where('brand', $brandName)->orderBy($col, $sort)
            ->paginate($paginate);
        $brand = brand::where('name', $brandName)->first();
        $sorting = $col.'/'.$sort;
        $pagin = $paginate;
        return view('site.brand', compact('products', 'brand', 'sorting', 'pagin'));
    }


    public function myCaptcha()
    {
        return Captcha::url();
    }

    public function addFavotite($product_id)
    {
        $fav = UserProducts::where('product_id', $product_id)
            ->where('user_id', \Auth::user()->id)->first();
        if ($fav) {
            $emptyArray = [];
            if ($fav->isFavorite == 1) {
                $fav->update(array_merge($emptyArray, ['isFavorite' => 0]));
                return response(json_encode('محصول از علاقه مندی های شما حذف شد'));
            } elseif ($fav->isFavorite == 0) {
                $fav->update(array_merge($emptyArray, ['isFavorite' => 1]));
                return response(json_encode('محصول به علاقه مندی های شما اضافه شد'));
            }
        } else {
            $array = [
                'user_id' => \Auth::user()->id,
                'product_id' => $product_id,
                'isFavorite' => 1,
            ];
            UserProducts::create($array);
            return response(json_encode('محصول به علاقه مندی های شما اضافه شد'));
        }
    }

    public function aboutus()
    {
        return view('site.aboutus');
    }


    public function compare_index()
    {
        if (session()->get('compare1') != null){
            $product1 = Product::find(session()->get('compare1'));
            $reviews1 = Review::where('product_id', session()->get('compare1'))
                ->where('confirmed', 1)->get();
            $productData1 = ProductData::where('product_id', session()->get('compare1'))->first();
        }else{
            $product1 = null;
            $reviews1=0;
            $productData1 =null;
        }
        if (session()->get('compare2') != null){
            $product2 = Product::find(session()->get('compare2'));
            $reviews2= Review::where('product_id', session()->get('compare2'))
                ->where('confirmed', 1)->get();
            $productData2 = ProductData::where('product_id',session()->get('compare2'))->first();
        }else{
            $product2 = null;
            $reviews2=0;
            $productData2 =null;
        }
        if (session()->get('compare3') != null){
            $product3 = Product::find(session()->get('compare3'));
            $reviews3 = Review::where('product_id', session()->get('compare3'))
                ->where('confirmed', 1)->get();
            $productData3 = ProductData::where('product_id',session()->get('compare3'))->first();
        }else{
            $product3 = null;
            $reviews3=0;
            $productData3 =null;
        }


        $compare_count =0;
        if (session()->get('compare1')!=null){
            $compare_count++;
        }
        if (session()->get('compare2')!=null){
            $compare_count++;
        }
        if (session()->get('compare3')!=null){
            $compare_count++;
        }
        session()->put('compare_count', $compare_count);


        return view('site.compare', compact('product1', 'product2', 'product3', 'reviews1',
            'reviews2', 'reviews3','productData1', 'productData2', 'productData3'));
    }


    public function compare(Request $request)
    {
        $compare1= session()->get('compare1');
        $compare2= session()->get('compare2');
        $compare3= session()->get('compare3');
        $product_id=$request->productId;


        if ($compare1 == ''){
            if ($compare2 == $product_id || $compare3 == $product_id){
                echo 10;
            }else{
                session()->put('compare1',$product_id );
                session()->put('compare_count', 1);
                echo 1;
            }
        }elseif ($compare2 == ''){
            if ($compare1 == $product_id || $compare3 == $product_id){
                echo 10;
            }else{
                session()->put('compare2',$product_id );
                session()->put('compare_count', 2);
                echo 2;
            }
        }elseif ($compare3 == ''){
            if ($compare2 == $product_id || $compare1 == $product_id){
                echo 10;
            }else{
                session()->put('compare3',$product_id );
                session()->put('compare_count', 3);
                echo 3;
            }
        }else{
            echo 20;
        }
    }


    public function remove_compare($id)
    {
        session()->forget('compare'.$id);
        return redirect()->back();
    }


    public function search(Request $request)
    {
        $categories = Category::all();
        $str = $request->s;

        if(strpos($str,"'") === false){
            $phrase = $str;
        }else{
            $phrase = preg_replace("/[']/", "", $str);
        }


        if ($request->cat != 0){
            $products = Product::where('title','like','%'.$phrase.'%')
                ->where('category_id', $request->cat)->paginate(3);
        }else{
            $products = Product::where('title','like','%'.$phrase.'%')->paginate(3);
        }
        return view('site.search', compact('phrase', 'categories', 'products'));
    }


    public function Ajax_search($phrase)
    {
        $products = Product::where('title','like','%'.$phrase.'%')->get();

        $array= [];
        $data= [];
        foreach ($products as $key=>$value) {
            $array[$key]= $value->title;
            array_push( $data , $array[$key] );
        }

        echo json_encode($data);
    }

    public function contact_us()
    {
        return view('site.contactus');
    }


    public function contact_us_mail(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->enquiry;

        if (Auth::check()){
            $user = Auth::user()->name;
        }else{
            $user = 'Guset';
        }

        Mail::to('wizard2070@gmail.com')
            ->send(new ContactUsMail($user, $name, $email, $message));

        Toastr::success('message sent');
        return redirect()->back();
    }

    public function selectCity(Request $request)
    {
        $cities = City::where('parent_id', $request->id)->get();

        echo $cities;
    }


    public function wishlist()
    {
        if(Auth::check()){
            $user_products = UserProducts::where('user_id', Auth::user()->id)
                ->where('isFavorite', 1)->get();
            $product_ids = [];
            foreach ($user_products as $user_product){
                array_push($product_ids, $user_product->product_id);
            }
            $wish_products = Product::whereIn('id', $product_ids)->get();
        }else{
            $wish_products = null;
        }

        //return dd($wish_products);

        return view('site.wishlist', compact('wish_products'));
    }

    public function clearWishProduct(Request $request){
        $product_id = $request->product_id;
        $userproduct = UserProducts::where('product_id', $product_id)
            ->where('user_id', Auth::user()->id)->first();

        $res = $userproduct->delete();
        if ($res){
            return 1;
        }else{
            return 0;
        }
    }
	
    public function restricted(){
		return view('site.restricted');
    }





}