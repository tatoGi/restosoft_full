<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public static function subscribe(Request $request)
    {

        $email = $request->validate([
            'email' => 'required|email',

        ]);
        $subscriber = Subscription::where('email', $email)->first();
        if ($subscriber == null) {
            $subscription = new Subscription;
            $subscription->locale = app()->getLocale();
            $subscription->email = $email['email'];

            $subscription->save();

            return redirect()->back()->with([
                'subscribe' => trans('website.successfuly_subscribed'),
            ]);

        } else {
            $subscriber !== null;

            return redirect()->back()->with([
                'subscribe' => trans('website.allready_subscribed'),
            ]);

        }

    }

    public static function submission(Request $request)
    {
        $values = request()->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',

        ]);
        if (isset($values['file']) && ($values['file'] != null)) {
            $newfileName = uniqid().'.'.$values['file']->getClientOriginalExtension();
            $orignalName = $values['file']->getClientoriginalname();
            $values['file']->move(config('config.file_path'), $newfileName);
            $values['file'] = '';
            $values['file'] = $newfileName;
            $values['filename'] = $orignalName;

        }
        $values['additional'] = getAdditional($values, config('submissionAttr.additional'));
        $submission = Submission::create($values);

        return redirect()->back()->with([
            'message' => trans('website.submission_sent'),
        ]);

    }
}
