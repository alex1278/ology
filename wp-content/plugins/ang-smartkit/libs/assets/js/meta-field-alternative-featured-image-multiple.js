/* Copyright (C) Aleksandr Glovatskyy, Mykolaiv, http://www.gnu.org/licenses/gpl.html GNU/GPL */

(function ($) {
    $(document ).ready(function() {
        var AltImageUpdate = function ( post_id, thumb_id ) {
            wp.media.post( 'set-multiple-thumbnails', {
                post_id:      post_id,
                thumbnail_id: thumb_id,
                nonce:        ang_meta_gallery.nonce
            } ).done( function ( html ) {
                $('#alternative_gallery' ).find('.inside' ).html(html);
            } );
        };

        $('#alternative_gallery' )
            .on('click', '#set-post-multiple-thumbnails', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var uploader = wp.media( {
                    title:    ang_meta_gallery.l10n.uploaderTitle,
                    button:   { text: ang_meta_gallery.l10n.uploaderButton },
                    multiple: 'add'
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
            .on('click', '#remove-post-multiple-thumbnails', function(e) {
                e.preventDefault();
                e.stopPropagation();

                AltImageUpdate( wp.media.view.settings.post.id, -1 );
            });
    });
})(jQuery);