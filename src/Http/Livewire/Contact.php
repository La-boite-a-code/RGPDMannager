<?php

namespace Laboiteacode\RGPDManager\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class Contact extends Component
{
    use UsesSpamProtection;

    /**
     * @var \Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData
     */
    public HoneypotData $extraFields;

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
     * @var bool
     */
    public bool $isConsented = false;

    /**
     * @var bool
     */
    public bool $isSend = false;

    /**
     * @var string
     */
    public string $formId = 'form-contact';

    /**
     * @var string
     */
    public $consentName = 'consent-contact';

    /**
     * @var string
     */
    public string $type = 'contact';

    /**
     * @var string[]
     */
    public $listeners = [
        'consentUpdated'
    ];

    /**
     * @return array[]
     */
    protected function rules(): array
    {
        return [
            'name'          => ['required', 'min:3'],
            'email'         => ['required', 'email'],
            'message'       => ['required', 'min:10'],
            'isConsented'   =>  ['accepted'],
            'subject'       => ['required', 'min:3']
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
    public function consentUpdated($consented): void
    {
        $this->isConsented = $consented;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function submit(): void
    {
        $this->protectAgainstSpam();
        $this->validate();

        Mail::to(config('rgpdmanager.pdo_email'))->send(new \Laboiteacode\RGPDManager\Mail\Contact([
            'name'          => $this->name,
            'email'         => $this->email,
            'phoneNumber'   => $this->phoneNumber,
            'message'       => $this->message,
            'subject'       => $this->subject,
        ], $this->type));

        $this->isSend = true;
        $this->reset('name', 'email', 'phoneNumber', 'message', 'subject');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('rgpdmanager::livewire.contact');
    }
}