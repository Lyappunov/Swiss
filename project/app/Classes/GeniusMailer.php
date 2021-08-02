<?php
/**
 * Created by PhpStorm.
 * User: ShaOn
 * Date: 11/29/2018
 * Time: 12:49 AM
 */

namespace App\Classes;

use App\Models\EmailTemplate;
use App\Models\Generalsetting;
use App\Models\Order;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Config;

class GeniusMailer
{

    public function __construct()
    {
        $gs = Generalsetting::findOrFail(1);
        Config::set('mail.driver', $gs->mail_engine);
        Config::set('mail.host', $gs->smtp_host);
        Config::set('mail.port', $gs->smtp_port);
        Config::set('mail.encryption', $gs->email_encryption);
        Config::set('mail.username', $gs->smtp_user);
        Config::set('mail.password', $gs->smtp_pass);
    }

    public function sendAutoOrderMail(array $mailData,$id)
    {
        $setup = Generalsetting::find(1);
        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();

        $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
        $body = preg_replace("/{order_amount}/", $mailData['oamount'] ,$body);
        $body = preg_replace("/{admin_name}/", $mailData['aname'] ,$body);
        $body = preg_replace("/{admin_email}/", $mailData['aemail'] ,$body);
        $body = preg_replace("/{order_number}/", $mailData['onumber'] ,$body);
        $body = preg_replace("/{website_title}/", $setup->title ,$body);

        $data = [
            'email_body' => $body
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $temp->email_subject;

        try{
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo,$id) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
                $order = Order::findOrFail($id);
                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
                $fileName = public_path('assets/temp_files/').str_random(4).time().'.pdf';
                $pdf = PDF::loadView('print.order', compact('order', 'cart'))->save($fileName);
                $message->attach($fileName);
            });

        }
        catch (\Exception $e){
             //die($e->getMessage());
        }

        $files = glob('assets/temp_files/*'); //get all file names
        foreach($files as $file){
            if(is_file($file))
            unlink($file); //delete file
        }
    }

    public function sendAutoMail(array $mailData)
    {
        $setup = Generalsetting::find(1);

        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();
        $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
        $body = preg_replace("/{order_amount}/", $mailData['oamount'] ,$body);
        $body = preg_replace("/{admin_name}/", $mailData['aname'] ,$body);
        $body = preg_replace("/{admin_email}/", $mailData['aemail'] ,$body);
        $body = preg_replace("/{order_number}/", $mailData['onumber'] ,$body);
        if (!empty($mailData['damount'])) {
            $body = preg_replace("/{deposit_amount}/", $mailData['damount'] ,$body);
          }
          if (!empty($mailData['wbalance'])) {
            $body = preg_replace("/{wallet_balance}/", $mailData['wbalance'] ,$body);
          }
        $body = preg_replace("/{website_title}/", $setup->title ,$body);

        $data = [
            'email_body' => $body
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $temp->email_subject;

        try{
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        }
        catch (\Exception $e){
            // die($e->getMessage());
        }
    }

    public function sendCustomMail(array $mailData)
    {
        
        $setup = Generalsetting::find(1);

        $data = [
            'email_body' => $mailData['body'],
            'storage_id' => $mailData['storage_id'],
            // 'location' => $mailData['location'],
            'size' => $mailData['size'],
            'brand' => $mailData['brand'],
            'reg_date' => $mailData['reg_date'],
            'qty' => $mailData['qty'],
            // 'mng' => $mailData['mng'],
            'is_rim' => $mailData['is_rim'],
            'weather' => $mailData['weather'],
            'cname' => $mailData['cname'],
            'number_plate' => $mailData['number_plate'],

        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $mailData['subject'];
        Log::Info("to:".$objDemo->to);
        try{
            
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                
                $message->from($objDemo->from,$objDemo->title);
                
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
            if(count(Mail::failures()) > 0 ){
                foreach(Mail::failures() as $email_address){
                    Log::Info($email_address);
                }
            }
            else
                Log::Info("Email Sent Successfully to :".$objDemo->to);
        }
        catch (\Exception $e){
            Log::Info($e->getMessage());
            //  die($e->getMessage());
            //  return $e->getMessage();
        }
        return true;
    }

    public function sendPickedMail(array $mailData)
    {
        
        $setup = Generalsetting::find(1);

        $data = [
            'email_body' => $mailData['body'],
            'cname' => $mailData['cname'],
            'number_plate' => $mailData['number_plate'],
            'car_make' => $mailData['car_make'],
            'storage_ID'=>$mailData['storage_ID'],
            'tire_size'=>$mailData['tire_size'],
            'tire_brand'=>$mailData['tire_brand'],
            'reg_date'=>$mailData['reg_date'],
            'qty'=>$mailData['qty'],
            'is_rim'=>$mailData['is_rim'],
            'weather'=>$mailData['weather'],
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $mailData['subject'];
        Log::Info("to:".$objDemo->to);
        try{
            
            Mail::send('admin.email.pickedmailbody',$data, function ($message) use ($objDemo) {
                
                $message->from($objDemo->from,$objDemo->title);
                
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
            if(count(Mail::failures()) > 0 ){
                foreach(Mail::failures() as $email_address){
                    Log::Info($email_address);
                }
            }
            else
                Log::Info("Email Sent Successfully to :".$objDemo->to);
        }
        catch (\Exception $e){
            Log::Info($e->getMessage());
            //  die($e->getMessage());
            //  return $e->getMessage();
        }
        return true;
    }



}