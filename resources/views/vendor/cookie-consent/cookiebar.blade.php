<div data-cookie-consent-dialog class="fixed-bottom w-100 customize-cookie-consent">
    <div class="w-100 mx-auto px-5">
        <div class="d-flex align-items-center justify-content-center gap-3 p-3">
            <div class="d-flex align-items-center">
                <span>{{ $text ?? 'This website makes use of cookies' }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button data-refuse-cookies class="text-white rounded-5 px-4 py-2 customize-cookie-consent-button customize-cookie-consent-decline">{{ $cancel ?? 'Decline' }}</button>
                <button data-accept-cookies class="text-white rounded-5 px-4 py-2 customize-cookie-consent-button customize-cookie-consent-accept">{{ $accept ?? 'Accept' }}</button>
            </div>
        </div>
    </div>
</div>
