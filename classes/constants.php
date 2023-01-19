<?php

namespace qtype_autospeak;

/**
 * Created by PhpStorm.
 * User: justin
 * Date: 17/10/07
 * Time: 9:27
 */
class constants {
    const RESPONSEFORMAT_AUDIO = 'audio';
    const RESPONSEFORMAT_VIDEO = 'video';
    const M_COMP = 'qtype_autospeak';
    const M_URL = 'question/type/autospeak';
    const M_TABLE = 'qtype_autospeak_opts';
    const M_PLUGINSETTINGS = '/admin/settings.php?section=qtypesettingautospeak';

    const APPID = 'qtype_autospeak';

    const REC_AUDIO = 'audio';
    const REC_VIDEO = 'video';

    const SKIN_PLAIN = 'standard';
    const SKIN_BMR = 'bmr';
    const SKIN_123 = 'onetwothree';
    const SKIN_FRESH = 'fresh';
    const SKIN_ONCE = 'once';
    const SKIN_UPLOAD = 'upload';
    const SKIN_PUSH = 'push';
    const SKIN_SCREEN = 'screen';

    const FALLBACK_UPLOAD = 'upload';
    const FALLBACK_IOSUPLOAD = 'iosupload';
    const FALLBACK_WARNING = 'warning';
    const PROCESSING = 'processing';
    const BLANK = 'empty';

    const CLASS_REC_CONTAINER = 'qtype_autospeak_rec_cont';
    const CLASS_REC_OUTER = 'qtype_autospeak_rec_outer';
    const CLASS_AUDIOREC_IFRAME ='qtype_autospeak_audiorec_iframe';
    const CLASS_VIDEOREC_IFRAME ='qtype_autospeak_videorec_iframe';
    const ID_REC = 'qtype_autospeak_therecorder';
    const ID_UPDATE_CONTROL = 'qtype_autospeak_updatecontrol';
    const NAME_UPDATE_CONTROL = 'filename';


    const REGION_USEAST1 = 'useast1';
    const REGION_TOKYO = 'tokyo';
    const REGION_DUBLIN = 'dublin';
    const REGION_SYDNEY = 'sydney';
    const REGION_OTTAWA = 'ottawa';
    const REGION_SAOPAULO = 'saopaulo';
    const REGION_FRANKFURT = 'frankfurt';
    const REGION_LONDON = 'london';
    const REGION_SINGAPORE = 'singapore';
    const REGION_MUMBAI = 'mumbai';
    const REGION_CAPETOWN = 'capetown';
    const REGION_BAHRAIN = 'bahrain';

    const QSTYLE_STANDARD  = 'standard';

    const TRANSCRIBER_NONE = 0;
    const TRANSCRIBER_AUTO = 1;
    const TRANSCRIBER_POODLL = 2;

    const LANG_ENUS = 'en-US';
    const LANG_ENGB = 'en-GB';
    const LANG_ENAU = 'en-AU';
    const LANG_ENIN = 'en-IN';
    const LANG_ESUS = 'es-US';
    const LANG_ESES = 'es-ES';
    const LANG_FRCA = 'fr-CA';
    const LANG_FRFR = 'fr-FR';
    const LANG_DEDE = 'de-DE';
    const LANG_ITIT = 'it-IT';
    const LANG_PTBR = 'pt-BR';

    const LANG_DADK = 'da-DK';

    const LANG_KOKR = 'ko-KR';
    const LANG_HIIN = 'hi-IN';
    const LANG_ARAE ='ar-AE';
    const LANG_ARSA ='ar-SA';
    const LANG_ZHCN ='zh-CN';
    const LANG_NLNL ='nl-NL';
    const LANG_ENIE ='en-IE';
    const LANG_ENWL ='en-WL';
    const LANG_ENAB ='en-AB';
    const LANG_FAIR ='fa-IR';
    const LANG_DECH ='de-CH';
    const LANG_HEIL ='he-IL';
    const LANG_IDID ='id-ID';
    const LANG_JAJP ='ja-JP';
    const LANG_MSMY ='ms-MY';
    const LANG_PTPT ='pt-PT';
    const LANG_RURU ='ru-RU';
    const LANG_TAIN ='ta-IN';
    const LANG_TEIN ='te-IN';
    const LANG_TRTR ='tr-TR';


    const LOADER_URL = '/question/type/autospeak/cloudpoodll/cloudpoodllloader.html';
    const REFRESH_URL = '/question/type/autospeak/cloudpoodll/refreshtoken.php';

    const extra_fields = ['responseformat',  'language', 'expiredays',
            'transcriber', 'transcode', 'audioskin', 'videoskin', 'timelimit','safesave'];
}