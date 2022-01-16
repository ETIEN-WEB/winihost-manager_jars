@include('layout.site.component.topbar')

<div class="bg-033d8a pb-130px">
    @if (!Browser::isMobile())
    <div class="container text-white pt-5 pb-4 px-2">
        <div class="row">
            <div class="col-md-1 text-center">
                <a href="#">
                    <img src="{{ session('UserSession.profil.photo') }}"
                        class="rounded-circle border border-white border-2" style="height: 100px; width: 100px;">
                </a>
            </div>
            <div class="col-md-6">
                <div class="ms-3">
                    <h3 class="mb-4 text-shadow-black">
                        # {{ session('UserSession.profil.last_name') .' '. session('UserSession.profil.first_name') }}
                    </h3>
                    <div class="row">
                        <div class="col-md-3 text-shadow-black">
                            <h6>
                                <i class="mdi mdi-account-group"></i>
                                <u>{{ __('site.label.sponsorship') }}</u>
                            </h6>
                            <p class="d-flex justify-content-between">
                                <em style="margin-right: 5px; ">{{ session('UserSession.profil.code_sponsor') }}</em>
                                <a href="#" class="text-decoration-none fs-6" title="Partager mon lien de parrainage"
                                    data-bs-toggle="modal" data-bs-target="#sponsorCodeModal">
                                    <span class="badge btn-warning icon-code-share ml-2">
                                        <i class="mdi mdi-share-variant"></i>
                                    </span>
                                </a>
                            </p>
                        </div>
                        <div class="col-md-3 text-shadow-black text-center">
                            <div class="text-decoration-none text-white">
                                <h6>
                                    <i class="mdi mdi-account-multiple-check"></i>
                                    <u>{{ __('site.label.godson') }}</u>
                                </h6>
                                <h4>{{ session('UserSession.profil.children') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-3 text-shadow-black text-center">
                            <a href="{{ route('Site-TicketGetShow') }}" class="text-decoration-none text-white">
                                <h6>
                                    <i class="mdi mdi-lifebuoy"></i>
                                    <u>{{ __('site.label.ticket') }}</u>
                                </h6>
                                <h4>{{ session('UserSession.profil.ticket_open') }}</h4>
                            </a>
                        </div>
                        <div class="col-md-3 text-shadow-black text-center">
                            <a href="{{ route('Site-PointGetShow') }}" class="text-decoration-none text-white">
                                <h6>
                                    <i class="mdi mdi-star-circle"></i>
                                    <u>{{ __('site.label.point') }}</u>
                                </h6>
                                <h4>{{ session('UserSession.profil.point') }}</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 align-self-center" style="height: 160px!important;">

                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($flash_info_list as $key => $item)
                        <div class="carousel-item {{ $key == 0 ? 'active' : null }}">
                            <a href="{{ $item['link'] ?? null }}">
                                <img src="{{ $item['content'] }}" class="d-block w-100" alt="...">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="modal fade" id="sponsorCodeModal" tabindex="-1" aria-labelledby="sponsorCodeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sponsorCodeModalLabel" style="color: #0c0c0c;">
                                <i class="mdi mdi-share-variant"></i>
                                {{ __('site.wording.share_sponsorship_code') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-primary m-2">
                                <i class="mdi mdi-facebook"></i>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-info m-2">
                                <i class="mdi mdi-twitter"></i>
                                Twitter
                            </a>
                            <a href="https://pinterest.com/pin/create/button/?url={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-danger m-2">
                                <i class="mdi mdi-pinterest"></i>
                                Pinterest
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-success m-2">
                                <i class="mdi mdi-whatsapp"></i>
                                Whatsapp
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-primary m-2">
                                <i class="mdi mdi-linkedin"></i>
                                Linkedin
                            </a>
                            <a href="https://telegram.me/share/url?url={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-secondary m-2">
                                <i class="mdi mdi-telegram"></i>
                                Telegram
                            </a>
                            <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-danger m-2">
                                <i class="mdi mdi-web-box"></i>
                                Tumblr
                            </a>
                            <a href="https://web.skype.com/share?url={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-info m-2">
                                <i class="mdi mdi-skype"></i>
                                Whatsapp
                            </a>
                            <a href="sms:?body={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-secondary m-2">
                                <i class="mdi mdi-android-messages"></i>
                                SMS
                            </a>
                            <a href="mailto:?&subject=&body={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-warning m-2">
                                <i class="mdi mdi-email"></i>
                                Email
                            </a>
                            <a href="https://mabendi.com/xmp/share?text={{ route('Auth-RegisterGetShow', ['p' => session('UserSession.profil.code_sponsor')]) }}"
                                target="blank" class="btn btn-primary m-2">
                                <i class="mdi mdi-feather"></i>
                                Mabendi
                            </a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
                                <i class="mdi mdi-close"></i>
                                {{ __('site.label.close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div>
</div>