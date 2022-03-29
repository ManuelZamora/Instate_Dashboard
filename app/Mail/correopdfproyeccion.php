<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Http\Controllers\correopdfController;
use Illuminate\Support\Facades\Session;

class correopdfproyeccion extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct(Request $reques, $lat,$lng, $ndir,  $ciudad, $estado, $coti)
    {
        $this->req=$reques;
        $this->lat=$lat;
        $this->lng=$lng;
        $this->ndir=$ndir;
        $this->ciudad=$ciudad;
        $this->estado=$estado; 
        $this->coti=$coti;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $request=$this->req;
        
        $cliente=$this->coti;
        $controllador = new correopdfController; 
        
        $pdf =$controllador->proyeccionpdf($request, $this->lat, $this->lng, $this->ndir, $this->ciudad, $this->estado);
        session::put('pdf',$pdf);
        
        
        return $this->from('edu.vargas.herr@gmail.com', env('MAIL_FROM_ADDRESS'))
        ->view('correos.correo',compact('cliente'))
        ->subject('prueba')
        ->attach(storage_path($pdf));

    }
}
