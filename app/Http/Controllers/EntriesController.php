<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateValidationRequest;

class EntriesController extends Controller
{
 
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function thankYou() {
        return view('thank-you');
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateValidationRequest $request)
    {
        try { 
        $data = $request->all();
        $data['optin'] = !empty($data['optin']) ? 1 : 0;
        Entry::create($data);
        }
        catch (Exception $ex){
            Log::error($ex->getTraceAsString());
            return [
                'status' => 'error',
                'message' => config('app.env') == 'local' ? 
                    $ex->getFile() . ' > ' . $ex->getLine() . ' > ' . $ex->getMessage() : 
                    'An error occured, please try again later.',
            ];    
        }

        return [
            'status' => 'success',
            'message' => 'Success'
        ];

     }


}
