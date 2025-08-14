<?php

namespace App\Repositories;

use App\Models\BookModel;
use App\Models\innerPageModel;
use App\Models\NotifyMr;
use App\Models\PurchasedPlan;
use App\Models\User;
use App\Repositories\Book\BookInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BookRepository implements BookInterface
{
    public function index(): View
    {
        // if auth  login role is manager
        if (Auth::user()->role == 'manager') {
            // get the company_id
            $company_id = Auth::user()->company_id;
        }
        if (Auth::user()->role == 'company_admin') {
            $company_id = Auth::user()->id;
        }
        $data['books'] = BookModel::orderby('id', 'desc')->where('company_id', $company_id)->get();
        return   view('admin.books.list', $data);
    }
    public function create(): View
    {
        return   view('admin.books.add');
    }
    public function createpage($id): View
    {
        $data['book_id'] = $id;
        return   view('admin.books.pages.create', $data);
    }
    public function showpage($id): View
    {
        $data['innerpage'] =  innerPageModel::where('book_id', $id)->orderby('sequence')->get();
        return   view('admin.books.pages.list', $data);
    }
    public function edit($id)
    {
        $data['book'] =  BookModel::where('id', $id)->first();
        return   view('admin.books.edit', $data);
    }
    public function pagedit($id)
    {
        $data['innerpage'] =  innerPageModel::where('id', $id)->first();
        return   view('admin.books.pages.edit', $data);
    }
    public function addnew($id)
    {
        $data['innerpage'] =  innerPageModel::where('id', $id)->first();
        return   view('admin.books.pages.editnew', $data);
    }

    public function store($data)
    {
        $data1['title'] = $data['title'];
        $role  = Auth::user()->role;
        $companyname  = Auth::user()->company_name;
        $data1['company_id']  = Auth::user()->id;
        if ($role == 'manager') {
            // get the company name 
            $getcompanyname =   User::getcompanyname(Auth::user()->company_id);
            $companyname =  $getcompanyname->company_name;
            $data1['company_id']  = Auth::user()->company_id;
        }
        $data1['add_by'] =  Auth::user()->id;

        // store the bookcoverimage here
        // Store the uploaded file
        $imageName = time() . '.webp';
        $data['cover_image']->move(public_path('uploads/' . $companyname), $imageName);
        $data1['cover_image'] =  "uploads/$companyname/$imageName";


        $data1['created_at'] = now();

        $query = BookModel::insert($data1);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Book has been added succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }


    public function update($data)
    {
        $data1['title'] = $data['title'];
        $role  = Auth::user()->role;
        $companyname  = Auth::user()->company_name;
        if ($role == 'manager') {
            // get the company name 
            $getcompanyname =   User::getcompanyname(Auth::user()->company_id);
            $companyname =  $getcompanyname->company_name;
        }
        $data1['add_by'] =  Auth::user()->id;

        // store the bookcoverimage here
        // Store the uploaded file
        if ($data->has('cover_image')) {
            $imageName = time() . '.webp';
            $data['cover_image']->move(public_path('uploads/' . $companyname), $imageName);
            $data1['cover_image'] =  "uploads/$companyname/$imageName";
        }



        $data1['updated_at'] = now();

        $query = BookModel::where('id', $data['book_id'])->update($data1);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Book has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }
    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  BookModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  BookModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  BookModel::where('id', $data['id'])->delete();
        }
    }
    public  function deletepage($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  innerPageModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  innerPageModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  innerPageModel::where('id', $data['id'])->delete();
        }
    }

    public function notify()
    {
        // get mr of the company 
        $role  =  Auth::user()->role;
        if ($role == 'manager') {
            $company_id  = Auth::user()->company_id;
        }

        if ($role == 'company_admin') {
            $company_id =  Auth::user()->id;
        }


        // get mr 
        $getmrid =   PurchasedPlan::where('company_id', $company_id)->get();

        if (!empty($getmrid)) {
            foreach ($getmrid as $listing) {
                if (!empty($listing->alloted_user_id)) {
                    $checkifalreadyexist =  NotifyMr::where('mr_id', $listing->alloted_user_id)->first();
                    if (!empty($checkifalreadyexist)) {
                        NotifyMr::where('mr_id', $listing->alloted_user_id)->update(['mr_id' => $listing->alloted_user_id, 'is_notify' => 1, 'updated_at' => now()]);
                    } else {
                        NotifyMr::insert(['mr_id' => $listing->alloted_user_id, 'is_notify' => 1, 'created_at' => now()]);
                    }
                }
            }

            return  back()->with(['message' => 'All MRs have been notified!']);
        } else {
            return  back()->with(['error' => 'You have not any mr yet!']);
        }
    }

    public function move($data)
    {
        // Get the current page of the book
        $page = InnerPageModel::find($data['page_id']);

        if ($page) {
               $direction = $data['direction'];
            $currentSequence = $page->sequence;

            if ($direction == 'up') {
                // If moving up, decrease the sequence by 1 if it's not the first page
                if ($currentSequence > 1) {
                    $previousPage = InnerPageModel::where('book_id',$page->book_id)->where('sequence', $currentSequence - 1)->first();
                    if ($previousPage) {
                        $previousPage->update(['sequence' => $currentSequence]);
                        $page->update(['sequence' => $currentSequence - 1]);
                        return response()->json(['status' => 'success']);
                    }
                }
            } elseif ($direction == 'down') {
                // If moving down, increase the sequence by 1 if it's not the last page
                $nextPage = InnerPageModel::where('book_id',$page->book_id)->where('sequence', $currentSequence + 1)->first();
                if ($nextPage) {
                    $nextPage->update(['sequence' => $currentSequence]);
                    $page->update(['sequence' => $currentSequence + 1]);
                    return response()->json(['status' => 'success']);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
