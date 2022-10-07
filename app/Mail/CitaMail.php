<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CitaMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $datos;
    protected $tipo_notify;
    public function __construct($tipo_notify,$datos)
    {
        $this->tipo_notify = $tipo_notify;  
        $this->datos = $datos;
         
    }

    /** 
     * Build the message. 
     *
     * @return $this
     */
    public function build()
    {   
      
        $url=config('app.url');
        if($this->tipo_notify=='nt-nuevo'){
            return $this->subject('Invitación:  para cita médica '.$this->datos['titulo'].' '.$this->datos['fecha'].' '.$this->datos['hora'])
                        ->with(['data'=>$this->datos ,'url'=>$url])
                        ->markdown('mail.cita-user-nuevo');
        }else if($this->tipo_notify=='nt-cita'){
            return $this->subject('Invitación: para cita médica  '.$this->datos['titulo'].' '.$this->datos['fecha'].' '.$this->datos['hora'])
                        ->with(['data'=>$this->datos ,'url'=>$url])
                        ->markdown('mail.cita');
        }else if($this->tipo_notify=='nt-delete'){
            return $this->subject('Evento cancelado: reunión para '.$this->datos['titulo'].' '.$this->datos['fecha'])
                        ->with(['data'=>$this->datos])
                        ->markdown('mail.cita-cancelada');
        }else if($this->tipo_notify=='nt-update'){
                return $this->subject('Invitación actualizada: para '.$this->datos['titulo'].' '.$this->datos['fecha'].' '.$this->datos['hora'])
                            ->with(['data'=>$this->datos ,'url'=>$url])
                            ->markdown('mail.cita-update');
            }else if($this->tipo_notify=='nt-cita'){
        }
       

    }
}
