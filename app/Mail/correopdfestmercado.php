<?php

namespace App\Mail;
 
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\pdfcontroller;
use App\Http\Controllers\correopdfController;
use Illuminate\Support\Facades\Session;

use App\modelos\proyectos;

class correopdfestmercado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance. 
     *
     * @return void
     */
    public function __construct($lat,$lng, $ndir,  $ciudad, $estado, $coti,  $mapacalor)
    {
        
        $this->lat=$lat;
        $this->lng=$lng;
        $this->ndir=$ndir;
        $this->ciudad=$ciudad;
        $this->estado=$estado; 
        $this->coti=$coti;
        $this->mapacalor=$mapacalor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
         
        $cliente=$this->coti;
        $controllador = new correopdfController; 
        $pdf =$controllador->pdfestudiomercado($this->lat, $this->lng, $this->ndir, $this->ciudad, $this->estado, $this->mapacalor);
        session::put('pdf',$pdf);
        return $this->from('edu.vargas.herr@gmail.com', env('MAIL_FROM_ADDRESS'))
        ->view('correos.correo',compact('cliente'))
        ->subject('prueba')
        ->attach(storage_path($pdf)); 
    }
}
