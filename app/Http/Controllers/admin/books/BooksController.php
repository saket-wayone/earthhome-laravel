<?php

namespace App\Http\Controllers\admin\books;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookValidate;
use App\Models\innerPageModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Book\BookInterface;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;
use PDO;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Imagecow\Image as ImageCow;


class BooksController extends Controller
{
   protected $bookInterface;
   public function __construct(BookInterface $bookInterface)
   {
      $this->bookInterface =  $bookInterface;
   }

   public function index()
   {
      return $this->bookInterface->index();
   }
   public function create()
   {
      return $this->bookInterface->create();
   }
   public function createpage($id)
   {
      return $this->bookInterface->createpage($id);
   }
   public function showpage($id)
   {
      return $this->bookInterface->showpage($id);
   }
   public function delete(Request $request)
   {
      return  $this->bookInterface->delete($request);
   }
   public function deletepage(Request $request)
   {
      return  $this->bookInterface->deletepage($request);
   }


   public function store(BookValidate $bookvalidate)
   {
      return $this->bookInterface->store($bookvalidate);
   }
   public function update(BookValidate $bookvalidate)
   {
      return $this->bookInterface->update($bookvalidate);
   }

   public function edit($id)
   {
      return $this->bookInterface->edit($id);
   }

   public function uploadImages(Request $request)
   {
       $role = Auth::user()->role;
       $companyName = Auth::user()->company_name;
   
       if ($role == 'manager') {
           // get the company name 
           $getCompanyName = User::getCompanyName(Auth::user()->company_id);
           $companyName = $getCompanyName->company_name;
       }
   
       $dataToInsert = [];
        $bookId = $request->book_id;
   
       foreach ($request->sequenceNumber as $sequenceNumber) {
           $fileName = $request->input('fileName.' . $sequenceNumber);
           $youtubeLink = $request->input('youtubeLink.' . $sequenceNumber);
           $audioFile = $request->file('audioFile.' . $sequenceNumber);
           $imageFile = $request->file('imageFile.' . $sequenceNumber);
   
           if ($imageFile && $imageFile->isValid()) {
               // Save the original image
               $newImageFileName = time() . '_' . $fileName . '.png';
               $imageFile->move(public_path('uploads/' . $companyName), $newImageFileName);
   
               // Optimize the image
               ImageOptimizer::optimize(public_path('uploads/' . $companyName . '/' . $newImageFileName));
   
               // Convert to WebP
               $webpImageFileName = time() . '_' . $fileName . '.webp';
               $sourceImagePath = public_path('uploads/' . $companyName . '/' . $newImageFileName);
               $webpImagePath = public_path('uploads/' . $companyName . '/' . $webpImageFileName);
   
               // Convert PNG to WebP
               $image = ImageCow::fromFile($sourceImagePath);
               $image->format('webp')->quality(40)->save($webpImagePath); // Adjust quality here (40%)
   
               // Remove the original image
               unlink($sourceImagePath);
   
               $newAudioFileName = null;
   
               if ($audioFile && $audioFile->isValid()) {
                   $newAudioFileName = time() . '_' . $fileName . '.' . $audioFile->getClientOriginalExtension();
                   $audioFile->move(public_path('uploads/' . $companyName), $newAudioFileName);
               }
               //check the last sequence if $exist
               $updatedsequence = $sequenceNumber;


              $seq =   InnerPageModel::where('book_id',$bookId)->orderby('sequence','desc')->first();

             if(!empty($seq)){
               $updatedsequence =  $seq->sequence+1;
             }
   
           
               InnerPageModel::insert( [
                  'sequence' => $updatedsequence,
                  'title' => $fileName,
                  'book_id' => $bookId,
                  'youtube_link' => $youtubeLink,
                  'audio_file' => $newAudioFileName ? 'uploads/' . $companyName . '/' . $newAudioFileName : null,
                  'inner_image' => 'uploads/' . $companyName . '/' . $webpImageFileName,
                  'add_by' => Auth::user()->id,
                  'book_id' => $request->book_id, // Consider removing this line, as it seems redundant.
                  'created_at' => now(),
              ]);

           } else {
               return response()->json(['error' => 'Invalid image file.'], 400);
           }
       }
   
   
       return response()->json(['message' => 'Data has been stored successfully.'], 200);
   }
   public function pagedit(Request $request)
   {

      return $this->bookInterface->pagedit($request->id);
   }
   public function addnew(Request $request)
   {
      return $this->bookInterface->addnew($request->id);
   }
   public function updateinnerpage(Request $request)
   {
       $role = Auth::user()->role;
       $companyname = Auth::user()->company_name;
   
       if ($role == 'manager') {
           // get the company name 
           $getcompanyname = User::getcompanyname(Auth::user()->company_id);
           $companyname = $getcompanyname->company_name;
       }
   
       $data['youtube_link'] = $request->youtube_link ?? '';
       $data['title'] = $request->title ?? '';
   
       // Handle inner_image
       if ($request->hasFile('inner_image')) {
           $imageFile = $request->file('inner_image');
           $newImageFileName = time() . '_' . pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME) . '.webp';
           
           // Compress and convert to WebP
           $sourceImagePath = $imageFile->getRealPath();
           $webpImagePath = public_path('uploads/' . $companyname . '/' . $newImageFileName);
           $image = ImageCow::fromFile($sourceImagePath);
           $image->resize(800, 600)->format('webp')->save($webpImagePath); // Adjust size if necessary
   
           $data['inner_image'] = 'uploads/' . $companyname . '/' . $newImageFileName;
       }
   
