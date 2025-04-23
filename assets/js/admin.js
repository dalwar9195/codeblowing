jQuery(document).ready(function($) {
    function mediaUpload( buttonClass, inputClass ) {
        $(document).on('click', buttonClass, function(e) {
            e.preventDefault();
            var button = $(this);
            var fileFrame = wp.media({ title: 'Select Logo', multiple: false, library: { type: 'image' }, button: { text: 'Use this image' } });
            fileFrame.open();
            fileFrame.on('select', function() {
                var attachment = fileFrame.state().get('selection').first().toJSON();
                button.siblings(inputClass).val(attachment.url);
                fileFrame.close();
            });
        });
    }
    mediaUpload('button.upload-cb-logo', '.logo-url');
});