<?php
namespace Laboiteacode\RGPDManager\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consent extends Model
{
    public $fillable = [
        'token',
        'form_id',
        'form_url',
        'purpose',
        'data_used',
        'explanation',
        'action',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('rgpd-manager.user_model'));
    }

    public function getDataAttribute()
    {
        return json_decode($this->data_used);
    }

    public static function createConsent($consents)
    {
        self::create([
            'token'         =>  $consents['consent_token'],
            'form_id'       =>  $consents['consent_form_id'],
            'form_url'      =>  $consents['consent_form_url'],
            'data_used'     =>  $consents['consent_data'],
            'user_id'       =>  auth()->check() ? auth()->id() : null,
            'action'        =>  $consents['consented'] == '1' ? 'consent' : 'refuse',
            'purpose'       =>  $consents['consent_name'],
            'explanation'   =>  $consents['consent_explanation'],
        ]);
    }
}