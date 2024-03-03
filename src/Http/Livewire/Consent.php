<?php
namespace Laboiteacode\RGPDManager\Http\Livewire;

use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\On;

class Consent extends Component
{
    use LivewireAlert;

    /**
     * Titre du consentement
     *
     * @var string
     */
    public string $title = '';

    /**
     * Nom du consentement, pour la BDD
     *
     * @var string
     */
    public string $consentName = 'consent-contact';

    /**
     * Explication du consentement
     *
     * @var string
     */
    public string $explanation = '';

    /**
     * Consenti ?
     *
     * @var bool
     */
    public bool $consented = false;

    /**
     * Données exploitées
     *
     * @var array
     */
    public array $consentData = [];

    /**
     * ID du formulaire
     *
     * @var string
     */
    public string $formId = 'form-contact';

    /**
     * URL du formulaire
     *
     * @var string
     */
    public string $url = '';

    /**
     * Token de l'utilisateur
     *
     * @var string
     */
    public string $token = '';

    /**
     * Consentement dans un formulaire ?
     *
     * @var bool
     */
    public bool $inForm = true;

    /**
     * L'utilisateur a déjà consenti ?
     *
     * @var bool
     */
    public bool $alreadyConsented = false;

    /**
     * @var bool
     */
    public bool $useCardDesign = true;

    /**
     * @var string[]
     */
//    public $listeners = [
//        'setTokenFromLocalStorage'
//    ];

    /**
     * Montage du composant
     */
    public function mount(): void
    {
        $this->url = request()->url();
        $this->formId = 'form-' . str_replace('consent-', '', $this->consentName);
    }

    /**
     * On met à jour le token depuis l'évènement
     *
     * @param $token
     */
    #[On('setTokenFromLocalStorage')]
    public function setTokenFromLocalStorage($token): void
    {
        $this->token = $token;
        $consent = \Laboiteacode\RGPDManager\Models\Consent::where('purpose', $this->consentName)
            ->where('token', $this->token)
            ->latest()
            ->first();

        if( $consent ) {
            $this->alreadyConsented = true;
            $this->consented = $consent->action === 'consent';
            //$this->emitTo(config('rgpdmanager.livewire_components.contact', 'rgpd-contact'), config('rgpdmanager.livewire_events.consent_updated', 'consentUpdated'), $this->consented);
            $this->dispatch(config('rgpdmanager.livewire_events.consent_updated', 'consentUpdated'), $this->consented)->to(config('rgpdmanager.livewire_components.contact', 'rgpd-contact'));
        }
    }

    public function updatedConsented(): void
    {
        \Laboiteacode\RGPDManager\Models\Consent::createConsent([
            'consent_name'        => $this->consentName,
            'consent_data'        => json_encode($this->consentData),
            'consent_token'       => $this->token,
            'consent_form_id'     => $this->formId,
            'consent_form_url'    => $this->url,
            'user_id'             => auth()->check() ? auth()->id() : null,
            'consented'           => $this->consented,
            'consent_explanation' => $this->explanation,
        ]);

        $this->alert(
            'success' ,
            __("Your consent has correctly been saved") ,
            [
                'toast'    => true ,
                'position' => 'top-end' ,
            ]
        );

        //$this->emitTo('rgpd-contact' , 'consentUpdated' , $this->consented);
        //$this->emitTo(config('rgpdmanager.livewire_components.contact', 'rgpd-contact') , config('rgpdmanager.livewire_events.consent_updated', 'consentUpdated') , $this->consented);
        $this->dispatch(config('rgpdmanager.livewire_events.consent_updated', 'consentUpdated') , $this->consented)->to(config('rgpdmanager.livewire_components.contact', 'rgpd-contact'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        $dataParsed = (string) json_encode($this->consentData);
        return view('rgpdmanager::livewire.consent', compact('dataParsed'));
    }
}