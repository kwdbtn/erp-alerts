<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class MessageController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Message $message) {
        return view('messages.form', compact('message'));
    }

    public function get_bulksms() {
        return view('messages.bulksms');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request) {
        $key       = env('SMS_API_KEY'); //your unique API key;
        $message   = urlencode($request->body); //encode url;
        $phone     = $request->phone;
        $sender_id = $request->sender_id;

        $this->sendMessageX($key, $message, $phone, $sender_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function bulksms() {
        $key = env('SMS_API_KEY'); //your unique API key;
        // $phone     = $request->phone;
        $phone = "0244980443";
        // $sender_id = $request->sender_id;
        $sender_id = "GRIDSol";

        $reader      = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load("C:\\Users\\Kay\\Desktop\\test.xlsx");
        $sheetData   = $spreadsheet->getActiveSheet()->toArray();
        $sheet       = $spreadsheet->getActiveSheet();
        $output      = "";
        // $i = 1;

        // unset($sheetData[0]);

        for ($i = 1; $i < count($sheetData); $i++) {
            $sentStatus = $sheetData[$i][1];
            // dd($sentStatus);
            if ($sentStatus === FALSE) {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

                // get message
                $message = $sheetData[$i][0];

                //send sms
                $output = $this->sendMessageX($key, $message, $phone, $sender_id);

                // for some reason, the index has to be increased before the right cell is updated
                $x = $i + 1;

                // update cell when message is sent
                $sheet->setCellValue("B{$x}", TRUE);

                // save excel file after update
                $writer->save("C:\\Users\\Kay\\Desktop\\test.xlsx");

            } else {
                $output = "All messages sent!";
            }
        }
        return $output;
    }

    public function sendMessageX($key, $messagex, $phone, $sender_id) {
        // process element here;
        $message = urlencode($messagex); //encode url;

        // API URL FOR SENDING MESSAGES
        $url = "http://clientlogin.bulksmsgh.com/smsapi?key=$key&to=$phone&msg=$message&sender_id=$sender_id";

        $result = file_get_contents($url); //call url and store result;
        $output = "";

        switch ($result) {
        case "1000":
            $output = "Message sent";
            break;
        case "1002":
            $output = "Message not sent";
            break;
        case "1003":
            $output = "You don't have enough balance";
            break;
        case "1004":
            $output = "Invalid API Key";
            break;
        case "1005":
            $output = "Phone number not valid";
            break;
        case "1006":
            $output = "Invalid Sender ID";
            break;
        case "1008":
            $output = "Empty message";
            break;
        }

        return $output;
    }

//     public function codeFromStore() {
    //         /*******************API URL FOR SENDING MESSAGES********/
    // $url = "http://clientlogin.bulksmsgh.com/smsapi?key=$key&to=$phone&msg=$message&sender_id=$sender_id";

// /****************API URL TO CHECK BALANCE****************/
    // // $url = "http://clientlogin.bulksmsgh.com/api/smsapibalance?key=$key";

// $result = file_get_contents($url); //call url and store result;
    // $output = "";

// switch ($result) {
    // case "1000":
    //     $output = "Message sent";
    //     break;
    // case "1002":
    //     $output = "Message not sent";
    //     break;
    // case "1003":
    //     $output = "You don't have enough balance";
    //     break;
    // case "1004":
    //     $output = "Invalid API Key";
    //     break;
    // case "1005":
    //     $output = "Phone number not valid";
    //     break;
    // case "1006":
    //     $output = "Invalid Sender ID";
    //     break;
    // case "1008":
    //     $output = "Empty message";
    //     break;
    // }

// return $output;
    //     }
}
