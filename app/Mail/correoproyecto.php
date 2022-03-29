<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correoproyecto extends Mailable
{
    use Queueable, SerializesModels;

    /** 
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($red, $coti)
    {
        //
        $this->total=$red;
        $this->coti=$coti;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $total=$this->total;
        
        $cliente=$this->coti;
        return $this->from('edu.vargas.herr@gmail.com', env('MAIL_FROM_ADDRESS'))
        ->view('correos.abc',compact('cliente','total'))
        ->subject('prueba');
        
    }
}
