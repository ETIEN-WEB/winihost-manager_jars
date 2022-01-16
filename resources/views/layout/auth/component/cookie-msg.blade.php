<div class="modal modal-bottom fade" id="bottom_modal" tabindex="-1" role="dialog" aria-labelledby="bottom_modal">
    <div class="modal-dialog">
        <div class="modal-content" style="color: white!important;">
            <div class="modal-header">
                <div class="w-100">
                    <h3 class="text-white text-center"> <i class="mdi mdi-information"></i>
                        {{ __('site.messages.welcome.title') }}</h3>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="color: red!important;"></button>
            </div>
            <div class="modal-body">
                <p>
                    {{ __('site.messages.welcome.client') }}
                    {{ __('site.messages.welcome.text') }}
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-top fade" id="top_modal" tabindex="-1" role="dialog" aria-labelledby="top_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="color: white!important;">
            <div class="modal-header">
                <div class="w-100">
                    <h3 class="text-white text-center"> <i class="mdi mdi-information"></i>
                        {{ __('site.messages.coockies.title') }}</h3>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="color: red!important;"></button>
            </div>
            <div class="modal-body">
                <p>
                    {{ __('site.messages.coockies.text') }}
                </p>
            </div>
        </div>
    </div>
</div>