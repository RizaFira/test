<?php

namespace App\Http\Controllers;

use App\Helpers\Bot;
use App\Models\User;
use App\Models\Events;
use App\Helpers\MyDate;
use Silvanix\Wablas\Send;
use Silvanix\Wablas\Message;
use App\Helpers\ImageTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {

        return view('welcome');
//         $curl = curl_init();
// $token = "2bIs2sJSjTd1F4JHvrvvFwwXkft2A3UmbcTQPrYljJydXzuNntl6Dp5xJmI6kP9w";
// $phone = "6281229889541";
// $message = "⚠ hello ⚠";
// curl_setopt($curl, CURLOPT_URL, "https://solo.wablas.com/api/send-message?phone=$phone&message=$message&token=$token");
// $result = curl_exec($curl);
// curl_close($curl);
// echo "<pre>";

// print_r($result);

//         $send = new Message();
//         $phones ='085867765107';
//         $message = '⚠ hello ⚠';

//         $send_text = $send->single_text($phones,$message);
//         dd($send_text);
    }

    public function store(Request $request)
    {
        $phones = $request->phones;
        $caption = $request->caption;
        $file = $request->file('file');
        $send = new Message();
        $test = $send->local_file($file,$phones,$phones);
        return$test;
    }

    public function store2(Request $request)
    {
        $token = "2bIs2sJSjTd1F4JHvrvvFwwXkft2A3UmbcTQPrYljJydXzuNntl6Dp5xJmI6kP9w";
        $filename = $_FILES['upload_file']['tmp_name'];
        $handle = fopen($filename, "r");
        $file = fread($handle, filesize($filename));

        $params = [
            'phone' => $request->phone,
            'caption' => $request->caption, // can be null
            'file' => base64_encode($file),
            'data' => json_encode($_FILES['upload_file'])
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [ "Authorization: $token" ] );
        curl_setopt($curl, CURLOPT_URL, "https://solo.wablas.com/api/send-image-from-local");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        return $result;
    }

    public function test()
    {
        $user = User::get();
        foreach ($user as $us) {
           $data[] =  [
                'name' => $us->name,
                'email' => $us->email,
                'phone' => $us->phone
           ];
        }
        return response()->json(
            $data,
        );
    }

    public function hook()
    {
        $content = json_decode(file_get_contents('php://input'), true);
        // $group = '120363045069592672';

        $message = $content['message'];
        $phone = $content['phone'];
        $block = array('6281393961320','6281317765101','6281293488636','6282260000751');
        if(in_array($phone,$block))
        {
            return null;
        }
        $pushName = $content['pushName'];
        $isGroup = $content['isGroup'];
        if($isGroup != 'false'){
            $exp = explode('<~ ',$message);
            if(isset($exp[1]))
            {
                $message = $exp[1];
            }
            $cek = explode('#',$message);
            if(isset($cek[1]))
            {
                $message = $cek[1];
            }

            $response = self::carik($phone,$message);
            return $response;
        }


        // $device = $content['deviceId'];

        // if ($isGroup == true)
        // {
        //     if($phone!=$group)
        //     {
        //         return null;
        //     }

        //     $cek = explode('#',$message);
        //     if(isset($cek[1])){
        //         $phone = $cek[0];
        //         $message = explode('<~',$cek[1]);
        //         self::to_costumer($phone,$pushName,trim($message[1]));
        //         return null;
        //     }
        //     return null;
        // }

        // if( Redis::exists("$device-$phone"))
        // {
        //     self::to_group($phone,$message,$pushName,true);
        //     return null;
        // }

        // Redis::set("$device-$phone", $phone);
        // Redis::expire("$device-$phone",10);
        // self::to_group($phone,$message,$pushName,"$device-$phone");
        // self::to_group($phone,$message,$pushName,"$device-$phone",true);
        // return null;
    }

    public function testAi()
    {
        $content = json_decode(file_get_contents('php://input'), true);

        $isGroup = $content['isGroup'];
        if ($isGroup == true) {
         return null;
        }
        $text = $content['message'];
        $data = array(
            "prompt" => sprintf($text),
            "model" => "text-davinci-001",
            "temperature" => 0.9,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            'max_tokens' => 600,
        );
        $header = [
                "Authorization" => "Bearer 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",
                "Content-Type" => "application/json"
        ];
        $url ='https://api.openai.com/v1/completions';
        $response = Http::withHeaders($header)->post($url, $data);
        $response_data = $response->json();
        return $response_data['choices'][0]['text'];

    }

    public function hook2()
    {
        $content = json_decode(file_get_contents('php://input'), true);
        $message = $content['message'];
        $phone = $content['phone'];
        $pushName = $content['pushName'];
        $isGroup = $content['isGroup'];
        $exp = explode('<~ ',$message);
        if(isset($exp[1]))
        {
            $message = $exp[1];
        }
        $cek = explode('#',$message);
        if(isset($cek[1]))
        {
            $message = $cek[1];
        }

        self::list_message($phone);
            // $response = self::carik($phone,$message);
            // return $response;
    }

    function list_message($phone)
    {
        $curl = curl_init();
        $token = "xdWoZFSOGvcZMNbxx3JzfxXvZtWymoURElElfvdkKQA6aYOswB7FJFIqOVNbwnR3";
        $payload = [
        "data" => [
            [
                'phone' => $phone,
                'message'=> [
                    'title' => 'title',
                    'description' => 'Test',
                    'buttonText' => 'menu',
                    'lists' => [
                        [
                            'title' => '1',
                            'description' => 'promo 1',
                        ],
                        [
                            'title' => '2',
                            'description' => 'promo 2',
                        ],
                    ],
                    'footer' => 'footer template here',
                ],
                'isGroup' => false
            ]
        ]
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
        curl_setopt($curl, CURLOPT_URL,  "https://solo.wablas.com/api/v2/send-list");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);

    }

    public static function testCarik($text){
        $url ='https://public-nlp.carik.id/v1/';

        $data = [
            "message"=>[
                "message_id"=>0,
                "chat"=>["id"=>0],
                "text"=>"$text"
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url,$data);

        $json_data = $response->json();

        return $json_data;
    }

    public static function location($phone,$loc,$id,$lat,$long)
    {
        $data = [
            [
                'phone' => $phone,
                'message' => [
                    'name' => $loc,
                    'address' => $id,
                    'latitude' => $lat,
                    'longitude' => $long,
                ]
            ]
        ];
        $payload = [ 'data'=> $data];
        $url = 'https://md2.wablas.com/api/v2/send-location';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=> env('TOKEN')
        ])->post($url,$payload);
        $json_data = $response->json();

        return $json_data;
    }

    public static function to_group($phone,$message,$pushName,$code,$exist=null)
    {
        $group = '120363045069592672';
        $url ='https://solo.wablas.com/api/v2/send-template';

        // $data = [
        //     [
        //         'phone' => $group,
        //         'message'=> [
        //             'title' => [
        //                 'type' => 'text',
        //                 'content' => "Costumer : $phone",
        //             ],
        //             'buttons' => [
        //                 'url' => [
        //                     'display' => 'Redirect to Costumer',
        //                     'link' => "https://wa.me/$phone",
        //                 ],
        //                 'quickReply' => ["Ambil Ticket - Some Code"],
        //             ],
        //             'content' => "Message : \n\"$message\"",
        //             'footer' => "Name : $pushName",
        //         ],

        //         'isGroup' => true,
        //         'priority' => 'high'
        //     ]
        // ];

        $data = [
            [
                'phone' => $group,
                'message'=> [
                    'title' => [
                        'type' => 'text',
                        'content' => "Costumer : $phone",
                    ],
                    'buttons' => [
                        // 'url' => [
                        //     'display' => 'Redirect to Costumer',
                        //     'link' => "https://wa.me/$phone",
                        // ],
                        'quickReply' => ["Ticket - $code"],
                    ],
                    'content' => "Silahkan Ambil Tiket",
                ],

                'isGroup' => true,
                'priority' => 'high'
            ]
        ];

        if($exist === true)
        {
            $data = [
                [
                    'phone' => $group,
                    'message'=> "$phone#$pushName\n\n$message",
                    'isGroup' => true,
                    'priority' => 'high'
                ]
            ];

            $url ='https://solo.wablas.com/api/v2/send-message';
        }

        $payload = [ 'data'=> $data];
        $token = '2bIs2sJSjTd1F4JHvrvvFwwXkft2A3UmbcTQPrYljJydXzuNntl6Dp5xJmI6kP9w';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=> $token
        ])->post($url,$payload);
        $json_data = $response->json();

        return $json_data;
    }


    public static function to_costumer($phone,$pushName,$message)
    {
        $url ='https://solo.wablas.com/api/v2/send-template';
        $data = [
            [
                'phone' => $phone,
                'message'=> [
                    'content' => $message,
                    'footer' => "CS : $pushName",
                ],

                'isGroup' => false,
                'priority' => 'high'
            ]
        ];

        $payload = [ 'data'=> $data];
        $token = '2bIs2sJSjTd1F4JHvrvvFwwXkft2A3UmbcTQPrYljJydXzuNntl6Dp5xJmI6kP9w';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=> $token
        ])->post($url,$payload);
        $json_data = $response->json();

        return $json_data;
    }

    public function klinik()
    {
        $content = json_decode(file_get_contents('php://input'), true);
        $message = $content['message'];
        $phone = $content['phone'];
        $pushName = $content['pushName'];
        $isGroup = $content['isGroup'];
        if($isGroup == true){
            return null;
        }
        $payload = $this->poli();

        return response()->json(['data'=>$payload])->header('Content-Type','application/json');
    }

    public static function poli()
    {
        $data = [
            'title' => 'Header',
            'description' => 'Alamat berhasil di simpan, silahkan pilih poli yang dituju' ,
            'buttonText' => 'pilih poli',
            'lists' => [
                ['title'=>'Poliklinik penyakit dalam'],
                ['title' => 'Poliklinik anak'],
                ['title' => 'Poliklinik kandungan'],
                ['title' => 'Poliklinik bedah umum'],
                ['title' => 'Poliklinik orthopedi'],
                ['title' => 'Poliklinik jantung'],
                ['title' => 'Poliklinik saraf'],
                ['title' => 'Poliklinik THT'],
                ['title' => 'Poliklinik Mata'],
                ['title' => 'Poliklinik Paru'],
                ['title' => 'Poliklinik gigi'],
                ['title' => 'Fisioterapi'],
            ]
        ];

        $payload[] = [
            'category' => 'list',
            'message' =>json_encode($data)
        ];

        return $payload;
    }

}
