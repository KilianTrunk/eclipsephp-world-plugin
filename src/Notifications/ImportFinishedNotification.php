<?php

namespace Eclipse\World\Notifications;

use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ImportFinishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $status;

    protected string $importType;

    protected ?string $identifier;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $status, string $importType, ?string $identifier = null, string $locale = 'en')
    {
        $this->status = $status;
        $this->importType = $importType;
        $this->identifier = $identifier;
        $this->locale = $locale;
    }

    /**
     * Channels: database only
     */
    public function via(): array
    {
        return ['database'];
    }

    /**
     * For storing in DB
     */
    public function toDatabase($notifiable): array
    {
        $title = $this->getTitle();
        $body = $this->getBody();
        $icon = $this->status === 'success' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle';
        $iconColor = $this->status === 'success' ? 'success' : 'danger';
    
        $notification = FilamentNotification::make()
            ->title($title)
            ->body($body)
            ->icon($icon)
            ->iconColor($iconColor);
    
        $notification->broadcast($notifiable);
    
        return $notification->getDatabaseMessage();
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'status' => $this->status,
            'importType' => $this->importType,
            'identifier' => $this->identifier,
        ];
    }

    /**
     * Generate title based on import type and status using the locale
     */
    private function getTitle(): string
    {
        $translationKey = "eclipse-world::{$this->importType}.notifications.{$this->status}.title";
        $title = __($translationKey, [], $this->locale);

        // Fallback to English if locale translation is missing
        if ($title === $translationKey) {
            $title = __($translationKey, [], 'en');
        }

        return $title;
    }

    /**
     * Generate body message based on import details using the locale
     */
    private function getBody(): string
    {
        $translationKey = "eclipse-world::{$this->importType}.notifications.{$this->status}.message";

        $parameters = [];
        if ($this->identifier) {
            if ($this->importType === 'posts') {
                $countryKey = "eclipse-world::posts.import.countries.{$this->identifier}";
                $countryName = __($countryKey, [], $this->locale);

                // Fallback to English if locale translation is missing
                if ($countryName === $countryKey) {
                    $countryName = __($countryKey, [], 'en');
                }

                // Final fallback to identifier itself (country code, e.g. SI)
                if ($countryName === $countryKey) {
                    $countryName = $this->identifier;
                }

                $parameters['country'] = $countryName;
            } else {
                $parameters['country'] = $this->identifier;
            }
        }

        $body = __($translationKey, $parameters, $this->locale);

        // Fallback to English if locale translation is missing
        if ($body === $translationKey) {
            $body = __($translationKey, $parameters, 'en');
        }

        return $body;
    }
}
