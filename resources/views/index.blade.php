<x-rgpdmanager-r-g-p-d-manager-layout>
    <div class="bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 text-center lg:px-8">
            <div class="mx-auto max-w-2xl">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl"> {{ trans('rgpdmanager::rgpd.confidentiality') }}</h2>
                <p class="mt-2 text-lg leading-8 text-gray-400"> {{ trans('rgpdmanager::rgpd.confidentiality_description') }}</p>
            </div>
            <ul role="list" class="mx-auto mt-4 grid max-w-2xl grid-cols-1 gap-6 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-8">
                <li class="rounded-2xl bg-gray-800 py-10 px-8">
                    <i class="fas fa-envelope fa-3x text-white"></i>
                    <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-white">{{ trans('rgpdmanager::rgpd.forms.pdo.title') }}</h3>
                    <a href="{{ route('rgpd-manager.contact', config('rgpdmanager.routes.contact.pdo')) }}" class="bg-cyan-400 block rounded mt-4 px-4 py-2 text-white">
                        {{ trans('rgpdmanager::rgpd.learn_more') }}
                    </a>
                </li>

                <li class="rounded-2xl bg-gray-800 py-10 px-8">
                    <i class="fas fa-user-edit fa-3x text-white"></i>
                    <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-white">{{ trans('rgpdmanager::rgpd.forms.data.title') }}</h3>
                    <a href="{{ route('rgpd-manager.contact', config('rgpdmanager.routes.contact.data')) }}" class="bg-cyan-400 block rounded mt-4 px-4 py-2 text-white">
                        {{ trans('rgpdmanager::rgpd.learn_more') }}
                    </a>
                </li>

                <li class="rounded-2xl bg-gray-800 py-10 px-8">
                    <i class="fas fa-eraser fa-3x text-white"></i>
                    <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-white">{{ trans('rgpdmanager::rgpd.forms.forgot.title') }}</h3>
                    <a href="{{ route('rgpd-manager.contact', config('rgpdmanager.routes.contact.forgot')) }}" class="bg-cyan-400 block rounded mt-4 px-4 py-2 text-white">
                        {{ trans('rgpdmanager::rgpd.learn_more') }}
                    </a>
                </li>

                <li class="rounded-2xl bg-gray-800 py-10 px-8">
                    <i class="fas fa-database fa-3x text-white"></i>
                    <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-white">{{ trans('rgpdmanager::rgpd.forms.request.title') }}</h3>
                    <a href="{{ route('rgpd-manager.contact', config('rgpdmanager.routes.contact.request')) }}" class="bg-cyan-400 block rounded mt-4 px-4 py-2 text-white">
                        {{ trans('rgpdmanager::rgpd.learn_more') }}
                    </a>
                </li>

                <li class="rounded-2xl bg-gray-800 py-10 px-8">
                    <i class="fas fa-user-check fa-3x text-white"></i>
                    <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-white">{{ trans('rgpdmanager::rgpd.your_consents') }}</h3>
                    <a href="{{ route('rgpd-manager.consents', config('rgpdmanager.routes.contact.request')) }}" class="bg-cyan-400 block rounded mt-4 px-4 py-2 text-white">
                        {{ trans('rgpdmanager::rgpd.learn_more') }}
                    </a>
                </li>

                @foreach( $pages as $page )
                <li class="rounded-2xl bg-gray-800 py-10 px-8">
                    <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-white">{{ $page->title }}</h3>
                    <a href="{{ route('rgpd-manager.page', $page->slug) }}" class="bg-cyan-400 block rounded mt-4 px-4 py-2 text-white">
                        En savoir plus
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-rgpdmanager-r-g-p-d-manager-layout>