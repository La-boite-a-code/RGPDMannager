<?php

namespace Laboiteacode\RGPDManager\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class Contact extends Component
{
    use WithFileUploads;
    use UsesSpamProtection;
    use LivewireAlert;

    /**
     * @var \Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData
     */
    public HoneypotData $extraFields;

    public array $fields = ['name', 'email', 'message'];

    public array $formRules = [];

    /**
     * @var string
     */
    public string $email = '';

    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var string
     */
    public string $phoneNumber = '';

    /**
     * @var string
     */
    public string $message = '';

    /**
     * @var string
     */
    public string $subject = '';

    /**
     * @var array
     */
    public $files = [];

    /**
     * @var bool
     */
    public bool $isConsented = false;

    /**
     * @var bool
     */
    public bool $isSend = false;

    public bool $isError = false;

    public string $errorMessage = '';

    /**
     * @var string
     */
    public string $formId = 'form-contact';

    /**
     * @var string
     */
    public string $consentName = 'consent-contact';

    /**
     * @var string
     */
    public string $type = 'contact';

    public int $captcha = 0;

    /**
     * @var string[]
     */
//    public $listeners = [
//        'consentUpdated'
//    ];

    /**
     * @return array
     */
    public function validationAttributes()
    {
        return [
            'isConsented'   => __('Consent'),
            'files.*'        => __('File'),
        ];
    }

    /**
     * @return array[]
     */
    protected function rules(): array
    {
        if( count($this->formRules) > 0 ) {
            $this->formRules['isConsented'] = ['accepted'];
            return $this->formRules;
        }

        return [
            'name'          => ['required', 'min:3'],
            'email'         => ['required', 'email'],
            'message'       => ['required', 'min:10'],
            'isConsented'   =>  ['accepted'],
            'subject'       => ['nullable', 'min:3'],
            'files.*'        => ['nullable', 'file', 'max:1024'],
        ];
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->extraFields = new HoneypotData();
    }


    /**
     * @param $consented
     * @return void
     */
    #[On('consentUpdated')]
    public function consentUpdated($consented): void
    {
        $this->isConsented = $consented;
    }

    public function updated($propertyName, $value): void
    {
        $this->reset('isError', 'errorMessage');
        if( $propertyName !== 'isConsented' ) {
            $this->validateOnly($propertyName);
        }

        if( $propertyName === 'captcha' ) {
            $this->updatedCaptcha($value);
        }
    }

    public function updatedCaptcha($token): void
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . env('CAPTCHA_SECRET_KEY') . '&response=' . $token);
        $this->captcha = $response->json()['score'];

        if( !$this->captcha > .3 ) {
            $this->submit();
        } else {
            $this->isError = true;
            $this->errorMessage = __("Google thinks you are a bot, please refresh and try again");
        }

    }

    /**
     * @return void
     * @throws \Exception
     */
    public function submit(): void
    {
        $this->protectAgainstSpam();
        $this->validate();

        $files = [];
        foreach ($this->files as $key => $file) {
            $fileName = 'contact_' . ($key + 1) . '_' . now()->format('Y-m-d-H-i-s'). '.' . $file->getClientOriginalExtension();
            $files[] = $fileName;
            $file->storeAs('contact_files', $fileName, config('filesystems.default'));
        }

        Mail::to($this->type === 'contact' ? config('rgpdmanager.mail_to') : config('rgpdmanager.pdo_email'))
            ->cc($this->type === 'contact' ? config('rgpdmanager.mail_cc') : [])
            ->send(new \Laboiteacode\RGPDManager\Mail\Contact([
                'name'          => $this->name,
                'email'         => $this->email,
                'phoneNumber'   => $this->phoneNumber,
                'message'       => $this->message,
                'subject'       => $this->subject,
                'files'          => $files,
        ], $this->type));

        $this->isSend = true;
        if( class_exists(\Laravel\Nova\Notifications\NovaNotification::class) ) {
            $users = \App\Models\User::where('email', config('rgpdmanager.mail_to'))->orWhereIn('email', config('rgpdmanager.mail_cc'))->get();
            foreach( $users as $user ) {
                $user->notify(\Laravel\Nova\Notifications\NovaNotification::make()
                    ->message(__('rgpdmanager::rgpd.mails.' . $this->type) . ' ' . __('rgpdmanager::rgpd.from_message', ['name' => $this->name, 'email' => $this->email]))
                    ->type('info')
                );
            }
        }

        $this->reset('name', 'email', 'phoneNumber', 'message', 'subject', 'files');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('rgpdmanager::livewire.contact');
    }
}