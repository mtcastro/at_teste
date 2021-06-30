<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Consulta;

class newNotificacaoRetornoUrl extends Mailable
{
    use Queueable, SerializesModels;
    private $consulta;
    private $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Consulta $consulta, string $email)
    {
       $this->consulta = $consulta;
       $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $this->subject('Url Voltou ao funcionar');
        $this->to($this->email);
        return $this->markdown('mail.newNotificacaoRetornoUrl',[
            'consulta' => $this->consulta
        ]);
    }
}
