<?php

namespace App\Chat\Management\Commands\Email;

use App\Chat\Support\Clean\ToClean;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



class SendToEmailMessages
{
    use ToClean;

    public $message = null;
    public $message_arr = null;
    public $info = null;
    public $method = 'local';

//    public $text_cipher = '--text=';
    public $subject_cipher = '--subject=';

    public $email = [];
    public $text = null;
    public $subject = null;
    public $bcc_cc = false;

    public $fun_arr = [
        'email send' => 'sendMessage',
    ];


    public function establish($str, $arr, $info, $mt)
    {
        $this->redistribution($str, $arr, $info, $mt);
        $this->getCost();

        foreach ($this->fun_arr as $fun_key => $fun_val)
        {
            if (Str::contains($this->message, $fun_key)) return $this->$fun_val();
        }
        return true;
    }


    /**
     * @param $message
     * @param $message_arr
     * @param $info
     * @param $method
     */
    public function redistribution($message, $message_arr, $info, $method)
    {
        $this->message = $message;
        $this->message_arr = $message_arr;
        $this->info = $info;
        $this->method = $method;
    }


    /**
     * @return bool|mixed
     */
    public function getCost()
    {
        $mess_arr = explode('"', $this->message);

        $em = (isset($mess_arr[1]) && !empty($mess_arr[1])) ? $mess_arr[1] : null;
        $emails = [];
        $fc = isset($em) && !empty($em) ? preg_replace('/\s+/', '', $this->full_clean($em)) : null;
        if(isset($fc) && Str::contains($em, ',')) $emails = explode(',' , $fc);

        if($emails)
        {
            foreach ($emails as $item_email)
            {
                if(!empty($item_email) && filter_var($item_email, FILTER_VALIDATE_EMAIL) && !in_array($item_email, $this->email)) $this->email[] = $item_email;
            }
        } else {
            $this->email = (!empty($em) && filter_var($this->full_clean($em), FILTER_VALIDATE_EMAIL)) ? $this->full_clean($em) : null;
        }


        foreach ($mess_arr as $mess)
        {
            switch ($mess) {
                case str_contains($mess, $this->subject_cipher):
                    $sbj_arr = explode($this->subject_cipher, $this->message) ?? [];
                    $sbj = (isset($sbj_arr[1]) && !empty($sbj_arr)) ? explode('"', $sbj_arr[1]) : null;
                    $this->subject = isset($sbj[1]) ? $this->full_clean($sbj[1]) : null;
                    break;
            }
        }

        $txt = (isset($mess_arr[3]) && !empty($mess_arr[3]) && !Str::contains($mess_arr[2], '--')) ? $mess_arr[3] : null;
        $this->text = $this->full_clean($txt) ?? null;

        if(isset($this->info['related']) && !empty($this->info['related']))
        {
            $bcc_cc = false;
            if(Str::contains($this->message, '--bcc --cc')) $bcc_cc = '--cc';
            if(Str::contains($this->message, '--cc --bcc')) $bcc_cc = '--bcc';
            if(!$bcc_cc)
            {
                foreach ($this->info['related'] as $rel)
                {
                    if(Str::contains($this->message, $rel)) $bcc_cc = $rel;
                }

            }
            if($bcc_cc) $this->bcc_cc = $bcc_cc;
        }

        return true;
    }


    /**
     * @return bool|mixed
     */
    public function sendMessage()
    {
        if (isset($this->email) && !is_null($this->email) && isset($this->method))
        {
            $data = array('email' => $this->email, 'subject' => $this->subject, 'text' => $this->text);
            $email = null;
            $name = null;
            if($this->method == 'local')
            {
                $email = Auth::user()->email ?? null;
                $name = Auth::user()->email ?? null;
            } else if($this->method == 'slack') {
                if(Session::has('SLACK_USER'))
                {
                    $email = Session::get('SLACK_USER')->profile->email ?? null;
                    $name =  Session::get('SLACK_USER')->name ?? null;
                }
            }

            if($email) {
                Mail::send('mail', $data, function($send) use($email) {
                    $send->from($email, $email);
                    if (!$this->bcc_cc)
                        $send->to($this->email, $this->email);
                    if ($this->bcc_cc && $this->bcc_cc == '--bcc')
                        $send->bcc($this->email, $this->email);
                    if ($this->bcc_cc && $this->bcc_cc == '--cc')
                        $send->cc($this->email, $this->email);
                    $send->subject($this->subject);
                });

                $this->email = $this->email && gettype($this->email) == 'array' ? implode(", ", $this->email) : $this->email;

                $blocks = [
                    "blocks" => [
                        [
                            "type" => "section",
                            "text" => [
                                "type" => "mrkdwn",
                                "text" => "<@" . $name . ">.\nThe message was sent to " . $this->email . " ."
                            ]
                        ]
                    ]
                ];


                $blocks = [
                    "attachments" => [
                        [
                            "text" => "<@" . $name . ">.\nThe message was sent to " . $this->email . " .",
                            "color" => "#3AA3E3",
                            "attachment_type" => "default",
                        ]
                    ]
                ];


                if($this->method == 'slack') return $blocks;
                return 'The message was sent to ' . $this->email . '.';
            }
            return 'Try again later.';
        }
        return 'Try again later.';
    }
}
