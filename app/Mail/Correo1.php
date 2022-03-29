<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\pdfcontroller;
use Illuminate\Support\Facades\Session;

class Correo1 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void 
     */
    public function __construct(Request $request)
    {
        $this->lat= $request->get('lat'); 
        $this->lng=$request->get('lng');
        $this->ciudad= $request->get('ciudad');
        $this->estado=$request->get('estado');
        $this->correo=$request->get('correo');
        $this->cotizante=$request->get('cotizante');
        $this->ndirec=$request->get('ndirec');
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$pdf1= app(pdfcontroller::class)->crearpdf2($this->lat,$this->lng, $this->ciudad, $this->estado);
        $a = new pdfcontroller;
        $a->imgd();
        $a1 =$a->crearpdf1($this->lat,$this->lng, $this->ciudad, $this->estado, $this->ndirec);
        $a2 =$a->crearpdf2($this->lat,$this->lng, $this->ciudad, $this->estado, $this->ndirec);
        
        session::put('pdf1',$a1);
        session::put('pdf2',$a2);
       
        $cliente=$this->cotizante;
        return $this->from('edu.vargas.herr@gmail.com', env('MAIL_FROM_ADDRESS'))
        ->view('correos.correo',compact('cliente'))
        ->subject('prueba')
        ->attach(storage_path($a1))
        ->attach(storage_path($a2));
    }

   
    

    
}
