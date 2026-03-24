<?php

if (!function_exists('agency_logo_url')) {
    /**
     * Resolve agency logo URL.
     * Handles both full URLs (stored from Node.js backend) and plain filenames.
     */
    function agency_logo_url(?string $logo): string
    {
        if (empty($logo)) {
            return '';
        }
        // Already a full URL (http/https)
        if (str_starts_with($logo, 'http')) {
            return $logo;
        }
        // Legacy plain filename
        return 'http://127.0.0.1:8001/assets/images/agency/logo/' . $logo;
    }
}
