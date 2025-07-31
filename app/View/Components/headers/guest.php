<?php

namespace App\View\Components\headers;

use App\Models\ApplicationSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class guest extends Component
{
    public $isGuestRegistrationAllowed;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->isGuestRegistrationAllowed = (bool) ApplicationSetting::get('is_guest_registration_allowed');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.headers.guest');
    }
}
