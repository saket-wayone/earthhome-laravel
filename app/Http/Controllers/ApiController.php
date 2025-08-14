<?php

namespace App\Http\Controllers;

use App\Models\admin\doctor\DoctorModel;
use App\Models\admin\doctor\DoctorReportModel;
use App\Models\BookModel;
use App\Models\feedbaclModel;
use App\Models\innerPageModel;
use App\Models\NotifyMr;
use App\Models\PurchasedPlan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\GlobalModel;

use App\Models\leadModel;
use App\Models\ProjectCategory;
use App\Models\TaskModel;
use App\Models\SourceModel;
use App\Models\BannerModel;


class ApiController extends Controller
{



    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            try {
                // // check user registered with the email or not
                $checkMobileFirst =  User::where('phone', $request->phone)->where('role', 'user')->first();
                if (empty($checkMobileFirst)) {
                    return response()->json(['code' => 401, 'message' => 'Client not registerd'], 401);
                } else {
                    // now verify otp phase bro
                    // $otp  = rand(1111, 9999);
                    $otp  =123456;
                    $checkMobileFirst->otp =  $otp;
                    $checkMobileFirst->save();
                    return response()->json(['code' => 200, 'message' => 'OTP sent succussfully!'], 200);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 500, 'message' => $e->getMessage()], 500);
            }
        }
    }



    public function veriyotp(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            try {
                // // check user registered with the email or not
                $checkMobileFirst =  User::where('phone', $request->phone)->where('role', 'user')->first();
                if (empty($checkMobileFirst)) {
                    return response()->json(['code' => 401, 'message' => 'Client not registerd'], 401);
                } else {
                    // now verify otp phase bro
                    // $otp  = rand(1111, 9999);
                    if ($checkMobileFirst->otp == $request->otp) {
                        return response()->json(['code' => 200, 'message' => 'OTP verified Successfully!', 'data' => $checkMobileFirst], 200);
                    } else {
                        return response()->json(['code' => 401, 'message' => 'Invalid OTP'], 401);
                    }
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 500, 'message' => $e->getMessage()], 500);
            }
        }
    }


    public function  getProject(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            
        }
    }

    public function getCategorires(Request $request)
    {
        $getCategories =  SourceModel::get();
        $url = env(key: 'DEV_BASE_URL');
        $finalData  = [];

        if (!empty($getCategories)) {
            foreach ($getCategories as $list) {
                $dataToBePushed['id'] = $list->id;
                $dataToBePushed['category']  =  $list->source;
                $dataToBePushed['image']  = $url  . $list->image;
                array_push($finalData, $dataToBePushed);
            }
        }

        return response()->json(['code' => 200, 'data' => $finalData, 'message' => 'Category found successufully!']);
    }

    public function banners(Request $request)
{
    $getCategories = BannerModel::orderBy('id', 'desc')->get();
    $url = env('DEV_BASE_URL');
    $finalData = [];

    if (!empty($getCategories)) {
        foreach ($getCategories as $list) {
            $dataToBePushed['id'] = $list->id;
            $dataToBePushed['image'] = rtrim($url, '/') . '/' . ltrim($list->image, '/');
            array_push($finalData, $dataToBePushed);
        }
    }

    return response()->json(['code' => 200, 'data' => $finalData, 'message' => 'Banners found successfully!']);
}







    public function projects(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            try {
                // get all projects
                $Projects = leadModel::whereUserId($request->client_id)->orderby('id', 'desc')->limit(1)->get();
                $projectArray = [];

                if (count($Projects) > 0) {
                    foreach ($Projects as $listing) {
                        $data['id'] =  $listing->id;
                                                                        $data['project_name'] = $listing->name;
                                                                        $data['project_address'] = $listing->address;
                        $data['base_url'] =  env('DEV_BASE_URL') ;
                        $data['status'] = $listing->status;
                        $data['project_id'] = $listing->unique_id;
                        
                        $data['aggrement_file'] =  env('DEV_BASE_URL') . $listing->agreement_file;
                        $data['quotation_file'] =  env('DEV_BASE_URL') . $listing->quotation_file;
                        $data['total'] = $listing['total'];
                        // Pehle project categories fetch karein
$projectCategories = ProjectCategory::where('lead_id', $listing->id)->get();

// Category names ko extract karein taake ek hi query me sources fetch ho sake
$categoryNames = $projectCategories->pluck('category')->toArray();

// Ab sources fetch karein jo in categories se match hote hain
$sources = SourceModel::whereIn('source', $categoryNames)->pluck('image', 'source');

// Har project category ke andar corresponding image map karein
$projectCategories->transform(function ($category) use ($sources) {
    $category->image = $sources[$category->category] ?? null; // Agar image milti hai to assign kar do, nahi to null
    return $category;
});

// Final data assign karein
$data['projectCategoriesWorkingExpectations'] = $projectCategories;


                        array_push($projectArray, $data);
                    }


                    return response()->json(['code' => 200, 'message' => 'Projects Found Successfully!', 'data' => $projectArray], 200);
                } else {
                    return response()->json(['code' => 204, 'message' => 'No Project Found'], 200);
                }
            } catch (\Exception $e) {
            }
        }
    }
    
    
      public function getallProjects(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            try {
                // get all projects
                $Projects = leadModel::whereUserId($request->client_id)->orderby('id', 'desc')->get();
                $projectArray = [];

                if (count($Projects) > 0) {
                    foreach ($Projects as $listing) {
                        $data['id'] =  $listing->id;
                        $data['base_url'] =  env('DEV_BASE_URL') ;
                        $data['status'] = $listing->status;

                        $data['project_inited'] = date('d-m-Y', strtotime($listing->created_at));
                        $data['project_name'] = $listing->name;
                        $data['project_address'] = $listing->address;

                        $data['project_id'] = $listing->unique_id;
                        $data['aggrement_file'] =  env('DEV_BASE_URL') . $listing->agreement_file;
                        $data['quotation_file'] =  env('DEV_BASE_URL') . $listing->quotation_file;
                        $data['total'] = $listing['total'];
                        // Pehle project categories fetch karein
                        $projectCategories = ProjectCategory::where('lead_id', $listing->id)->get();
                        
                        // Category names ko extract karein taake ek hi query me sources fetch ho sake
                        $categoryNames = $projectCategories->pluck('category')->toArray();
                        
                        // Ab sources fetch karein jo in categories se match hote hain
                        $sources = SourceModel::whereIn('source', $categoryNames)->pluck('image', 'source');
                        
                        // Har project category ke andar corresponding image map karein
                        $projectCategories->transform(function ($category) use ($sources) {
                            $category->image = $sources[$category->category] ?? null; // Agar image milti hai to assign kar do, nahi to null
                            return $category;
                        });

 $taskLatest =   TaskModel::with('before', 'after')->where('lead_id',$listing->id)->orderby('id', 'desc')->first();


                            if(!empty($taskLatest)){
                               $catname = DB::table('sources')->where('id',$taskLatest->category)->first();
                                $data['current_task']= $catname->source;
                                
    
                            }else{
                                $data['current_task']= 'Still to be initated';

                                
                            }
                        // Final data assign karein
                        $data['projectCategoriesWorkingExpectations'] = $projectCategories;
                        


                        array_push($projectArray, $data);
                    }


                    return response()->json(['code' => 200, 'message' => 'Projects Found Successfully!', 'data' => $projectArray], 200);
                } else {
                    return response()->json(['code' => 204, 'message' => 'No Project Found'], 200);
                }
            } catch (\Exception $e) {
            }
        }
    }
    
    
    
    public  function getTodayTask(Request $request){
         $validate = Validator::make($request->all(), [
            'project_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
             try {
                $task =   TaskModel::with('before', 'after')->where('lead_id', $request->project_id)->where('task_date',date('Y-m-d'))->limit(1)->orderby('id', 'desc')->get();
                $taskArray = [];
                if (count($task) > 0) {
                    foreach ($task as $list) {
                        $beforeEmpty = [];
                        $afterEmpty = [];
                        $data['task_date']  =  $list->task_date;
                        $data['description']  =  $list->description;

                        $beforeArray =  $list->before;
                        $afterArray =  $list->after;
                        if (count($beforeArray) > 0) {
                            foreach ($beforeArray as $beimage) {
                                array_push($beforeEmpty, ['image' => env('DEV_BASE_URL') . $beimage->image]);
                            }
                        }
                        if (count($afterArray) > 0) {
                            foreach ($afterArray as $beimage) {
                                array_push($afterEmpty, ['image' => env('DEV_BASE_URL') . $beimage->image]);
                            }
                        }

                        $data['before'] = $beforeEmpty;
                        $data['after'] = $afterArray;
                        $data['after'] = $afterArray;
                        array_push($taskArray, $data);
                        $beforeEmpty = [];
                        $afterEmpty = [];
                    }
                    return response()->json(['code' => 200, 'message' => 'Task found succussfully!', 'data' => $taskArray], 200);
                } else {
                    return response()->json(['code' => 404, 'message' => 'No Task found for today'], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 500, 'message' => $e->getMessage()], 500);
            }
            
        }
        
    }
    
    
    
    
    
     public function projects2(Request $request)
    {
        // $validate = Validator::make($request->all(), [
        //     'client_id' => 'required',
        // ]);

        // if ($validate->fails()) {
        //     return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        // } else {
            try {
                // get all projects
                 $Projects = leadModel::whereUserId(136)->orderby('id', 'desc')->limit(1)->get();
                $projectArray = [];

                if (count($Projects) > 0) {
                    foreach ($Projects as $listing) {
                        $data['id'] =  $listing->id;
                        $data['base_url'] =  env('DEV_BASE_URL') ;
                        $data['status'] = $listing->status;
                        $data['project_id'] = $listing->unique_id;
                        
                        $data['aggrement_file'] =  env('DEV_BASE_URL') . $listing->agreement_file;
                        $data['quotation_file'] =  env('DEV_BASE_URL') . $listing->quotation_file;
                        $data['total'] = $listing['total'];
                        // Pehle project categories fetch karein
$projectCategories = ProjectCategory::where('lead_id', $listing->id)->get();

// Category names ko extract karein taake ek hi query me sources fetch ho sake
$categoryNames = $projectCategories->pluck('category')->toArray();

// Ab sources fetch karein jo in categories se match hote hain
$sources = SourceModel::whereIn('source', $categoryNames)->pluck('image', 'source');

// Har project category ke andar corresponding image map karein
$projectCategories->transform(function ($category) use ($sources) {
    $category->image = $sources[$category->category] ?? null; // Agar image milti hai to assign kar do, nahi to null
    return $category;
});

// Final data assign karein
$data['projectCategoriesWorkingExpectations'] = $projectCategories;


                        array_push($projectArray, $data);
                    }

                    return response()->json(['code' => 200, 'message' => 'Projects Found Successfully!', 'data' => $projectArray], 200);
                } else {
                    return response()->json(['code' => 204, 'message' => 'No Project Found'], 200);
                }
            } catch (\Exception $e) {
            }
        // }
    }

    public function getCategoryWiseTask(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_id' => 'required',
            'project_id'=>'required',
            'projectCategoryId' =>'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {


            try {
                $task =   TaskModel::with('before', 'after')->where('lead_id',$request->project_id)->whereCategory($request->category_id)->orderby('id', 'desc')->get();
                $taskArray = [];

            $price =  ProjectCategory::where('id',$request->projectCategoryId)->first();


                if (count($task) > 0) {
                    foreach ($task as $list) {
                        $beforeEmpty = [];
                        $afterEmpty = [];
                        $data['task_date']  =  $list->task_date;
                        $data['description']  =  $list->description;

                        $beforeArray =  $list->before;
                        $afterArray =  $list->after;
                        if (count($beforeArray) > 0) {
                            foreach ($beforeArray as $beimage) {
                                array_push($beforeEmpty, ['image' => env('DEV_BASE_URL') . $beimage->image]);
                            }
                        }
                        if (count($afterArray) > 0) {
                            foreach ($afterArray as $beimage) {
                                array_push($afterEmpty, ['image' => env('DEV_BASE_URL') . $beimage->image]);
                            }
                        }

                        $data['before'] = $beforeEmpty;
                        $data['after'] = $afterArray;
                        $data['after'] = $afterArray;
                        array_push($taskArray, $data);
                        $beforeEmpty = [];
                        $afterEmpty = [];
                    }
                                 
                    return response()->json(['code' => 200,'price'=>$price->price,'status'=>$price->status ,'message' => 'Task found succussfully!', 'data' => $taskArray ], 200);
                } else {
                    return response()->json(['code' => 404, 'message' => 'No Task found for this category'], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 500, 'message' => $e->getMessage()], 500);
            }
        }
    }


    public function getCustomerProfile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $existUser =  User::select('id', 'username', 'email', 'phone','unique_id')->find($request->client_id);
            try {
                if (!empty($existUser)) {
                    return response()->json(['code' => 200, 'message' => 'User Found Successfully!', 'data' => $existUser]);
                } else {
                    return response()->json(['code' => 404, 'message' => 'No User Found!'], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 500, 'message' => $e->getMessage()], 500);
            }
        }
    }

    public function feedback(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required',
            'name' => 'required',
            'contact' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $data['name']  =  $request->name;
            $data['contact']  =  $request->contact;
            $data['suject']  =  $request->subject;
            $data['client_id']  =  $request->client_id;
            $data['message']  =  $request->message;
            $data['created_at']  = now();
            try {
            $query =  feedbaclModel::insert($data);
           
                if (!empty($query)) {
                    return response()->json(['code' => 200, 'message' => 'Feedback Form Submitted  Successfully!']);
                } else {
                    return response()->json(['code' => 500, 'message' => 'Something went wrong!'], 500);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 500, 'message' => $e->getMessage()], 500);
            }
        }
    }


    public function profileImage(Request $request){
        $validate = Validator::make($request->all(), [
            'profile' => 'required',
            'user_id' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
             try {
        // Get the uploaded image
        $image = $request->file('profile');

        // Generate a unique name for the image
        $imageName = time() . '_' . $image->getClientOriginalName();

        // Store the image in the 'profiles' directory within the public path
        $imagePath = $image->move(public_path('profiles'), $imageName);

        // You can store the image path in the database if needed
        // Example: User::where('id', $request->user_id)->update(['profile_image' => $imageName]);
                $url = env(key: 'DEV_BASE_URL');
      $query =  DB::table('users')->where('id',$request->user_id)->update(['logo'=>$imageName]);
        return response()->json([
            'code' => 200,
            'message' => 'Profile image has been uploaded successfully!',
            'data' => ['image_path' => url('profile'.$imageName)] // Optional, return the image path
        ]);
    } catch (\Exception $e) {
        return response()->json(['code' => 500, 'message' => 'Something went wrong. Please try again.']);
    }


        }
    }


    public function getUserInfo(Request $request){

          $validate = Validator::make($request->all(), [
            'user_id' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            $users = DB::table('users')->where('id',$request->user_id)->first();
            if(!empty($users)){
        $url = env(key: 'DEV_BASE_URL');
        if($users->logo != null){
            $path= url('profiles/'.$users->logo);
        }else{
            $path = '';
        }

                return response()->json(['code' => 200, 'message' => 'User Found successfully!','data'=>$users ,'image'=>$path], 200);


            }else{
                 return response()->json(['code' => 500, 'message' => 'User Not Found'], 500);


            }
        }

    }

    
}

