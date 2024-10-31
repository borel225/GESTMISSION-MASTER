<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class MissionAdded extends Notification
{
    use Dispatchable, Queueable;

    protected $mission;

    public function __construct($mission)
    {
        //
        $this->mission = $mission;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
         // Créer un lien signé qui sera valide pendant 7 jours
         $signedUrl = URL::signedRoute('missions.show', [
            'mission' => $this->mission->id,
            'user' => $notifiable->id
        ], now()->addDays(7));

        return (new MailMessage)
            ->greeting('Bonjour ' . $notifiable->nom . ' ' . $notifiable->prenom)
            ->line('Vous avez été ajouté à une nouvelle mission : ' . $this->mission->libelle)
            ->line('Pour accéder à cette mission, veuillez cliquer sur le lien ci-dessous:')
            ->action('Voir la Mission', $signedUrl)
            ->line('Ce lien est valable pendant 7 jours.')
            ->line('Si vous n\'êtes pas connecté(e), vous serez invité(e) à vous authentifier.')
            ->line('Merci d\'avoir utilisé notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
