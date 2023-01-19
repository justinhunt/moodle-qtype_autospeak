<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Short answer question renderer class.
 *
 * @package    qtype
 * @subpackage autospeak
 * @copyright  2022 Poodll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

use qtype_autospeak\utils;
use qtype_autospeak\constants;

/**
 * Generates the output for short answer questions.
 *
 * @copyright  2022 Poodll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_autospeak_renderer extends qtype_renderer {
    public function formulation_and_controls(question_attempt $qa,
            question_display_options $options) {

        global $CFG,$USER;

        $question = $qa->get_question();
        $currentanswer = $qa->get_last_qt_var('answer');

        $inputname = $qa->get_qt_field_name('answer');
        $inputattributes = array(
            'type' => 'text',
            'name' => $inputname,
            'value' => $currentanswer,
            'id' => $inputname,
            'size' => 80,
            'class' => 'form-control d-inline',
        );

        if ($options->readonly) {
            $inputattributes['readonly'] = 'readonly';
        }

        $feedbackimg = '';
        if ($options->correctness) {
            $answer = $question->get_matching_answer(array('answer' => $currentanswer));
            if ($answer) {
                $fraction = $answer->fraction;
            } else {
                $fraction = 0;
            }
            $inputattributes['class'] .= ' ' . $this->feedback_class($fraction);
            $feedbackimg = $this->feedback_image($fraction);
        }

        $questiontext = $question->format_questiontext($qa);
        $placeholder = false;
        if (preg_match('/_____+/', $questiontext, $matches)) {
            $placeholder = $matches[0];
            $inputattributes['size'] = round(strlen($placeholder) * 1.1);
        }
        $input = html_writer::empty_tag('input', $inputattributes) . $feedbackimg;

        if ($placeholder) {
            $inputinplace = html_writer::tag('label', get_string('answer'),
                    array('for' => $inputattributes['id'], 'class' => 'accesshide'));
            $inputinplace .= $input;
            $questiontext = substr_replace($questiontext, $inputinplace,
                    strpos($questiontext, $placeholder), strlen($placeholder));
        }
        
        //audio recorder
        $config = get_config('qtype_cloudpoodll');
        $rec_opts = new \stdClass();
        $rec_opts->region =$config->awsregion;
        $rec_opts->cloudpoodlltoken = $token;
        $rec_opts->wwwroot=$CFG->wwwroot;
        $rec_opts->language=$question->ttslanguage;
        $rec_opts->transcriber=$question->transcriber;
        $rec_opts->hints='';
        $rec_opts->owner=hash('md5',$USER->username);
        $rec_opts->asrurl = \utils::fetch_lang_server_url($rec_opts->region,'transcribe');
        $rec_opts->maxtime = 15000;

        //passagehash could be empty
        //if its full it will be of form: region|hash e.g. tokyo|2353531453415134545
        //we just want the hash here though, so we strip out the region
        $rec_opts->passagehash="";
        if(!empty($item->passagehash)){
            $hashbits = explode('|',$item->passagehash,2);
            if(count($hashbits)==2){
                $rec_opts->passagehash  = $hashbits[1];
            }
        }

        $audiorecorder = $this->render_from_template('qtype_autospeak/ttrecorder',$rec_opts);
        $questiontext .= $audiorecorder;

        $result = html_writer::tag('div', $questiontext, array('class' => 'qtext'));

        if (!$placeholder) {
            $result .= html_writer::start_tag('div', array('class' => 'ablock form-inline'));
            $result .= html_writer::tag('label', get_string('answer', 'qtype_autospeak',
                    html_writer::tag('span', $input, array('class' => 'answer'))),
                    array('for' => $inputattributes['id']));
            $result .= html_writer::end_tag('div');
        }

        if ($qa->get_state() == question_state::$invalid) {
            $result .= html_writer::nonempty_tag('div',
                    $question->get_validation_error(array('answer' => $currentanswer)),
                    array('class' => 'validationerror'));
        }

        return $result;
    }

    public function specific_feedback(question_attempt $qa) {
        $question = $qa->get_question();

        $answer = $question->get_matching_answer(array('answer' => $qa->get_last_qt_var('answer')));
        if (!$answer || !$answer->feedback) {
            return '';
        }

        return $question->format_text($answer->feedback, $answer->feedbackformat,
                $qa, 'question', 'answerfeedback', $answer->id);
    }

    public function correct_response(question_attempt $qa) {
        $question = $qa->get_question();

        $answer = $question->get_matching_answer($question->get_correct_response());
        if (!$answer) {
            return '';
        }

        return get_string('correctansweris', 'qtype_autospeak',
                s($question->clean_response($answer->answer)));
    }
}
