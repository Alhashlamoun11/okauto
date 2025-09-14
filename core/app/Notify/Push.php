<?php

namespace App\Notify;

use App\Notify\NotifyProcess;
use App\Notify\Notifiable;
use Illuminate\Support\Facades\Log;

class Push extends NotifyProcess implements Notifiable
{
    /**
    * Device Id of receiver
    *
    * @var array
    */
    public $deviceId;

    public $redirectUrl;

    public $pushImage;

    /**
    * Assign value to properties
    *
    * @return void
    */
    public function __construct()
    {
        $this->statusField = 'push_status';
        $this->body = 'push_body';
        $this->globalTemplate = 'push_template';
        $this->notifyConfig = 'firebase_config';
        
        Log::debug('Push notification instance created', [
            'statusField' => $this->statusField,
            'body' => $this->body,
            'template' => $this->globalTemplate,
            'config' => $this->notifyConfig
        ]);
    }

    public function redirectForApp($getTemplateName)
    {
        $screens = [
            // Add your screen mappings here
        ];

        foreach ($screens as $screen => $array) {
            if (in_array($getTemplateName, $array)) {
                Log::debug("Redirecting to screen: $screen for template: $getTemplateName");
                return $screen;
            }
        }

        Log::debug("No specific screen found for template: $getTemplateName, defaulting to HOME");
        return 'HOME';
    }

    /**
    * Send notification
    *
    * @return void|bool
    */
    public function send()
    {
        // Get message from parent
        $message = $this->getMessage();
        
        Log::debug('Attempting to send push notification', [
            'push_status' => gs('pn'),
            'message' => $message,
            'recipients' => count($this->toAddress ?? []),
            'template' => $this->templateName ?? null
        ]);

        if (gs('pn') && $message) {
            try {
                $credentialsFilePath = getFilePath('pushConfig').'/push_config.json';
                
                Log::debug('Initializing Firebase client', [
                    'credentials_path' => $credentialsFilePath
                ]);

                $client = new \Google_Client();
                $client->setAuthConfig($credentialsFilePath);
                $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
                
                Log::debug('Fetching Firebase access token');
                $token = $client->fetchAccessTokenWithAssertion();

                $access_token = $token['access_token'];
                
                Log::debug('Firebase access token obtained', [
                    'token_expires' => $token['expires_in'] ?? null
                ]);

                $headers = [
                    "Authorization: Bearer $access_token",
                    'Content-Type: application/json'
                ];

                $data['notification'] = [
                    'body' => $message,
                    'title' => $this->getTitle(),
                    'image' => asset(getFilePath('push')).'/'.$this->pushImage,
                ];

                $data['data'] = [
                    'icon' => siteFavicon(),
                    'click_action' => $this->redirectUrl,
                    'app_click_action' => $this->redirectForApp($this->templateName)
                ];

                Log::debug('Prepared notification payload', [
                    'notification' => $data['notification'],
                    'data' => $data['data']
                ]);

                foreach ($this->toAddress as $toAddress) {
                    Log::debug('Sending to device', ['device_token' => $toAddress]);
                    
                    $data['token'] = $toAddress;
                    $payloadData['message'] = $data;
                    $payload = json_encode($payloadData);
                    
                    Log::debug('Final payload', ['payload' => $payload]);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/'.gs('firebase_config')->projectId.'/messages:send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                    
                    $response = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    
                    Log::debug('Firebase API response', [
                        'device_token' => $toAddress,
                        'http_code' => $httpCode,
                        'response' => $response
                    ]);

                    if (curl_errno($ch)) {
                        Log::error('cURL error sending push notification', [
                            'error' => curl_error($ch),
                            'device_token' => $toAddress
                        ]);
                    }

                    curl_close($ch);
                }

                Log::info('Push notifications sent successfully', [
                    'recipient_count' => count($this->toAddress),
                    'template' => $this->templateName
                ]);

            } catch (\Exception $e) {
                Log::error('Push notification failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                $this->createErrorLog($e->getMessage());
                session()->flash('firebase_error', $e->getMessage());
                
                return false;
            }
        } else {
            Log::warning('Push notification not sent', [
                'reason' => !gs('pn') ? 'Push notifications disabled in settings' : 'Empty message content',
                'message' => $message
            ]);
        }
    }

    /**
    * Configure some properties
    *
    * @return void
    */
    public function prevConfiguration()
    {
        if ($this->user) {
            $this->deviceId = $this->user->deviceTokens()->pluck('token')->toArray();
            $this->receiverName = $this->user->fullname;
            
            Log::debug('Configured push notification for user', [
                'user_id' => $this->user->id,
                'device_tokens' => $this->deviceId,
                'receiver_name' => $this->receiverName
            ]);
        }
        
        $this->toAddress = $this->deviceId;
        
        Log::debug('Final notification addresses', [
            'addresses' => $this->toAddress
        ]);
    }

    private function getTitle()
    {
        $title = $this->replaceTemplateShortCode($this->template->push_title ?? gs('push_title'));
        Log::debug('Generated push notification title', ['title' => $title]);
        return $title;
    }
}