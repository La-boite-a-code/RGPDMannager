<x-rgpdmanager-r-g-p-d-manager-layout>
    <div class="mx-auto max-w-5xl">
        <h2 class="text-3xl font-bold tracking-tight text-white text-center sm:text-4xl">{{ __('rgpdmanager::rgpd.titles.' . str_replace('-', '_', $consent->purpose)) }}</h2>
        <p class="mt-2 text-lg leading-8 text-gray-100 text-center">{{ __($consent->explanation) }}</p>

        <div class="my-4">
            <livewire:rgpd-consent :consent-name="$consent->purpose" title="" :explanation=" $consent->explanation" :consent-data="json_decode($consent->data_used)" :form-id="$consent->form_id" />
        </div>

        <div class="mx-auto mt-8 grid max-w-3xl grid-cols-2 gap-6 lg:max-w-7xl lg:grid-flow-col-dense">
            <div class="space-y-6 lg:col-start-1">
                <section>
                    <h4 class="my-2 text-white">{{ __('Your backup token') }}</h4>
                    <div class="bg-white/5 sm:rounded-lg p-6">
                        <input type="text" class="bg-white/5 w-full block text-white" value="{{ $consent->token }}" disabled>
                    </div>

                    <div class="bg-white/5 sm:rounded-lg p-6 my-4">
                        <p class="text-white">{{ __('The requested consent relates to the following personal data:') }}</p>
                        <ul class="list-disc pl-4 text-white">
                            @foreach( $consent->data as $data )
                            <li>{{ __(ucfirst($data)) }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <h4 class="my-2 text-white">{{ __('Transfer of data to a third party') }}</h4>
                    <div class="bg-white/5 sm:rounded-lg p-6">
                        <p class="text-white">{{ __('This personal data is neither sold nor passed on to third parties.') }}</p>
                    </div>

                    <h4 class="my-2 text-white">{{ __('Questions about your data?') }}</h4>
                    <div class="bg-white/5 sm:rounded-lg p-6">
                        <p class="text-white">{{ __('If you have any questions regarding the use of your personal data, you can contact our data protection officer by clicking here:') }} <a href="{{  route('rgpd-manager.contact', config('rgpdmanager.routes.contact.pdo')) }}">{{ __('Contact the PDO') }}</a></p>
                    </div>
                </section>
            </div>
            <div class="space-y-6 lg:col-start-2">
                <section>
                    <h4 class="my-2 text-white">{{ __('Data controller') }}</h4>
                    <div class="bg-white/5 sm:rounded-lg p-6">
                        <p class="text-white">{{ __('The data controller decides what the file created with the personal data of users will be used for and by what means this data will be used.') }}
                        </p>
                        <ul class="my-2 list-disc pl-4 text-white">
                            <li><strong>{{ __('Responsible') }}</strong> : {{ config('rgpdmanager.pdo_name') }}</li>
                            <li><strong>{{ __('Email Address') }}</strong> : {{ str_replace('@', '[at]', config('rgpdmanager.pdo_email')) }}</li>
                        </ul>
                        <p class="text-white">{{ __('What Article 4.7 of the GDPR says: “controller” means the natural or legal person, public authority, agency or other body which, alone or jointly with others, determines the purposes and means of the treatment; where the purposes and means of such processing are determined by Union law or the law of a Member State, the controller may be designated or the specific criteria applicable to his designation may be provided for by the law of the Union or by the law of a Member State.') }}</p>
                    </div>

                    <h4 class="my-2 text-white">{{ __('History of your consents') }}</h4>
                    <div class="bg-white/5 sm:rounded-lg p-6">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                            <tr>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-white">{{ __('Date') }}</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-white">{{ __('Nature') }}</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                            @foreach( $consents as $c )
                                <tr>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-300">{{ Date::parse($c->created_at)->translatedFormat('d F Y \à H\hi') }}</td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-300">{{ __(ucfirst($c->action)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </div>
    </div>

</x-rgpdmanager-r-g-p-d-manager-layout>