       // Handle audio_link
       if ($request->hasFile('audio_link')) {
           $audioFile = $request->file('audio_link');
           $newAudioFileName = time() . '_' . $audioFile->getClientOriginalExtension();
           $audioFile->move(public_path('uploads/' . $companyname), $newAudioFileName);
           $data['audio_file'] = 'uploads/' . $companyname . '/' . $newAudioFileName;
       }
   
       $query = innerPageModel::where('id', $request->id)->update($data);
       
       if ($query) {
           return response()->json(['code' => 200, 'message' => 'Inner Page Edit successfully!']);
       } else {
           return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
       }
   }
   public function updateinnerpagestore(Request $request)
   {
       $getcurrentsequence = innerPageModel::where('id', $request->id)->first(); 
   
       $data['sequence'] = $sequencecount = $getcurrentsequence->sequence ?? '';
       $data['book_id'] = $getcurrentsequence->book_id;
       $data['add_by'] = Auth::user()->id;
   
       // get other pages
       $getotherpages = innerPageModel::where('book_id', $getcurrentsequence->book_id)
           ->where('sequence', '>=', $sequencecount)
           ->orderBy('sequence', 'asc')
           ->get();
   
       if (!$getotherpages->isEmpty()) {
           foreach ($getotherpages as $listing) {
               innerPageModel::where('id', $listing->id)->update(['sequence' => $sequencecount + 1]);
               $sequencecount++;
           }
       }
   
       $role = Auth::user()->role;
       $companyname = Auth::user()->company_name;
   
       if ($role == 'manager') {
           // get the company name 
           $getcompanyname = User::getcompanyname(Auth::user()->company_id);
           $companyname = $getcompanyname->company_name;
       }
   
       $data['youtube_link'] = $request->youtube_link ?? '';
       $data['title'] = $request->title ?? '';
   
       if ($request->has('inner_image')) {
           $imageFile = $request->file('inner_image');
           $newImageFileName = time() . '_' . pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME) . '.webp';
           
           // Compress and convert to WebP
           $sourceImagePath = $imageFile->getRealPath();
           $webpImagePath = public_path('uploads/' . $companyname . '/' . $newImageFileName);
           $image = ImageCow::fromFile($sourceImagePath);
           $image->resize(800, 600)->format('webp')->save($webpImagePath); // Adjust size if necessary
   
           $data['inner_image'] = 'uploads/' . $companyname . '/' . $newImageFileName;
       }
   
       if ($request->has('audio_link')) {
           $audioFile = $request->file('audio_link');
           $newAudioFileName = time() . '_' . $audioFile->getClientOriginalExtension();
           $audioFile->move(public_path('uploads/' . $companyname), $newAudioFileName);
           $data['audio_file'] = 'uploads/' . $companyname . '/' . $newAudioFileName;
       }
   
       $query = innerPageModel::insert($data);
   
       if ($query) {
           return response()->json(['code' => 200, 'message' => 'Inner Page Added successfully!']);
       } else {
           return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
       }
   }
   public function notify(){
      return $this->bookInterface->notify();
 
   
   }
   public function move(Request $request){
      return $this->bookInterface->move($request->all());

   
   }
}
