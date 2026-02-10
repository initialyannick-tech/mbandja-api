<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Admin\Models\User;
use Modules\Ecole\Models\Ecole;

class NewEcoleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ecole;
    public $user;
    public $password;

    /**
     * Constructeur du Mailable
     */
    public function __construct(Ecole $ecole, User $user, string $password)
    {
        $this->ecole = $ecole; // garder l'objet pour accéder à toutes ses propriétés
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Construction du mail
     */
    public function build()
    {
        return $this->subject("Création de votre école : " . $this->ecole->nom)
                    ->view('emails.users.new_ecole')
                    ->with([
                        'ecole'    => $this->ecole,
                        'user'     => $this->user,
                        'password' => $this->password,
                    ]);
    }
}
