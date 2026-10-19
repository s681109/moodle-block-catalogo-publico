<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

/** Block that embeds the reusable public catalogue showcase. */
class block_catalogo_publico extends block_base {
    public function init(): void {
        $this->title = get_string('pluginname', 'block_catalogo_publico');
    }

    public function applicable_formats(): array {
        return ['site' => true, 'my' => false, 'course-view' => false, 'all' => false];
    }

    public function has_config(): bool {
        return false;
    }

    public function get_content(): ?stdClass {
        global $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content = new stdClass();
        $this->content->text = $OUTPUT->render(new \local_catalogo_publico\output\showcase(true));
        $this->content->footer = '';
        return $this->content;
    }
}
