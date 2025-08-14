<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use App\Http\Requests\BannerRequest;
use App\Repositories\Banner\BannerInterface;

use Illuminate\Http\Request;

class BannerModelController extends Controller
{
    protected $sourceRepository;
    public function __construct(BannerInterface $sourceRepository)
    {
        $this->sourceRepository  = $sourceRepository;
    }
    public function index(Request $request)
    {
        return $this->sourceRepository->index();
    }
    public function create()
    {
        return $this->sourceRepository->create();
    }
    public function store(Request $request)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'image' => 'required', // Ensure the image is required and valid
    ]);

    // If the image is valid, store it
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        // Generate a unique name for the image
        $imageName = time() . '_' . $validatedData['image']->getClientOriginalName();

        // Move the image to the 'banners' folder
        $validatedData['image']->move(public_path('banners'), $imageName);

        // Save the image path to the 'image' field
        $imagePath = 'banners/' . $imageName;
        $savedata['image'] = $imagePath;
    } else {
        return response()->json(['code' => 400, 'message' => 'Invalid Image']);
    }

    // Save other fields to $savedata array
    // $savedata['source'] = $validatedData['source'];

    // Update the BannerModel record
    $query = BannerModel::insert($savedata);

    // Check if the update was successful
    if ($query) {
        return response()->json(['code' => 200, 'message' => 'Banner has been Created successfully!']);
    } else {
        return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
    }
}

    public function delete(Request $request)
    {
        return  $this->sourceRepository->delete($request);
    }


    public function edit(Request $request)
    {
        
        return  $this->sourceRepository->edit($request->id);
    }


    public function update(Request $request)
    {

          $validatedData = $request->validate([
        'image' => 'required', // Ensure the image is required and valid
    ]);


    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        // Generate a unique name for the image
        $imageName = time() . '_' . $validatedData['image']->getClientOriginalName();

        // Move the image to the 'banners' folder
        $validatedData['image']->move(public_path('banners'), $imageName);

        // Save the image path to the 'image' field
        $imagePath = 'banners/' . $imageName;
        $savedata['image'] = $imagePath;
    } else {
        return response()->json(['code' => 400, 'message' => 'Invalid Image']);
    }

    // Save other fields to $savedata array
    // $savedata['source'] = $validatedData['source'];

    // Update the BannerModel record
    $query = BannerModel::where('id',$request->id)->update($savedata);

    // Check if the update was successful
    if ($query) {
        return response()->json(['code' => 200, 'message' => 'Banner has been Created successfully!']);
    } else {
        return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
    }

        return  $this->sourceRepository->update($data);
    }
}
