<?php

declare (strict_types = 1);

namespace Mail\Sender\Controllers;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Mail\Sender\Mailables\MessageMailable;

class SenderController extends Controller
{
    // use AuthorizesRequests;
    // use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('sender::message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $saved = false;

        $data = ['status' => null];

        // 1. validate message input
        $request->validate($this->getValidationRules());

        // 2. create message from input
        $mailable = $this->newMailable($request);

        // 3. attempt sending email
        if (!$mailable->message()->wasSent()) {
            try {
                // I used the log driver by default during testing
                Mail::send($mailable);
                // save to database on success
                $saved = $mailable->message()->setAttributes(['sent' => 1])->store() ? true : false;

                if ($stored = $mailable->message()->getFetch()) {
                    $data = array_merge($data, (array) $stored);
                }

                $data['status'] = $saved ? 'Success' : 'Error';

            } catch (\Exception $e) {
                // write some logs
                $data['status'] = 'Error';
            }
        } else {
            $data = $data = array_merge(
                $mailable->message()->getStored(),
                ['status' => 'Message was already sent']
            );
        }

        return response()->json($data);
    }

    /**
     * @param Request $request
     */
    public function newMailable(Request $request)
    {
        $mailable = new MessageMailable($request->input('message_content'));

        $mailable->from(
            $request->input('sender') ?: Config::get('mail.from.address')
        );

        return $mailable;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getValidationRules()
    {
        return Config::get('sender.message.rules') ?: [
            'message_content' => 'required'
        ];
    }
}
