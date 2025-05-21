<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emailers;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class EmailerController extends Controller
{
    public function index()
    {
        $emails = Emailers::all();

        return view('admin.mail.index', compact('emails'));
    }

    public function add()
    {
        return view('admin.mail.add');
    }

    public function store(Request $request)
    {
        $values = $request->all();
        // dd($request->thumb);
        if ($request->hasFile('thumb')) {
            $newName = uniqid().'.'.$request->thumb->getClientOriginalExtension();
            $request->thumb->move(config('config.file_path'), $newName);
            $values['thumb'] = config('config.file_path').$newName;
        }
        Emailers::create($values);

        return Redirect::action([EmailerController::class, 'emailSend'], [app()->getLocale()]);
    }

    public function edit($id)
    {
        $post = Emailers::find($id);

        return view('admin.mail.edit', compact('post'));
    }

    public function Update(Request $request, $id)
    {
        $values = $request->all();
        if ($request->hasFile('thumb')) {
            $newName = uniqid().'.'.$request->thumb->getClientOriginalExtension();
            $request->thumb->move(config('config.file_path'), $newName);
            $values['thumb'] = config('config.file_path').$newName;
        }
        $files = Emailers::where('thumb', '!==', null)->get();
        foreach ($files as $file) {
            if (File::exists(config('config.image_path').$file->file)) {
                File::delete(config('config.image_path').$file->file);
            }
            if (File::exists(config('config.image_path').'thumb/'.$file->file)) {
                File::delete(config('config.image_path').'thumb/'.$file->file);
            }
            $file->delete();
        }
        Emailers::find($id)->update($values);

        return Redirect::route('admin.mailers', [app()->getLocale()]);
    }

    public function delete($id)
    {
        Emailers::find($id)->delete();

        return redirect()->back();
    }

    public function subscribers()
    {
        $subscribers = Subscription::orderBy('created_at')->get();

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function deletesubsctiber($id)
    {
        $delete = Subscription::find($id)->Delete();

        return back()->with('success');
    }

    public function emailSend()
    {
        $emails = Emailers::all();
        $subscribers = Subscription::all();
        $details = [
            'title' => 'Mails from agro',
        ];
        \Mailers::to($subscribers)->send(new \App\Mail\Mailers($details));

        return view('admin.mail.index', compact('emails'));
    }
}
