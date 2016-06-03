responsiveVoice.OnVoiceReady = function() {
    if( wpvi_obj.wpvi_meta.voice_text ) {
        responsiveVoice.speak(wpvi_obj.wpvi_meta.voice_text);
    } else {
        responsiveVoice.speak(wpvi_obj.post_title);
    }
};
