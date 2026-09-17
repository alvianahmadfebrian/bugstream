<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BugNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $title,
        protected string $message,
        protected string $type = 'bug',
        protected ?int $bugId = null,
        protected ?string $url = null,
        protected string $icon = 'notifications',
        protected string $badgeColor = 'primary'
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
            'bug_id' => $this->bugId,
            'url' => $this->url ?? ($this->bugId ? route('bugs.show', $this->bugId) : null),
            'icon' => $this->icon,
            'badge_color' => $this->badgeColor,
        ];
    }
}
