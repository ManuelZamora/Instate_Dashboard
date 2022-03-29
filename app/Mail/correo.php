<?php

namespace App\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\modelos\excelimport;
use App\modelos\empresaspro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class correo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $id;
    private $nombre;
    public function __construct($id,$nombre)
    {
        //
        $this->id=$id;
        $this->nombre=$nombre;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $date = Carbon::now();
 
        $fecha = $date->format('d-M-Y');
        $info = excelimport::where("id_proyecto", "=", $this->id)->with('proyecto.empresas')->get();
        $tamaño=0;
       foreach ($info as $key => $value) {
           $tamaño++;
       }
       if($tamaño!=0){
        $notas=$info[0]['proyecto']->nota;
        $cliente=$info[0]['proyecto']['empresas']->nombre;
        $idioma=$info[0]['proyecto']['empresas']->idioma;
        $pdf = PDF::loadView('PDF.pdf',compact('fecha','info','cliente','idioma','notas'));
        
       }
       else{
        $info = empresaspro::where("id", "=", $this->id)->with('empresas')->get();
        $cliente=$info[0]['empresas']->nombre;
        $idioma=$info[0]['empresas']->idioma;
        $notas=$info[0]->nota;
        $pdf = PDF::loadView('PDF.pdf2',compact('fecha','info','cliente','idioma','notas'));
       }
        
        $pdf->save(storage_path($this->nombre));
        
       
       
        return $this->from('edu.vargas.herr@gmail.com', env('MAIL_FROM_ADDRESS'))
        ->view('correos.correo',compact('idioma','cliente'))
        ->subject('prueba')
        ->attach(storage_path($this->nombre));
    }
}
