<?php
namespace App; // xcomposer in App namespace i altında çalışabilmesi için

class FormElements {

    public function button($text, $link,$script, $classList) {
        return <<<HTML
            <a href="$link" onclick="$script" class="theme-l4 border border-theme btn hover-theme round $classList"> $text </a>
        HTML;
    }

}
?>
