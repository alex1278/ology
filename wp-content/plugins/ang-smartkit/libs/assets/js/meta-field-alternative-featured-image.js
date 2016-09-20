(function ($) {
    $(document ).ready(function() {
        var AltImageUpdate = function ( post_id, thumb_id ) {
            wp.media.post( 'set_alternative_thumbnail', {
                post_id:      post_id,
                thumbnail_id: thumb_id,
                nonce:        ang_meta_image.nonce
            } ).done( function ( html ) {
                $('#alternative_image' ).find('.inside' ).html(html);
            } );
        };

        $('#alternative_image' )
            .on('click', '#set-post-alternative-thumbnail', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var uploader = wp.media( {
                    title:    ang_meta_image.l10n.uploaderTitle,
                    button:   { text: ang_meta_image.l10n.uploaderButton },
                    multiple: false
                } );
                uploader.on('select', function() {
                    var attachments = [];
                    uploader.state().get( 'selection' ).forEach( function ( i ) {
                        attachments.push( i.id );
                    } );
                    AltImageUpdate( wp.media.view.settings.post.id, attachments );
                });
                uploader.open();
            })
            .on('click', '#remove-post-alternative-thumbnail', function(e) {
                e.preventDefault();
                e.stopPropagation();

                AltImageUpdate( wp.media.view.settings.post.id, -1 );
            });
    });
})(jQuery);