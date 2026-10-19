<?php
// This file is part of Moodle - http://moodle.org/

namespace block_catalogo_publico\privacy;

/** Declares that the block stores no personal data. */
class provider implements \core_privacy\local\metadata\null_provider {
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
